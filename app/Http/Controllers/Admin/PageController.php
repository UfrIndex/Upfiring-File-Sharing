<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    private function multiselect_change_visible($arr, $status)
    {
        $status = ($status == 'show') ? 1 : 0;
        foreach ($arr as $id) {
            Page::where('id', $id)->update(['published' => $status]);
        }
    }

    private function multiselect_delete($arr)
    {
        foreach ($arr as $id) {
            $file = Page::find($id);
            $file->delete();
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id != 3) {
            abort(404);
        }
        return view('admin.pages.index',[
            'pages' => Page::orderBy('title', 'asc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Page::create($request->all());
        return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit')->
        with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {

        $input = $request->all();
        $page->fill($input)->save();
        return back()->with('success', 'Advertising management is saved!');
    }

    public function multiselect(Request $request) {
        if ($request->action && is_array($request->checkbox_ids)) {
            switch ($request->action) {
                case 'hide':
                    $this->multiselect_change_visible($request->checkbox_ids, 'hide');
                    break;
                case 'show':
                    $this->multiselect_change_visible($request->checkbox_ids, 'show');
                    break;
                case 'delete':
                    $this->multiselect_delete($request->checkbox_ids);
                    break;
            }
        }
        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index');
    }
}
