<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list
        $listBrand = Brand::all();

        return view('admin.brand.list',compact('listBrand'));
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
        $request->validate([
            "name"=>"required|unique:brands",
            "avatar" => "required|image|mimes:jpg,png,jpeg|max:2040",
        ]);

        $fileName = uniqid() . '-brand' . time() . '.' . $request->avatar->extension();
        $request->file('avatar')->move(public_path('uploads'), $fileName);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->avatar = $fileName;
        $brand->save();

        return redirect(route('brand.index'))->with('msg-suc','Add success!');
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
        if(Brand::find($id)){
            Brand::destroy($id);
            return redirect(route('brand.index'))->with('msg-suc','Remove success');
        }
        return redirect(route('brand.index'))->with('msg-er','Remove fail!');
    }
}
