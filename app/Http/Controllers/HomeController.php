<?php

namespace App\Http\Controllers;

use App\Category;
use App\Download;
use App\Mail\Contact;
use App\Mail\ContactEmail;
use App\Option;
use App\Setting;
use App\UfrFile;
use Illuminate\Http\Request;
use App\Library\Tablesort;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    use Tablesort;

    private $sortBy = 'name';
    private $direction_name = 'asc';
    private $header_script = '';
    private $footer_script = '';
    private $footer = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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


    private function table_order_by_in_homepage()
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
                return 'seeds';
                break;
        }
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function downloads_files_per_week($moderation_status=1)
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $top_files_of_the_month = Download::where('created_at','>=',$date);
        if ($moderation_status == true) {
            $top_files_of_the_month = $top_files_of_the_month->where('visible', 1)->get();
        }
        else {
            $top_files_of_the_month = $top_files_of_the_month->get();
        }

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

    private function alternative_home_table(Request $request) {

        $option = Option::find(1);
        if ($option->moderation_status == true) {
            $UfrFiles = UfrFile::where('visible', 1);
        }
        else {
            $UfrFiles = UfrFile::whereIn('visible', [0,1]);
        }

        if ( $request->input('sortBy')) {
            $this->sortBy = $request->input('sortBy');
        }
        else {
            $this->sortBy = 'seeders';
        }
        $this->direction_name = 'desc';
        $UfrFiles = $UfrFiles->orderBy($this->table_order_by_in_homepage(), $this->direction_name);

        $UfrFiles = $UfrFiles->limit($option->count_rows_in_alternative_table)->get();

        if ($option->moderation_status == true) {
            $count_ufr_files = UfrFile::where('visible', '1')->count();
        }
        else {
            $count_ufr_files = UfrFile::count();
        }

        return view('site.ufr-files', [
            'title' => 'Browse UFR Files',
            'UfrFiles' => $UfrFiles,
            'categories' => Category::get(),
            'count_ufr_files' => $count_ufr_files,
            'sortBy' => $this->sortBy,
            'direction' => $this->direction_name,
            'urlForSort' =>  url()->current() . '?' . $this->getClearUrl(url()->full()),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    private function top_rating_of_the_week(Request $request) {

        $option = Option::find(1);
        if ($option->enable_alternative_table_in_home == true) {
            return $this->alternative_home_table($request);
        }

        $downloads_files_per_week = $this->downloads_files_per_week($option->moderation_status);
        $top_movies_ids = $this->top_weekly_file_slug('movies');
        $top_games_ids = $this->top_weekly_file_slug('games');

        $keys_top = collect($downloads_files_per_week)->keys();
        $keys_top_files = collect(array_slice($downloads_files_per_week, 0, 25, true))->keys();

        if ($option->moderation_status == true) {
            $top_movies = UfrFile::where('visible', 1)->whereIn('id', $top_movies_ids)->get();
            $top_games = UfrFile::where('visible', 1)->whereIn('id', $top_games_ids)->get();
            $last_upload = UfrFile::where('visible', 1)->orderBy('created_at', 'desc')->limit(25)->get();
            $topFiles = UfrFile::where('visible', 1)->whereIn('id', $keys_top_files)->get();
            $count_ufr_files = UfrFile::where('visible', '1')->count();
        }
        else {
            $top_movies = UfrFile::whereIn('id', $top_movies_ids)->get();
            $top_games = UfrFile::whereIn('id', $top_games_ids)->get();
            $last_upload = UfrFile::orderBy('created_at', 'desc')->limit(25)->get();
            $topFiles = UfrFile::whereIn('id', $keys_top_files)->get();
            $count_ufr_files = UfrFile::count();
        }

        return view('site.partials.home_page', [
            'topFiles' => $topFiles,
            'keys_top_files' => $keys_top_files,
            'categories' => Category::get(),
            'count_ufr_files' => $count_ufr_files,
            'top_movies' => $top_movies,
            'top_games' => $top_games,
            'keys_top' => $keys_top,
            'last_upload' => $last_upload,
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    private function frontpage($files) {

        $option = Option::find(1);

        $downloads_files_per_week = $this->downloads_files_per_week($option->moderation_status);

        $top_movies_ids = $this->top_weekly_file_slug('movies');


        $top_games_ids = $this->top_weekly_file_slug('games');


        $keys_top = collect($downloads_files_per_week)->keys();
        $keys_top_files = collect(array_slice($downloads_files_per_week, 0, 5, true))->keys();



        if ($option->moderation_status == true) {
            $top_movies = UfrFile::where('visible', 1)->whereIn('id', $top_movies_ids)->get();
            $top_games = UfrFile::where('visible', 1)->whereIn('id', $top_games_ids)->get();
            $last_upload = UfrFile::where('visible', 1)->orderBy('created_at', 'desc')->limit(5)->get();
            $topFiles = UfrFile::where('visible', 1)->whereIn('id', $keys_top_files)->get();
            $count_ufr_files = UfrFile::where('visible', '1')->count();
        }
        else {
            $top_movies = UfrFile::whereIn('id', $top_movies_ids)->get();
            $top_games = UfrFile::whereIn('id', $top_games_ids)->get();
            $last_upload = UfrFile::orderBy('created_at', 'desc')->limit(5)->get();
            $topFiles = UfrFile::whereIn('id', $keys_top_files)->get();
            $count_ufr_files = UfrFile::count();
        }

        return view('home', [
            'topFiles' => $topFiles,
            'keys_top_files' => $keys_top_files,
            'categories' => Category::get(),
            'count_ufr_files' => $count_ufr_files,
            'home' => '1',
            'top_movies' => $top_movies,
            'top_games' => $top_games,
            'keys_top' => $keys_top,
            'last_upload' => $last_upload,
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' => $this->footer,
            'files' => $files,
        ]);
    }

    public function index(Request $request)
    {
        $option = Option::find(1);


        if ($option->frontpage_status == true && (url()->full() == route('home')) ) {
            if ($option->moderation_status == true) {
                $UfrFiles = UfrFile::where('visible', 1);
            }
            else {
                $UfrFiles = UfrFile::whereIn('visible', [0,1]);
            }

            if ( $request->input('sortBy')) {
                $this->sortBy = $request->input('sortBy');
            }
            else {
                $this->sortBy = 'seeders';
            }
            $this->direction_name = 'desc';
            $UfrFiles = $UfrFiles->orderBy($this->table_order_by_in_homepage(), $this->direction_name);

            $UfrFiles = $UfrFiles->limit($option->count_rows_in_alternative_table)->get();
            return $this->frontpage($UfrFiles);
        }
        else {
            return $this->top_rating_of_the_week($request);
        }
    }



    public function search(Request $request)
    {
        if (! $request->s and  ! $request->category) {
            return $this->top_rating_of_the_week($request);
        }

        $search = ($request->s) ? $request->s : 'All';
        if (request()->expectsJson()) {
            return response()->json([
                'status'        => 'api'
            ]);
        }

        if ($request->category == 'all') {
            $request->category = null;
        }

        if ( $request->s && $request->category ) {
            $category = Category::find($request->category);
            if($category) {
                $UfrFiles = $category->ufrfile()->where('name', 'like', '%' . $request->s . '%')->where('visible', 1)->orderBy($this->table_order_by(), $this->direction_name)->paginate(10);
            }
            $get_params = ['s' => $request->s, 'category' => $request->category];
            //
        }
        elseif ( $request->s && $request->s != null ){
            $UfrFiles = UfrFile::where('name', 'like', '%' . $request->s . '%')->where('visible', 1)->orderBy($this->table_order_by(), $this->direction_name)->paginate(10);
            $get_params = ['s' => $request->s];
        }
        elseif ( $request->category ){
            $category = Category::find($request->category);
            if($category) {
                $UfrFiles = $category->ufrfile()->where('visible', 1)->orderBy($this->table_order_by(), $this->direction_name)->paginate(10);
            }
            $get_params = ['category' => $request->category];
        }
        else {
            $UfrFiles = UfrFile::where('visible', 1)->orderBy($this->table_order_by(), $this->direction_name)->paginate(10);
            $get_params = ['category' => 'all'];
        }
        return view('site.ufr-files', [
            'title' => 'Search: '. $search,
            'UfrFiles' => $UfrFiles,
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'get_param' => $get_params,
            'sortBy' => $this->sortBy,
            'direction' => $this->direction_name,
            'urlForSort' =>  url()->current() . '?' . $this->getClearUrl(url()->full()),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }


    public function admin_index()
    {
        return view('admin.index');
    }

    public function sendMail(Request $request) {
        Mail::to('support@upfiring.com')->send(new ContactEmail($request->input('name'), $request->input('email'),  $request->input('message')));
        return back()->with('success', 'Message sent');
    }

    public function sendMailForm() {
        return view('682-template',[
            'page' => '',
            'categories' => [],
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }
}
