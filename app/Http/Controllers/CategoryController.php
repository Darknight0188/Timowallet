<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Repository\CategoryEloquentRepository;

class CategoryController extends Controller
{
    protected $catRepo;

    public function __construct(CategoryEloquentRepository $catRepo)
    {
        $this->catRepo = $catRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = $this->catRepo->query()
                            ->where('delete_flag', null)
                            ->get();


        return view('category.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $cat = $this->catRepo->query()
                             ->where('delete_flag',null)
                             ->get();
        $data = [
            'income'=>config('variable.type.income'),
            'outcome'=>config('variable.type.outcome'),
        ];
        $data = json_encode($data);                        
        return view('category.create',compact('cat','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->catRepo->create($data);
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cat = Category::findOrFail($id);
       return view('category.edit', compact('cat'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cat = Category::findOrFail($id);

        $input = $request->all();

        $cat->update($input);

        return redirect('/category');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cat = Category::findOrFail($id);

        $cat->delete();

        return redirect('/category');
    }

}
