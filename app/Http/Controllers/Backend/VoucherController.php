<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Validation\Rule;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get data
        $vouchers = Voucher::select('*');

        $type = 'asc';
         // sort name
         if($request->_sort){
            if($request->type == 'asc'){
                $vouchers = $vouchers->orderBy($request->column,$request->type);
                $type = 'desc';
            }else{
                $vouchers = $vouchers->orderBy($request->column,$request->type);
                $type = 'asc';
            }
        }
        $vouchers = $vouchers->get();

        return view('admin.vouchers.list',compact('vouchers','type'));
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
        $newVoucher = new Voucher();
        $newVoucher->fill($request->all());
        $newVoucher->active_date = date('Y-m-d H:i:s');
        
        $newVoucher->save();

        return redirect()->route('voucher.index')->with('msg-suc','Tạo thành công voucher!');
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
        //get voucher
        $voucher = Voucher::find($id);
        if(!$voucher){
            return back()->with('msg-er','Không tìm thấy mã giảm giá');
        }

        return view('admin.vouchers.edit',compact('voucher'));
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
        if($request->category_code == 0){
            $ruleDiscount = 'required|max:99|integer';
        }else{
            $ruleDiscount = 'required|integer';
        }
        // validate
        $request->validate([
            'name'=>'required|max:30|min:6',
            'code'=>['required','max:30','min:5',Rule::unique('vouchers','code')->ignore($id)],
            'quantity'=>'required|integer',
            'discount'=> $ruleDiscount,
            'expired_date'=>'required',

        ]);

        $voucher = Voucher::find($id);
        if(!$voucher){
            return back()->with('msg-er','Không tìm thấy mã giảm giá');
        }

        $voucher->fill($request->all());
        $voucher->save();

        return back()->with('msg-suc','Cập nhật thành công voucher');
        
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
        $voucher = Voucher::find($id);
        if($voucher){
            Voucher::destroy($id);
            return redirect(route('voucher.index'))->with('msg-suc','Xóa thành công voucher!');
        }
        return redirect()->route('404');
    }
}
