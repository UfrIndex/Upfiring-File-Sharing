<?php

namespace App\Http\Controllers\Admin;

use App\Download;
use App\Http\Controllers\Controller;
use App\UfrFile;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesController extends Controller
{

    private function multiselect_change_visible($arr, $status)
    {
        $status = ($status == 'show') ? 1 : 0;
        foreach ($arr as $id) {
            UfrFile::where('id', $id)->update(['visible' => $status]);
        }
    }

    private function multiselect_delete($arr)
    {
        foreach ($arr as $id) {
            $this->destroy($id);
        }
    }

    private function create_get_param(Request $request) {
        if ($request->show and $request->find){
            return ['show' => $request->show, 'find' => $request->find];
        }
        elseif ($request->show) {
            return ['show' => $request->show];
        }
        elseif ($request->find) {
            return ['find' => $request->find];
        }
        else {
            return [];
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ufrFiles = UfrFile::orderBy('visible', 'desc');
        if ($request->show) {
            if ($request->show == 'hidden') {
                $ufrFiles = $ufrFiles->where('visible', 0);
            }
            elseif ($request->show == 'show') {
                $ufrFiles = $ufrFiles->where('visible', 1);
            }
        }

        if ($request->find){
            $ufrFiles = $ufrFiles->where('name', 'like', '%' . $request->find . '%');
        }

        $get_param = $this->create_get_param($request);

        $ufrFiles = $ufrFiles->paginate(25);

        return view('admin.files.index',[
            'ufrFiles' => $ufrFiles,
            'show' => $request->show,
            'find' => $request->find,
            'get_param' => $get_param
        ]);
    }

    public function approved(Request $request) {
        $ufrFiles = UfrFile::orderBy('visible', 'desc');
        $ufrFiles = $ufrFiles->where('visible', 1);


        if ($request->find){
            $ufrFiles = $ufrFiles->where('name', 'like', '%' . $request->find . '%');
        }

        $get_param = $this->create_get_param($request);

        $ufrFiles = $ufrFiles->paginate(25);

        return view('admin.files.index',[
            'ufrFiles' => $ufrFiles,
            'show' => $request->show,
            'find' => $request->find,
            'get_param' => $get_param
        ]);
    }

    public function forapproval(Request $request) {
        $ufrFiles = UfrFile::orderBy('visible', 'desc');

        $ufrFiles = $ufrFiles->where('visible', 0);

        if ($request->find){
            $ufrFiles = $ufrFiles->where('name', 'like', '%' . $request->find . '%');
        }

        $get_param = $this->create_get_param($request);

        $ufrFiles = $ufrFiles->paginate(25);

        return view('admin.files.index',[
            'ufrFiles' => $ufrFiles,
            'show' => $request->show,
            'find' => $request->find,
            'get_param' => $get_param
        ]);
    }

    private function check_image_mime_type($mime) {
        if ($mime == 'image/gif' or $mime == 'image/jpeg' or $mime == 'image/png') {
            return true;
        }
        return false;
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
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function show(UfrFile $ufrFile)
    {


        return view('admin.pages.edit')->
        with('page', $ufrFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function edit($ufrFile)
    {
        $file = UfrFile::find($ufrFile);
        return view('admin.files.edit')->
        with('file', $file);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ufrFile)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $file = UfrFile::find($ufrFile);

        if ( $file->name != $request->input('name')) {
            $file->name = $request->input('name');
            $file->slug = Str::slug($request->input('name'), '-');
        }

        if ( $request->file('poster') ) {
            if ( ! $this->check_image_mime_type( $request->file('poster')->getMimeType() ) ) {
                return response()->json([
                    'status'        => 'error',
                    'msg'        => 'This image type is not supported.'
                ]);
            }

            $path_image = $request->file('poster')->storeAs('poster/'.date("Y/m/d"), Str::random(6) . '-' . $request->file('poster')->getClientOriginalName(), 'public');
        }
        else {
            $path_image = $file->image;
        }

        if ($request->visible) {
            $file->visible = true;
            Download::where('file_id', $file->id)->update(['visible' => true]);
        }
        else {
            $file->visible = false;
            Download::where('file_id', $file->id)->update(['visible' => false]);
        }
        $file->image = $path_image;
        $file->info = $request->input('info');
        $file->save();


        return redirect()->route('admin.files.index');
    }

    public function multiselect(Request $request) {
        if ($request->action) {
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
        return redirect()->route('admin.files.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function destroy($ufrFile)
    {
        try {
            $file = UfrFile::find($ufrFile);
            $file->delete();
        }
        catch (\Exception $e) {

        }
        return redirect()->back();
    }
}
