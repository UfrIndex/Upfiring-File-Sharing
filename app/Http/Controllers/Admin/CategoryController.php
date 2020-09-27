<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Library\Tablesort;
use App\Setting;
use App\UfrFile;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Tablesort;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $UfrFiles = $category->ufrfile()->orderBy($this->table_order_by(), $this->direction_name)->paginate(10);

        return view('site.ufr-files', [
            'title' => 'Category: ' . ucfirst($slug),
            'UfrFiles' => $UfrFiles,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
