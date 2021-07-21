<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //API 
    //Show catelofy
    public function showCatelory()
    {

        return response()->json(Category::all(), 200);
    }
    //Update catelory
    public function updateCatelory(Request $request, $id)
    {
        $catelory = Category::findOrFail($id);
        if (!empty($catelory)) {
            $catelory->update($request->all());
            //200 OK(The request has successed)
            return response()->json($catelory, 200);
        }
    }
    //Delete catelory
    public function deleteCatelory($id)
    {
        $catelory = Category::findOrFail($id);
        $catelory->delete();
        //204 No content
        return response()->json("Delete Success", 201);
    }
    //Add catelory 
    public function addCatelory(Request $request)
    {
        $request->validate([
            'title' => 'string|required|max:50|unique:category,title',
            'description' => 'string|nullable',
        ]);
        $data = $request->all();
        $catelory = Category::create($data);
        return response()->json($catelory, 201);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Category::orderBy('id', 'DESC')->get();
        return view('backend.banner.index')->with('banners', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'description' => 'string|nullable',
        ]);
        $data = $request->all();
        $status = Category::create($data);
        if ($status) {
            request()->session()->flash('success', 'Banner successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred while adding banner');
        }
        return redirect()->route('catelory.index');
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
        $category = Category::findOrFail($id);
        return view('backend.banner.edit')->with('category', $category);
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
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'description' => 'string|nullable',
        ]);
        $data = $request->all();
        // $slug=Str::slug($request->title);
        // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
        // $data['slug']=$slug;
        // return $slug;

        $status = $category->fill($data)->save();
        if ($status) {
            return redirect()->route('catelory.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('catelory.index');
    }
}
