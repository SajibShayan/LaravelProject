<?php

namespace App\Http\Controllers;

use App\Models\Brand;
//use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function AllBrand(){

        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){


        

        $brand_image = $request->brand_image;
        $name_gen =  hexdec(uniqid());
        $img_ext = $request->brand_image->getClientOriginalExtension();       
        $img_name = $name_gen.".".$img_ext;
        $up_location = 'public';     
        $last_img = $up_location.$img_name;
        $brand_image->storeAs($up_location, $last_img);
       

        //insert image in database
        Brand::insert([

            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()

        ]);
        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function Edit($id){

         $brands = Brand::find($id);
         return view('admin.brand.edit', compact('brands'));
    }



    public function userLogout(){

        Auth::logout();
        return redirect()->route('login')->with('success', 'User Logout');
    }



























}
