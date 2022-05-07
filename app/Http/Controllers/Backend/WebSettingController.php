<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    // man hinh cap nhat thong tin
    public function edit()
    {
        // get data
        $settings = WebSetting::first();
        return view('admin.pages.websettings', compact('settings'));
    }

    // action update thong tin chung website
    public function update(Request $request)
    {
        if($request->file('avatar')){
            $ruleLogoEdit = "required|image|mimes:jpg,png,jpeg|max:2040";
        }else{
            $ruleLogoEdit = 'nullable';
        }
        $request->validate(
            [
                'web_name' => 'required|min:3|max:15', 'intro_title' => 'required|min:12|max:225', 'intro_content' => 'required|min:225', 
                'logo' => $ruleLogoEdit,
                'fb_url' => 'required',
                'insta_url' => 'required',
                'twitter_url' => 'required', 'pinterest_url' => 'required'
            ],
            [
                'required' => 'Không được phép để trống!',
                'web_name.min' => 'Tên website ít nhất 3 kí tự!',
                'intro_title.min' => 'Tiêu đề giới thiệu ít nhất 3 kí tự!',
                'intro_content.min' => 'Nội dung giới thiệu ít nhất 3 kí tự!',
            ]
        );

        // update
        $settings =  WebSetting::first();
        $settings->fill($request->all());
        if($request->file('logo')){
            $logoName = uniqid() . '-logo' . time() . '.' . $request->logo->extension();
            $settings->logo = $logoName;
        }
        $settings->intro_content = 'Chào mừng đến với KOODING.com, thị trường toàn cầu trực tuyến hàng đầu. Mục tiêu của chúng tôi là không chỉ kết nối mọi người trên toàn cầu thông qua tình yêu của họ với phong cách Hàn Quốc mà còn mang đến khả năng tiếp cận ngay với thời trang nữ Hàn Quốc mới nhất, thời trang nam Hàn Quốc, các sản phẩm và thương hiệu làm đẹp của Hàn Quốc trên toàn thế giới với chi phí thấp nhất và không rắc rối vận chuyển trên toàn thế giới. Trên tất cả, chúng tôi cố gắng cung cấp cho cộng đồng KOODING những sản phẩm cao cấp được tìm thấy tại các cửa hàng Hàn Quốc với giá cả phải chăng nhất.

        KOODING cung cấp những mặt hàng quần áo châu Á trực tuyến tốt nhất và là nơi có thể mua sắm bất cứ thứ gì liên quan đến thời trang Hàn Quốc. Từ thời trang đường phố đến quần áo hàng hiệu cao cấp, chúng tôi giúp việc mua sắm trực tuyến của người Hàn Quốc trở nên dễ dàng hơn bao giờ hết. Tại đây, bạn có thể tìm thấy mọi thứ, từ áo hoodie và áo nỉ thoải mái, những chiếc váy đáng yêu, áo khoác và áo len cổ lọ sành điệu và ấm áp, cùng những chiếc quần jean và quần âu mới yêu thích của bạn. Chúng tôi mang các thương hiệu quần áo Hàn Quốc đích thực như Chuu, NANING9, Cherrykoko, BASIC HOUSE, MIND BRIDGE, OPEN THE DOOR, REDHOMME, v.v. Bất kể phong cách ưa thích của bạn là gì, bạn chắc chắn có thể tìm thấy trang phục mơ ước của mình với những bộ quần áo đến từ Hàn Quốc này.
        
        KOODING không chỉ là một cửa hàng thời trang trực tuyến của Hàn Quốc; trên thực tế, chúng tôi không chỉ là quần áo phong cách Hàn Quốc và còn cung cấp những sản phẩm K-beauty, album K-pop, đồ trang sức và phụ kiện tốt nhất để hoàn thiện và bổ sung cho mọi khía cạnh trong lối sống của bạn.
        
        Các sản phẩm chăm sóc da, mỹ phẩm Hàn Quốc của chúng tôi giúp bạn có được khuôn mặt đẹp nhất của mình. Các thương hiệu như SNP, Ariul, RiRe, Evercell by Chaum, XYZ và MILLION RED là nhà sản xuất công thức cải tiến trong trang điểm và chăm sóc da sử dụng những gì tốt nhất trong bí quyết làm đẹp của Hàn Quốc. Tại đây, bạn có thể mua các loại mặt nạ, sữa rửa mặt, sữa rửa mặt, toner, serum, kem dưỡng da mặt, son tint phong cách Hàn Quốc, phấn nước và mọi thứ khác mà bạn cần để có được vẻ ngoài trang điểm tự nhiên, hoàn thành quy trình chăm sóc da 10 bước, duyệt theo làn da của bạn loại hoặc điều trị mối quan tâm về da của bạn.
        
        Hãy đến để tìm ra nơi cuộc sống của bạn đưa bạn đến tại KOODING! Vui lòng duyệt qua trang web của chúng tôi và xem các phong cách thời trang Hàn Quốc mới nhất và tuyệt vời nhất từ ​​cửa hàng thời trang trực tuyến yêu thích mới của bạn. Với khả năng phục vụ hơn 100 quốc gia, chúng tôi đảm bảo bạn sẽ có trải nghiệm mua sắm dễ dàng.';
        $save = $settings->save();

        if ($save) {
            if ($request->file('logo')) {
                // unlink img old
                if ($settings->logo && file_exists(public_path('uploads/' . $settings->logo))) {
                    unlink(public_path('uploads/' . $settings->logo));
                }
                // upload logo
                $request->file('logo')->move(public_path('uploads'), $logoName);
            }
            return back()->with('msg-suc', 'Cập nhật thành công!');
        }
        return back()->with('msg-er', 'Lỗi trong quá trình cập nhật!');
    }
}
