<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Auth::user();
        $shop_id = 1;
        $settings = settings::where("shop_id" ,  $shop_id)->first();
  
        return view('settings', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $display_device = "";
        foreach ($request['display_device'] as $key => $value) {
         $display_device .=  $value ."";
        }
        $shop = Auth::user();
        $shop_id = 1;
        $storeDet = settings::firstOrNew(array('id' => $request['id']));
        $storeDet->display_device = $display_device;
        $storeDet->custom_css = $request['custom_css'];
        $storeDet->custom_js = $request['custom_js'];
        $storeDet->shop_id =  $shop_id;
        $storeDet->save();
        return Redirect::tokenRedirect('settings', ['notice' => 'Congratulations ! Your Setting has been saved']);
         
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(settings $settings)
    {
        //
    }
}