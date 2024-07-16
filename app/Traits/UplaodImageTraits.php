<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait UplaodImageTraits
{
  public function UploadImage($folder, $image)
    {
        // Check if the image is a Base64-encoded string
        if (preg_match('/^data:image\/(\w+);base64,/', $image)) {
            // Decode the Base64 string
            $image = substr($image, strpos($image, ',') + 1);
            $image = base64_decode($image);

            // Generate a unique filename
            $filename = Str::random(10) . '.jpg';

            // Save the image to the specified folder
            Storage::put("public/{$folder}/{$filename}", $image);

            return $filename;
        } elseif ($image instanceof \Illuminate\Http\UploadedFile) {
                // If it's an UploadedFile instance, handle it as a file upload

        // Generate a unique filename with the correct extension
        $extension = $image->getClientOriginalExtension();
        $filename = Str::random(10) . '.' . $extension;

        // Save the uploaded file to the specified folder
        $image->storeAs("public/{$folder}", $filename);
        return $filename;
        } else {
            throw new \Exception('Invalid image data');
        }
    }
}
