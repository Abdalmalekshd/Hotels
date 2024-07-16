<?php

namespace App\Http\Controllers\Hotel;

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
use ZipArchive;
class RoomsController extends Controller
{

    use UplaodImageTraits;

        //Get All Rooms

    public function GetRooms(){

        $data=[];

        $data['rooms']=Room::with('attachments')->where('hotel_id',Auth::user()->id)->with('hotel')->paginate(20);




        return view('Hotel.Rooms.index',$data);

    }



    // Get Create Room View

    public function AddRooms(){


        return view('Hotel.Rooms.Create');
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
    return redirect()->back()->with(['success'=>'Rooms has been entered  please go to '. '<a href="' .route('get.rooms').'" class="text-center">' .'Rooms</a>  to see rooms you enterd and to edit the rooms images']);
    }catch(\Exception $ex){
        DB::rollBack();
    return redirect()->back()->with(['error'=>'Error while trying to add room please try again later']);

    }
}


    // Get Edit Room view

    public function EditRoom($id){
        $data=[];
         $data['room']=Room::with('attachments')->where('hotel_id',Auth::user()->id)->find($id);
        if($data['room']){
            $data['attachments']=Attachment::select(['id','name_ar','name_en',
            'name_' . LaravelLocalization::getCurrentLocale() .' as Name',
            ])->where('attachment_level',1)->get();




            return view('Hotel.Rooms.Edit',$data);

        }else{
            return redirect()->back()->with(['error'=>__('admin.iddoesnotexist')]);
        }
    }

    // Update Hotel Code
    public function UpdateRoom(RoomRequest $request){
        $room=Room::where('hotel_id',Auth::user()->id)->find($request->id);
            try{
                DB::beginTransaction();
            $room->update([
                'Room_id'       => $room->room_id,
                'cost'          => $request->cost,
                'people_number' => $request->people_number,
            ]);
            if ($request->hasFile('photo')) {
                foreach($room->rooms as $image){
                    $des = 'Images/rooms/' . $image->img;
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
            return redirect()->back()->with(['success'=> __('hotel.updateroom')]);
                 } catch(\Exception $e){
                    DB::rollBack();

            return redirect()->back()->with(['error'=>__('hotel.iddoesnotexist')]);
    }
        }








    //Delete Room Code
    public function DeleteRooms($id){

        $room=Room::find($id);
        if($room->rooms){
        foreach($room->rooms as $image){

            $des = 'Images/rooms/' . $image->img;

            if (File::exists($des)) {

        File::delete($des);
    }

    }


    $room->delete();

    return redirect()->back();

        }else{

    return redirect()->back()->with(['error'=>__('hotel.iddoesnotexist')]);
        }

        }

    }