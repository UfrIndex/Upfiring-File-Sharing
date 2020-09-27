<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    private function multiselect_change_visible($arr, $status)
    {
        $status = ($status == 'show') ? 0 : 1;
        foreach ($arr as $id) {
            Comment::where('id', $id)->update(['moderation' => $status]);
        }
    }

    private function multiselect_delete($arr)
    {
        foreach ($arr as $id) {
            $file = Comment::find($id);
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
        return view('admin.comments.index',[
            'comments' => Comment::orderBy('moderation', 'asc')->paginate(25)
        ]);
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
        try {
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->ufr_file_id = $request->input('ufr_files_id');
            $comment->comment = $request->input('comment');
            if ((Auth::user()->comments_access) == true) {
                $comment->moderation = 0;
            }
            else {
                $comment->moderation = 1;
            }
            $comment->save();

            if ((Auth::user()->comments_access) == true) {

                return response()->json([
                    'status'        => 'accept',
                    'comment' => '<li><div class="community-post"><div class="post-content"><h5>'. Auth::user()->name .'<span> '.date("F d, Y").'</span></h5> <p>'. $request->input('comment') .'</p></div></div></li>'
                ]);
            } else {
                return response()->json([
                    'status'        => 'accept',
                    'comment' =>  '<li><div class="community-post"><div class="post-content"><h5>Comment will be published after being moderated</h5> <p>'. $request->input('comment') .'</p></div></div></li>'
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'        => 'error',
                'error' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit')->
        with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->comment = $request->comment;
        if ($request->moderation) {
            $comment->moderation = false;
        }
        else {
            $comment->moderation = true;
        }
        $comment->save();

        return redirect()->route('admin.comments.index');
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
        return redirect()->route('admin.comments.index');
    }

    public function change_status(Comment $comment) {
        if ($comment->moderation == false) {
            $comment->moderation = true;
            $btn = '<a href="#" class="btn btn-outline-secondary btn-sm change-comment-status" data-id="' . $comment->id . '"><i class="mdi mdi-eye-off"></i></a>';
        }
        else {
            $comment->moderation = false;
            $btn = '<a href="#" class="btn btn-outline-success btn-sm change-comment-status" data-id="' . $comment->id . '"><i class="mdi mdi-eye"></i></a>';
        }
        $comment->save();
        return $btn;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
}
