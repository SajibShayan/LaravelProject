<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AllCat(){

        // //created relation between categories and users table by query builder
        // $categories = DB::table('categories')
        //           ->join('users', 'categories.user_id', 'users.id')
        //           ->select('categories.*', 'users.name')->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trachCat = Category::onlyTrashed()->latest()->paginate(5);
        //$categories = DB::table('categories')->paginate(5);

        return view('admin.category.index', compact('categories', 'trachCat'));
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
    public function Edit($id){

 
        //find data by eloquent orm
        $categories = Category::find($id);
        
        //find data by query builder
        //$categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit', compact('categories'));

    }
    public function Update(Request $request, $id){

        //updated data by eloquent orm
        $update = Category::find($id)->update([

            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,

        ]);

        //updated data by query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->where('id', $id)->update($data);

        return redirect()->route('all.category')->with('success', 'Category Updated Successfully');

    }

    public function SoftDelete($id){

        $delete = Category::find($id)->delete();

        return redirect()->back()->with('success', 'Category Remove Successfully');
    }
    public function Restore($id){

        $delete = Category::withTrashed($id)->find($id)->restore();
        return redirect()->back()->with('success', 'Category Restore Successfully');
    }
    public function Delete($id){
        $delete = Category::onlyTrashed($id)->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Category Delete Permanently');
    }
}