<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Voucher;
use App\Models\Product;

class AjaxController extends Controller
{
    // check attribute value exist[form add attribute]
    public function attrValueExist(Request $rq)
    {
        if ($rq->ajax()) {

            // trong 1 attribtue chỉ có 1 thuộc tính duy nhất(méo cho trùng tên thuộc tính)
            $qr = AttributeValue::where('attr_values.value', $rq->value)
                ->join('attributes', 'attributes.id', 'attr_values.attr_id')
                ->where('attributes.id', $rq->attr_id)
                ->count();
            if ($qr > 0) {
                return 1;
            }
            return 0;
        }
    }

    // form modal add voucher , check exist voucher
    function voucherExist(Request $request)
    {

        if ($request->ajax()) {

            $voucherExist = Voucher::where('code', $request->code)->first();
            if ($voucherExist) {
                return 'exist';
            }
            return 'not-exist';
        }
    }

    // get child category by parent id -> render in menu child header
    public function getChildCategoryByParentId(Request $request)
    {

        if ($request->ajax()) {

            $childCategories = Category::where('parent_id', $request->id)->get();
            return $childCategories;
        }
        return ' ko cos ajax';
    }

    // ajax.changeStatusProduct'
    public function changeStatusProduct(Request $request): int
    {
        if ($request->ajax()) {
            $productUpdate = Product::find($request->proId);
            $productUpdate->status = $request->status;
            $productUpdate->save();
            return 1;
        }
        return 0;
    }

    // render tinh thanh viet nam in checkout
    public function renderGeography(Request $request)
    {
        if ($request->ajax()) {

            // render district
            if ($request->provinceId) {
                $districts = District::where('provinceid', "$request->provinceId")->get();
                $html = '<option selected disabled>----Chọn quận huyện----</option>';
                foreach ($districts as $val) {
                    $html .= '
                    <option value="' . $val->districtid . '">' . $val->name . '</option>
                ';
                }
                return $html;
            }

            // render ward
            if ($request->districtId) {
                $wards = Ward::where('districtid', "$request->districtId")->get();
                $html = '<option selected disabled>----Chọn phường xã----</option>';
                foreach ($wards as  $val) {
                    $html .= '
                            <option value="' . $val->wardid . '">' . $val->name . '</option>
                        ';
                }

                return $html;
            }
        }
    }
}
