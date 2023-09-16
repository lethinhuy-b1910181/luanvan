<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function EditRoom($id){
        
        $basic_facility = Facility::where('rooms_id', $id )->get();
        $multiImgs = MultiImage::where('rooms_id', $id )->get();
        $editData = Room::find($id);
        return view('backend.allroom.rooms.edit_rooms', compact('editData', 'basic_facility', 'multiImgs'));

    }//End Method

    public function UpdateRoom(Request $request, $id){
        
        $room = Room::find($id);
        $room->roomtype_id = $room->roomtype_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;
        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description;

        //Update Single Image
        if($request->file('image')){

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(550, 850)->save('upload/roomimg/'.$name_gen);
           $room['image'] = $name_gen;             
        }

        $room->save();

        //Update Facility Table

        if($request->facility_name == NULL){

            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Select',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
      
        } else{

            Facility::where('rooms_id',$id)->delete();
            $facilities = Count($request->facility_name);
            for($i=0 ; $i < $facilities ; $i++){
                $fCount = new Facility();
                $fCount->rooms_id = $room->id;
                $fCount->facility_name = $request->facility_name[$i];
                $fCount->save();
            } //end for

        } // end else

        //Update Multi Image

        if($room->save()){
            $files = $request->multi_img;
            if(!empty($files)){
                $subImage = MultiImage::where('rooms_id', $id)->get()->toArray();
                MultiImage::where('rooms_id', $id)->delete();
            } 
            if(!empty($files)){
                foreach($files as $file){
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/roomimg/multi_img',$imgName);
                    $subImage['multi_img'] = $image;
                    $subImage = new MultiImage();
                    $subImage->rooms_id = $room->id;
                    $subImage->multi_img = $imgName;
                    $subImage->save();
                }
            }
        } //end if

        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End Method

    public function MultiImageDelete($id){
        
        $deleteData = MultiImage::where('id', $id)->first();
        if($deleteData){

            $imagePath = $deleteData->multi_img;

            // Check if the file exists before unlinking
            if(file_exists($imagePath)){
                unlink($imagePath);
                echo "Image Unlink Successfully";
            } else {
                echo "Image dose not exist";
            }

            //Delete the record form database
            MultiImage::where('id', $id)->delete();

        }

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//End Method
    
}
