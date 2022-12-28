<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function AdminContact(){

        $contacts = Contact::latest()->paginate(5);

        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact(){

        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request){

        $store =  Contact::insert([

              'email' => $request ->email,
              'phone' => $request ->phone,
              'address' => $request->address,
              'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');
    }

 
    public function AdminEditContact($id){

        $contacts = Contact::find($id);
         return view('admin.contact.edit', compact('contacts'));
    }

    public function AdminUpdateContact(Request $request, $id){

           $update = Contact::find($id)->update([

            'email' => $request ->email,
              'phone' => $request ->phone,
              'address' => $request->address,

           ]);
           return redirect()->route('admin.contact')->with('success', 'Contact Updated Successfully');
    }

    public function AdminDeleteContact($id){

        $delete = Contact::find($id)->delete();
        return redirect()->back()->with('success', 'Contact Deleted Successfully');
    }

    public function Contact(){

        $contacts = Contact::first();
        return view('layouts.pages.contact', compact('contacts'));
    }


}
