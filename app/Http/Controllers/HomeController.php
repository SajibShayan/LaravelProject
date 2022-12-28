<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function HomeSlider(){

        $sliders = slider::latest()->paginate(5);
        //$sliders = DB::table('sliders')->get();

        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider(){

        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){

        $slider_image = $request->image;
        $name_gen =  hexdec(uniqid());
        $img_ext = $request->image->getClientOriginalExtension();       
        $img_name = $name_gen.".".$img_ext;
        $up_location = 'public';     
        $last_img = $up_location.$img_name;
        $slider_image->storeAs($up_location, $last_img);
       

        //insert image in database
        slider::insert([

            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()

        ]);
        return redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');

    }
}
