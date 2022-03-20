<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data
        $listAttr = Attribute::all();
        $list_attr_value = AttributeValue::select('attr_values.*','attributes.name as attr_name')
                                            ->join('attributes','attributes.id','attr_values.attr_id')
                                            ->get();
        //check attributes > 0 => btn add attrValue disable? 
        $btnStatus = '';
        if($listAttr->count() == 0){
            $btnStatus = 'disabled';
        }
        return view('admin.attribute.list', compact('listAttr','list_attr_value','btnStatus'));
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
            'name' => 'required|unique:attributes'
        ]);

        $attr = new Attribute();
        $attr->name = $request->input('name');

        $attr->save();
        return redirect()->route('attribute.index')->with('msg','Thêm thành công thuộc tính mới');

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
        if($id != 1 && $id != 2){
            // dat color va size la 2 thuoc tinh mac dinh ko the xoa
            Attribute::destroy($id);
            return redirect()->route('attribute.index')->with('msg','Xóa thành công 1 thuộc tính');
        }else{
            return back()->with('msg','Xóa khong công thuộc tính');
        }
    }
}
