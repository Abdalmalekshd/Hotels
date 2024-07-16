<?php

namespace App\Http\Controllers\API\Hotel;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotels\RoomRequest;
use App\Models\Attachment;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomAttachment;
use App\Models\RoomImage;
use App\Traits\UplaodImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;
use ZipArchive;
class RoomsController extends ResponseController
{

    use UplaodImageTraits;

        //Get All Rooms

    public function GetRooms(){

        $data=[];

        $data['rooms']=Room::with('attachments')->where('hotel_id',Auth::user()->id)->with('hotel')->paginate(20);




        return $this->sendResponse($data,'Rooms:');

    }





    //Store Room Code

    public function CreateRooms(RoomRequest $req){

        try{
    DB::beginTransaction();


        $file = $req->file('file');
        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow('A');
        for ($row = 2; $row <= $highestRow; $row++) {
            $RoomId               = $sheet->getCell("A{$row}")->getValue();
            $People_num           = $sheet->getCell("B{$row}")->getValue();
            $Room_floor           = $sheet->getCell("D{$row}")->getValue();
            $Cost                 = $sheet->getCell("F{$row}")->getValue();
            $hotel=Hotel::where('id',Auth::user()->id)->first()->id;


                $Room =new Room();
                $Room->room_id      = $RoomId;
                $Room->people_number= $People_num;
                $Room->room_floor   = $Room_floor;
                $Room->cost         = $Cost;
                $Room->hotel_id     = $hotel;


                $Room->save();


            }

    $room=Room::where('room_id',null)->delete();



    DB::commit();
    return $this->sendResponse($Room,'New Rooms Added for'.''.Hotel::where('id',$hotel)->first()->name);
    }catch(\Exception $ex){

        DB::rollBack();
    return  $this->sendError('Error while trying to add room please try again later');

    }
}





    // Update Hotel Code
    public function UpdateRoom(Request $request,$id){
         $room=Room::where('hotel_id',Auth::user()->id)->find($id);

        try{

                DB::beginTransaction();
            $room->update([
                'Room_id'       => $room->room_id,
                'cost'          => $request->cost,
                'people_number' => $request->people_number,
            ]);
            if ($request->input('photo')) {
                foreach($room->rooms as $image){
                    $des = 'storage/rooms/' . $image->img;
            if (File::exists($des)) {
                File::delete($des);
        }
            RoomImage::where('img', $image->img)->delete();
            }
            $img=$this->UploadImage('rooms',$request->photo);

            $rooms_img=RoomImage::create([
                'room_id'=> $room->id,
                'img'    =>$img
            ]);

            }

            $RoomAttach=RoomAttachment::where('room_id',$room->id)->first();

            if($RoomAttach){

                $RoomAttach->update(['attachemnts'=>json_encode($request->attach)]);

            }else{

            $RoomAttachment=new RoomAttachment();
            $RoomAttachment->room_id = $room->id;
            $RoomAttachment->attachemnts=json_encode($request->attach);
            $RoomAttachment->save();

        }
        DB::commit();
            return $this->sendResponse($room , __('hotel.updateroom'));
                 } catch(\Exception $e){
                    DB::rollBack();

            return $this->sendError('hotel.iddoesnotexist');
    }
        }








    //Delete Room Code
    public function DeleteRooms($id){

        $room=Room::find($id);
        if($room->rooms){
        foreach($room->rooms as $image){

            $des = 'storage/rooms/' . $image->img;

            if (File::exists($des)) {

        File::delete($des);
    }

    }


    $room->delete();

    return $this->sendResponse($room,'Room has been deleted');

        }else{

    return $this->sendError(__('hotel.iddoesnotexist'));
        }

        }

    }