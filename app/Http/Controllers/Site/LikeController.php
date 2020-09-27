<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    private function counter_likes($id, $infile) {
        try {
            $file_likes = collect(Like::where('ufr_file_id', $id)->get())->countBy('like');


            $like = (isset($file_likes['1'])) ? $file_likes['1'] : 0;
            $dislike = (isset($file_likes['0'])) ? $file_likes['0'] : 0;
            $count_likes_dislikes = $like - $dislike;

            $file = \App\UfrFile::find($id);
            $file->count_likes = $like;
            $file->count_dislikes = $dislike;
            $file->count_likes_dislikes = $count_likes_dislikes;
            $file->save();

            $class = '';
            if ( $count_likes_dislikes < 0 ) {
                $class = 'dislike';
            }
            elseif ($count_likes_dislikes > 0) {
                $class = 'like';
            }

            if ($infile == 1){
                $code = '<span class="like" data-id="' . $id . '"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' . $like . '</span> |  <span data-id="' . $id . '" class="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i> ' . $dislike . '</span>';
            }
            else {
                $code = '<span class="detail"> <span class="like">'.$like.'</span>|<span class="dislike">'.$dislike.'</span></span>';
            }

            return response()->json([
                'status'        => 'accept',
                'code' => $code
            ]);

        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'        => 'error',
                'error' => $e
            ]);
        }
    }
    public function set_like(Request $request, $id) {
        $like = Like::updateOrCreate(
            ['user_id' => Auth::user()->id, 'ufr_file_id' => $id],
        ['like' => true]
        );

        return $this->counter_likes($id, $request->infile);
    }

    public function set_dislike(Request $request, $id) {
        $like = Like::updateOrCreate(
            ['user_id' => Auth::user()->id, 'ufr_file_id' => $id],
            ['like' => false]
        );

        return $this->counter_likes($id, $request->infile);
    }
}
