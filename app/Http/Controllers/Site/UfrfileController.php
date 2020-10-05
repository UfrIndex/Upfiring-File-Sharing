<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Option;
use App\Setting;
use App\User;
use App\Http\Controllers\Controller;
use App\UfrFile;
use App\Download;
use App\Library\Torrent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Library\Tablesort;
use Illuminate\Support\Facades\Validator;
use App\Library\Scraper;

class UfrfileController extends Controller
{
    use Tablesort;

    public $trackers = array (
        'udp://trackerinternetwarriors.net:1337',
        'udp://tracker.opentrackr.org:1337',
        'http://bt2.t-ru.org:80',
        'udp://tracker.opentrackr.org:1337',
        'udp://tracker.openbittorrent.com:80',
        'udp://tracker.leechers-paradise.org:6969el33',
        'wss://tracker.fastcast.nzel32',
        'wss://tracker.openwebtorrent.comee7:comment417'
    );

    private $sortBy = 'name';
    private $direction_name = 'asc';
    private $header_script = '';
    private $footer_script = '';
    private $footer = '';

    public function __construct(Request $request)
    {
        if ($request->direction) {
            if ($request->direction == 'desc' or $request->direction == 'asc') {
                $this->direction_name =  $request->direction;
            }
        }
        if ($request->sortBy) {
            if ($request->sortBy == 'name' or $request->sortBy == 'seeders' or $request->sortBy == 'price'  or $request->sortBy == 'size' or $request->sortBy == 'date') {
                $this->sortBy = $request->sortBy;
            }
        }
        $this->header_script =  Setting::where('name', 'header_script')->first()->code;
        $this->footer_script =  Setting::where('name', 'footer_script')->first()->code;
        $this->footer =  Setting::where('name', 'footer')->first()->code;
    }

