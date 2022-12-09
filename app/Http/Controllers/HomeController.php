<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
class HomeController extends Controller
{
    
    public function HomeSlider(){

        $sliders = slider::latest()->get();

        return view('admin.slider.index', compact('sliders'));
    }
}
