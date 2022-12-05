<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){

        // //created relation between categories and users table by query builder
        // $categories = DB::table('categories')
        //           ->join('users', 'categories.user_id', 'users.id')
        //           ->select('categories.*', 'users.name')->paginate(5);

        $categories = Category::paginate(5);
        //$categories = DB::table('categories')->paginate(5);

        return view('admin.category.index', compact('categories'));
    }
    public function AddCat(Request $request){

        //Data inserted by eloquent orm 
    //    Category::insert([
    //     'category_name' => $request->category_name,
    //     'user_id' => Auth::user()->id,
    //     'created_at' => Carbon::now(),
    //    ]);
 //Data inserted by eloquent orm also by creating object
     $category = new Category();
     $category ->category_name = $request->category_name;
     $category->user_id = Auth::user()->id;
     $category->save();

     //data inserted by quiry builder 
    // $data = array();
    // $data['category_name'] = $request->category_name;
    // $data['user_id'] = Auth::user()->id;
    // DB::table('categories')->insert($data);

     return redirect()->back()->with('success', 'Category Inserted Successfully');


    }
}