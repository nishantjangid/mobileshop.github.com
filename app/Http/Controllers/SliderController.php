<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slider = slider::all();
        return view('admin-area/master')->with('slider',$slider);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $fileName = time().'_'.$request->file('slider_image')->getClientOriginalName();
        $slider_image = $request->file('slider_image')->storeAs('productImages', $fileName, 'public');
        $slider = new Slider;
        $slider->slider_title = $request->slider_title;
        $slider->slider_url = $request->slider_url;
        $slider->slider_image = $slider_image;
        $slider->save();
        return redirect('admin-area/view-slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(slider $slider)
    {
        //
        return view('admin-area/master')->with('slider',$slider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(slider $slider)
    {
        //
        return view('admin-area/edit-slider')->with('slider', $slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, slider $slider)
    {
        //
        // return $slider->slider_title;
        if($request->slider_image == ""){
            return "no image";
            $slider->update([
                'slider_title'=>$request->slider_title,
                'slider_url'=>$request->slider_url
            ]);

        }else{

            $fileName = time().'_'.$request->file('slider_image')->getClientOriginalName();
            $slider_image = $request->file('slider_image')->storeAs('productImages', $fileName, 'public');
            
            $slider->update([
                'slider_title'=>$request->slider_title,
                'slider_image'=>$slider_image,
                'slider_url'=>$request->slider_url
            ]);
        }
        return redirect('admin-area/view-slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(slider $slider)
    {
        //
        $slider->delete();
        return redirect('admin-area/view-slider');
    }
}
