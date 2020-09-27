<?php

namespace App\Http\Controllers\Admin;

use App\Advertising;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertising = Advertising::find(1);
        return view('admin.advertising.index', compact('advertising'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function show(Advertising $advertising)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertising $advertising)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertising $advertising)
    {
        $input = $request->all();

        $input['enable_content_top'] = (isset ($input['enable_content_top'])) ? true : false;
        $input['show_homepage_content_top'] = (isset ($input['show_homepage_content_top'])) ? true : false;
        $input['enable_banner_top'] = (isset ($input['enable_banner_top'])) ? true : false;
        $input['show_homepage_banner_top'] = (isset ($input['show_homepage_banner_top'])) ? true : false;
        $input['enable_banner_banner_left_and_right'] = (isset ($input['enable_banner_banner_left_and_right'])) ? true : false;
        $input['show_homepage_banner_left_and_right'] = (isset ($input['show_homepage_banner_left_and_right'])) ? true : false;
        $advertising->fill($input)->save();
        return back()->with('success', 'Advertising management is saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertising $advertising)
    {
        //
    }
}
