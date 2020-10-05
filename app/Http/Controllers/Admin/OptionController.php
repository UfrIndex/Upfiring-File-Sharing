<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use App\Template;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = Option::find(1);
        $templates = Template::all();
        return view('admin.option.index',  compact('option', 'templates'));
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
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $input = $request->all();
        $input['frontpage_status'] = (isset ($input['frontpage_status'])) ? true : false;
        $input['homepage_first_status'] = (isset ($input['homepage_first_status'])) ? true : false;
        $input['homepage_second_status'] = (isset ($input['homepage_second_status'])) ? true : false;
        $input['homepage_third_status'] = (isset ($input['homepage_third_status'])) ? true : false;
        $input['homepage_fourth_status'] = (isset ($input['homepage_fourth_status'])) ? true : false;
        $input['enable_alternative_table_in_home'] = (isset ($input['enable_alternative_table_in_home'])) ? true : false;
        $input['moderation_status'] = (isset ($input['moderation_status'])) ? true : false;
        $option->fill($input)->save();
        return back()->with('success', 'Advertising management is saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