    private function table_order_by()
    {
        switch ($this->sortBy) {
            case 'seeders':
                return 'seeds';
                break;
            case 'seeders':
                return 'seeds';
                break;
            case 'price':
                return 'price';
                break;
            case 'size':
                return 'size';
                break;
            case 'date':
                return 'created_at';
                break;
            default:
                return 'name';
                break;
        }
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    private function check_image_mime_type($mime) {
        if ($mime == 'image/gif' or $mime == 'image/jpeg' or $mime == 'image/png') {
            return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('new-template', [
            'UfrFiles' => UfrFile::where('visible', '1')->get(),
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count()
        ]);
    }

    public function top_10_files()
    {
        return view('site.ufr-files', [
            'title' => 'Top 10 files',
            'UfrFiles' => UfrFile::where('visible', '1')->limit(10)->orderBy('count_likes_dislikes', 'desc')->paginate(10),
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'sort_disable' => 1,
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    public function top_10_users()
    {
        $files = UfrFile::where('visible', 1)->get();
        $grouped = collect($files)->countBy('user_id');
        $grouped->toArray();
        $arr = $grouped->all();
        arsort($arr);

        $keys =  collect($arr)->keys();
        $users = User::whereIn('id', $keys)->get();


        return view('site.top-users', [
            'top_users' => $users,
            'title' => 'Top uploaders',
            'keys_users_id' => $arr,
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'sort_disable' => 1,
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    public function user_files($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('site.ufr-files', [
            'title' => $user->name,
            'UfrFiles' => UfrFile::where('visible', '1')->where('user_id', $id)->orderBy('count_likes', 'asc')->paginate(10),
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'get_param' => [],
            'sortBy' => $this->sortBy,
            'direction' => $this->direction_name,
            'urlForSort' =>  url()->current() . '?' . $this->getClearUrl(url()->full()),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    private function downloads_files_per_week()
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $top_files_of_the_month = Download::where('created_at','>=',$date)->where('visible', 1)->get();
        $grouped = collect($top_files_of_the_month)->countBy('file_id');
        $grouped->toArray();
        $arr = $grouped->all();
        arsort($arr);
        return $arr;
    }

    private function top_weekly_file_slug($slug = 'movies')
    {
        $downloads_files_per_week = $this->downloads_files_per_week();
        $arr = [];
        $category = Category::where('slug', $slug)->firstOrFail();
        $UfrFiles = $category->ufrfile()->whereIn('id', array_keys($downloads_files_per_week))->get();
        foreach ($downloads_files_per_week as $key=>$value) {
            foreach ($UfrFiles as $file) {
                if ($key == $file->id) {
                    $arr[] = $key;
                }

            }
        }
        return($arr);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.ufr-file-upload', [
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //dd($request->file('ufrfile')->getMimeType(), $request->file('ufrfile')->getClientMimeType());
        $option = Option::find(1);

        Validator::make($request->all(), [
            'name' => 'required|min:3',
            'ufrfile' => 'required|file|mimes:torrent',
            'poster' => 'mimes:jpeg,bmp,png',
            'category' => 'required'
        ])->validate();

        if ($request->file('ufrfile')->getClientOriginalExtension() != 'ufr') {
            $this->validate($request, [
                'ufrfile' => 'required|file|size:1'
            ]);
        }

        try {
            $path = $request->file('ufrfile')->store('ufrfile/'.date("Y/m/d"), 'public');

            $visible = ($option->moderation_status == true ) ? false : true;

            $contents = Storage::disk('public')->get($path);

            $torrent = new Torrent(Storage::disk('public')->url($path));
            $magnet = 'magnet:?xt=urn:btih:'
                . $torrent->hash_info()
                . '&dn=' .  str_replace(" ", "+", substr($this->get_string_between($contents, ':name', '12'),3));

            $seeds_info = $this->get_seeder_lecher($path);

            $seeds = $seeds_info['seeds'];
            $peers = $seeds_info['peers'];

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
                $path_image = '';
            }

            try {
                $info = ($request->input('info')) ? $request->input('info') : $this->get_string_between($contents, '"description":"', '",');
                $name = ($request->input('name')) ? $request->input('name') : $request->file('ufrfile')->getClientOriginalName();
                $slug = Str::slug($name, '-');

                $ufrFile = new UfrFile;
                $ufrFile->user_id = Auth::id();
                $ufrFile->price = $this->get_string_between($contents, '"price":', ',"');
                $ufrFile->pieces = $this->get_string_between($contents, ':pieces', ':');
                $ufrFile->name = $name;
                $ufrFile->slug = $slug;
                $ufrFile->size = $this->get_size($contents);
                $ufrFile->creationdate = $this->get_string_between($contents, 'creation datei', 'e4');
                $ufrFile->owner = $this->get_string_between($contents, '"owner":"', '"}');
                $ufrFile->info = $info;
                $ufrFile->encfile = substr($this->get_string_between($contents, ':name', '12'),3);
                $ufrFile->path = $path;
                $ufrFile->original_file_name = $request->file('ufrfile')->getClientOriginalName();
                $ufrFile->image = $path_image;
                $ufrFile->magnet = $magnet;
                $ufrFile->seeds = $seeds;
                $ufrFile->peers = $peers;
                $ufrFile->visible = $visible;

                if (Auth::user()->ufr_files_access == true) {
                    $ufrFile->visible = true;
                }

                $ufrFile->save();

                if($request->input('category'))
                {
                    $N = count($request->input('category'));
                    for($i=0; $i < $N; $i++)
                    {
                        $ufrFile->categories()->attach($request->input('category')[$i]);
                    }
                }

            }
            catch (\Exception $e)
            {
                abort(405);
                return response()->json([
                    'status'        => 'error',
                    'msg'        => $e->getMessage()
                ]);
            }
            return redirect(route('upload-file.show', $ufrFile->slug));
        }
        catch (\Exception $e)
        {
            abort(405);
            return response()->json([
                'status'        => 'error',
                'msg'        => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $option = Option::find(1);
        $UfrFile = UfrFile::where('slug', $slug)->firstOrFail();

        if ( ! Auth::user()) {
            if ($option->moderation_status == false or $UfrFile->visible == 1 ) {

                $user = User::find($UfrFile->user_id);
                $comments =$UfrFile->comment->where('moderation', 0)->sortBy('created_at');
                return view('site.ufr-file-info', [
                    'UfrFile' => $UfrFile,
                    'user' => $user,
                    'categories' => Category::get(),
                    'count_ufr_files' => UfrFile::where('visible', '1')->count(),
                    'comments' => $comments,
                    'get_param' => [],
                    'header_script' => $this->header_script,
                    'footer_script' => $this->footer_script,
                    'footer' =>  $this->footer,
                    'moderation_status' => $option->moderation_status,
                    'report' => 0,
                ]);
            }
            else {
                abort(404);
            }
        }
        elseif ( $UfrFile->visible == 1 or Auth::user()->role_id > 1 or ( Auth::id() == $UfrFile->user_id ) or $option->moderation_status == false) {
            $user = User::find($UfrFile->user_id);
            $reportCount = $UfrFile->report->where('user_id', Auth::user()->id)->count();
            $comments =$UfrFile->comment->where('moderation', 0)->sortBy('created_at');
            return view('site.ufr-file-info', [
                'UfrFile' => $UfrFile,
                'user' => $user,
                'categories' => Category::get(),
                'count_ufr_files' => UfrFile::where('visible', '1')->count(),
                'comments' => $comments,
                'get_param' => [],
                'header_script' => $this->header_script,
                'footer_script' => $this->footer_script,
                'footer' =>  $this->footer,
                'moderation_status' => $option->moderation_status,
                'report' => $reportCount,
            ]);
        }
        else {
            abort(404);
        }

    }

    public function download_file($slug) {
        try {
            $UfrFile = UfrFile::where('slug', $slug)->firstOrFail();
            $download = new Download;
            $download->file_id = $UfrFile->id;
            $download->save();
            return Storage::disk('public')->download($UfrFile->path , $UfrFile->original_file_name );
        }
        catch (\Exception $e) {
            return redirect()->route('upload-file.show', $slug);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function edit(UfrFile $ufrFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UfrFile $ufrFile)
    {
        //
    }

    public function cron()
    {
        $option = Option::find(1);
        $UfrFilesUpd = UfrFile::where('visible', 1);

        $this->direction_name = 'desc';
        $UfrFilesUpd = $UfrFilesUpd->orderBy('seeds', 'desc');
        $limit = ($option->count_rows_in_alternative_table > 20) ? 20 : $option->count_rows_in_alternative_table;
        $UfrFilesUpd = $UfrFilesUpd->limit($limit)->get();

        foreach ($UfrFilesUpd as $file_for_upd) {
            $UfrFile = UfrFile::where('id', $file_for_upd->id)->first();

            $get_seeder_lecher = $this->get_seeder_lecher($UfrFile->path);
            $UfrFile->seeds = $get_seeder_lecher['seeds'];
            $UfrFile->peers = $get_seeder_lecher['peers'];
            $UfrFile->updated_at = now();
            $UfrFile->save();

        }


        $UfrFile = UfrFile::where('updated_at', UfrFile::min('updated_at'))->limit(10)->get();

        foreach ($UfrFile as $file_for_upd) {
            $file_upd = UfrFile::where('id', $file_for_upd->id)->first();

            $get_seeder_lecher = $this->get_seeder_lecher($file_for_upd->path);
            $file_upd->seeds = $get_seeder_lecher['seeds'];
            $file_upd->peers = $get_seeder_lecher['peers'];
            $file_upd->updated_at = now();
            $file_upd->save();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UfrFile  $ufrFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UfrFile $ufrFile)
    {
        $ufrFile->delete();
        return  redirect()->route('admin.user.index');
    }

    public function delete_file($id)
    {
        $UfrFile = UfrFile::where('id', $id)->first();

        if (Auth::user()->role_id > 1 or Auth::user()->id == $UfrFile->user_id) {
            $UfrFile->delete();
            $accept = ['status'=>'accept'];
        }
        else {
            $accept = ['status'=>'error'];
        }

        return (json_encode($accept));
    }


    public function update_seeders_info($id)
    {
        $UfrFile = UfrFile::find($id);

        $get_seeder_lecher = $this->get_seeder_lecher($UfrFile->path);
        $answer = [
            'answer' => true,
            'data' => [
                'seeds' => $get_seeder_lecher['seeds'],
                'peers' => $get_seeder_lecher['peers']
            ]
        ];
        $UfrFile->seeds = $get_seeder_lecher['seeds'];
        $UfrFile->peers = $get_seeder_lecher['peers'];
        $UfrFile->save();

        return $answer;
    }

    public function update_file_update()
    {
        $UfrFilesUpd = UfrFile::all();
        foreach ($UfrFilesUpd as $file_for_upd) {
            if (Storage::disk('public')->exists($file_for_upd->path)) {
                $contents = Storage::disk('public')->get($file_for_upd->path);

                $size = $this->get_size($contents);

                $UfrFile = UfrFile::where('id', $file_for_upd->id)->first();
                $UfrFile->size = $size;
                $UfrFile->save();
            }
        }
    }

    public function file_update()
    {
        $option = Option::find(1);

        $UfrFilesUpd = UfrFile::whereIn('visible', [0,1]);


        $this->direction_name = 'desc';
        $UfrFilesUpd = $UfrFilesUpd->orderBy('seeds', 'desc');

        $UfrFilesUpd = $UfrFilesUpd->limit($option->count_rows_in_alternative_table)->get();

        foreach ($UfrFilesUpd as $file_for_upd) {
            if (Storage::disk('public')->exists($file_for_upd->path)) {
                $get_seeder_lecher = $this->get_seeder_lecher($file_for_upd->path);
                $UfrFile = UfrFile::where('id', $file_for_upd->id)->first();
                $UfrFile->seeds = $get_seeder_lecher['seeds'];
                $UfrFile->peers = $get_seeder_lecher['peers'];
                $UfrFile->save();
            }
        }
    }

    public function get_seeder_lecher($path)
    {
        $torrent = new Torrent(Storage::disk('public')->url($path));
        $scraper = new Scraper();
        $hash_info = $torrent->hash_info();
        $seeders_info = $scraper->scrape([$hash_info], $this->trackers);

        $seeds = (isset($seeders_info[$hash_info]['seeders'])) ? $seeders_info[$hash_info]['seeders'] : 0;
        $leechers = (isset($seeders_info[$hash_info]['leechers'])) ? $seeders_info[$hash_info]['leechers'] : 0;
        return [ 'seeds' => $seeds, 'peers' => $leechers ];
    }

    public function get_size($cotent_file)
    {
        $allsize = 0;
        preg_match_all("/lengthi(.*?)e4/",
            $cotent_file,
            $out);
        foreach ($out[1] as $size) {

            $allsize += $size / 1000000;
        }
        return round( $allsize, 0 );
    }

}
