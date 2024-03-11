<?php

namespace Database\Seeders;

use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seeder

        // // roles user
        DB::table('roles')->insert([
            [
                "name"=>"Khách hàng",
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()
            ],
            [
                "name"=>"Nhân viên",
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()

            ],
            [
                "name"=>"Quản lý",
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()

            ]
        ]);

        // account
        DB::table('users')->insert([
            [
                "name"=>"hiep hoang tran",
            "email"=>"hieptvh18@gmail.com",
            "phone"=>"0123144444",
            "role_id"=>3,
            "password"=>bcrypt("123123")
            ],
            [
                "name"=>"toi la khach hang",
            "email"=>"hipbu18@gmail.com",
            "phone"=>"0123144442",
            "role_id"=>1,
            "password"=>bcrypt("123123")
            ]
        ]);

        // attribute
        DB::table('attributes')->insert([
            [
                "name"=>"Màu sắc"
            ],
            [
                "name"=>"Kích cỡ"
            ],
            ["name"=>"Chất liệu"]
        ]);

        // attr value
        DB::table('attr_values')->insert([
            ["attr_id"=>1,
            "name"=>"Đỏ cam",
            "value"=>"#ff0000"],
            ["attr_id"=>2,
            "name"=>"Medium",
            "value"=>"M"],
            ["attr_id"=>3,
            "name"=>"Vải gấm",
            "value"=>"Vải gấm"],
        ]);

        // web_setting
        DB::table('web_settings')->insert([
            [
                'web_name'=>'KOODING',
                'intro_title'=>'KOODING Kết nối thời trang Hàn Quốc với bạn
                ',
                'intro_content'=>'Chào mừng đến với KOODING.com, thị trường toàn cầu trực tuyến hàng đầu. Mục tiêu của chúng tôi là không chỉ kết nối mọi người trên toàn cầu thông qua tình yêu của họ với phong cách Hàn Quốc mà còn mang đến khả năng tiếp cận ngay với thời trang nữ Hàn Quốc mới nhất, thời trang nam Hàn Quốc, các sản phẩm và thương hiệu làm đẹp của Hàn Quốc trên toàn thế giới với chi phí thấp nhất và không rắc rối vận chuyển trên toàn thế giới. Trên tất cả, chúng tôi cố gắng cung cấp cho cộng đồng KOODING những sản phẩm cao cấp được tìm thấy tại các cửa hàng Hàn Quốc với giá cả phải chăng nhất. KOODING cung cấp những mặt hàng quần áo châu Á trực tuyến tốt nhất và là nơi có thể mua sắm bất cứ thứ gì liên quan đến thời trang Hàn Quốc. Từ thời trang đường phố đến quần áo hàng hiệu cao cấp, chúng tôi giúp việc mua sắm trực tuyến của người Hàn Quốc trở nên dễ dàng hơn bao giờ hết. Tại đây, bạn có thể tìm thấy mọi thứ, từ áo hoodie và áo nỉ thoải mái, những chiếc váy đáng yêu, áo khoác và áo len cổ lọ sành điệu và ấm áp, cùng những chiếc quần jean và quần âu mới yêu thích của bạn. Chúng tôi mang các thương hiệu quần áo Hàn Quốc đích thực như Chuu, NANING9, Cherrykoko, BASIC HOUSE, MIND BRIDGE, OPEN THE DOOR, REDHOMME, v.v. Bất kể phong cách ưa thích của bạn là gì, bạn chắc chắn có thể tìm thấy trang phục mơ ước của mình với những bộ quần áo đến từ Hàn Quốc này. KOODING không chỉ là một cửa hàng thời trang trực tuyến của Hàn Quốc; trên thực tế, chúng tôi không chỉ là quần áo phong cách Hàn Quốc và còn cung cấp những sản phẩm K-beauty, album K-pop, đồ trang sức và phụ kiện tốt nhất để hoàn thiện và bổ sung cho mọi khía cạnh trong lối sống của bạn. Các sản phẩm chăm sóc da, mỹ phẩm Hàn Quốc của chúng tôi giúp bạn có được khuôn mặt đẹp nhất của mình. Các thương hiệu như SNP, Ariul, RiRe, Evercell by Chaum, XYZ và MILLION RED là nhà sản xuất công thức cải tiến trong trang điểm và chăm sóc da sử dụng những gì tốt nhất trong bí quyết làm đẹp của Hàn Quốc. Tại đây, bạn có thể mua các loại mặt nạ, sữa rửa mặt, sữa rửa mặt, toner, serum, kem dưỡng da mặt, son tint phong cách Hàn Quốc, phấn nước và mọi thứ khác mà bạn cần để có được vẻ ngoài trang điểm tự nhiên, hoàn thành quy trình chăm sóc da 10 bước, duyệt theo làn da của bạn loại hoặc điều trị mối quan tâm về da của bạn. Hãy đến để tìm ra nơi cuộc sống của bạn đưa bạn đến tại KOODING! Vui lòng duyệt qua trang web của chúng tôi và xem các phong cách thời trang Hàn Quốc mới nhất và tuyệt vời nhất từ ​​cửa hàng thời trang trực tuyến yêu thích mới của bạn. Với khả năng phục vụ hơn 100 quốc gia, chúng tôi đảm bảo bạn sẽ có trải nghiệm mua sắm dễ dàng.',
                'logo'=>'627636d057d69-logo1651914448.png',
                'fb_url'=>'https://facebook.com',
                'insta_url'=>'https://facebook.com',
                'twitter_url'=>'https://facebook.com',
                'pinterest_url'=>'https://facebook.com',
                "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()

            ]
        ]);

        // news
        DB::table('news')->insert([
            [
                'title'=>'Bộ sưu tập thu đông hot nhất 2021',
                'content'=>'Trải qua 12 mùa tổ chức thành công rực rỡ, chương trình Tuần lễ thời trang Quốc tế Việt Nam - Aquafina Vietnam International Fashion Week đã xây dựng nên thương hiệu riêng. 

                Phát biểu tại buổi họp báo, bà Trang Lê - Chủ tịch Hiệp hội các Nhà thiết kế thời trang Đông Nam Á (CAFD) kiêm Chủ tịch Aquafina Tuần lễ thời trang Quốc tế Việt Nam đã có những chia sẻ thú vị về thông điệp #ReFashion ý nghĩa năm nay: “Dịch Covid-19 diễn ra trong suốt 2 năm qua đã làm cho cuộc sống của tất cả chúng ta đổi thay. Thời trang thế giới nói chung và thời trang Việt Nam nói riêng cũng không nằm ngoài quy luật thay đổi đó. Chính vì thế, đã đến lúc chúng ta cần thay đổi cách nghĩ (ReThinking), thay đổi cách làm (ReInventing), thay đổi cách vận hành (ReGenerating) để tạo ra một cuộc cách mạng mới (Revolution) nhằm hướng tới sự phát triển bền vững trong thời trang (Sustainable Fashion). Và đó là lý do mà chúng tôi đã quyết định chọn chủ đề năm nay là #ReFashion để truyền đi thông điệp tích cực, hướng đến sự phát triển bền vững cho thời trang Việt Nam trong điều kiện bình thường mới”.',
                'image'=>'627698192e496-post-avatar1651939353.jpg',
                'short_desc'=>'Cảm hứng thời trang từ kooding mang đến cho mọi người vẻ đẹp lộng lẫy',
                'author_id'=>1,
        "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()
            ],  
            [
                'title'=>'Hé lộ nhà thiết kế tham dự Tuần lễ thời trang Quốc tế Việt Nam 2022',
                'content'=>'Trải qua 12 mùa tổ chức thành công rực rỡ, chương trình Tuần lễ thời trang Quốc tế Việt Nam - Aquafina Vietnam International Fashion Week đã xây dựng nên thương hiệu riêng. 

                Phát biểu tại buổi họp báo, bà Trang Lê - Chủ tịch Hiệp hội các Nhà thiết kế thời trang Đông Nam Á (CAFD) kiêm Chủ tịch Aquafina Tuần lễ thời trang Quốc tế Việt Nam đã có những chia sẻ thú vị về thông điệp #ReFashion ý nghĩa năm nay: “Dịch Covid-19 diễn ra trong suốt 2 năm qua đã làm cho cuộc sống của tất cả chúng ta đổi thay. Thời trang thế giới nói chung và thời trang Việt Nam nói riêng cũng không nằm ngoài quy luật thay đổi đó. Chính vì thế, đã đến lúc chúng ta cần thay đổi cách nghĩ (ReThinking), thay đổi cách làm (ReInventing), thay đổi cách vận hành (ReGenerating) để tạo ra một cuộc cách mạng mới (Revolution) nhằm hướng tới sự phát triển bền vững trong thời trang (Sustainable Fashion). Và đó là lý do mà chúng tôi đã quyết định chọn chủ đề năm nay là #ReFashion để truyền đi thông điệp tích cực, hướng đến sự phát triển bền vững cho thời trang Việt Nam trong điều kiện bình thường mới”.',
                'image'=>'627698192e496-post-avatar1651939353.jpg',
                'short_desc'=>'Hé lộ nhà thiết kế tham dự Tuần lễ thời trang Quốc tế Việt Nam 2022',
                'author_id'=>1,
        "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()
            ],
            [
                'title'=>'Levi tôn vinh dòng sản phẩm 501 huyền thoại với loạt ngôi sao trẻ',
                'content'=>'Trải qua 12 mùa tổ chức thành công rực rỡ, chương trình Tuần lễ thời trang Quốc tế Việt Nam - Aquafina Vietnam International Fashion Week đã xây dựng nên thương hiệu riêng. 

                Phát biểu tại buổi họp báo, bà Trang Lê - Chủ tịch Hiệp hội các Nhà thiết kế thời trang Đông Nam Á (CAFD) kiêm Chủ tịch Aquafina Tuần lễ thời trang Quốc tế Việt Nam đã có những chia sẻ thú vị về thông điệp #ReFashion ý nghĩa năm nay: “Dịch Covid-19 diễn ra trong suốt 2 năm qua đã làm cho cuộc sống của tất cả chúng ta đổi thay. Thời trang thế giới nói chung và thời trang Việt Nam nói riêng cũng không nằm ngoài quy luật thay đổi đó. Chính vì thế, đã đến lúc chúng ta cần thay đổi cách nghĩ (ReThinking), thay đổi cách làm (ReInventing), thay đổi cách vận hành (ReGenerating) để tạo ra một cuộc cách mạng mới (Revolution) nhằm hướng tới sự phát triển bền vững trong thời trang (Sustainable Fashion). Và đó là lý do mà chúng tôi đã quyết định chọn chủ đề năm nay là #ReFashion để truyền đi thông điệp tích cực, hướng đến sự phát triển bền vững cho thời trang Việt Nam trong điều kiện bình thường mới”.',
                'image'=>'627644ff8e70d-category1651918079.jpg',
                'short_desc'=>'Hé lộ nhà thiết kế tham dự Tuần lễ thời trang Quốc tế Việt Nam 2022',
                'author_id'=>1,
        "created_at"=> Carbon::now()->toDateTimeString(),
                "updated_at"=> Carbon::now()->toDateTimeString()
            ]
        ]);

        // brand+ product
        \App\Models\Brand::factory(5)->create();
        \App\Models\Category::factory(3)->create();
        \App\Models\Product::factory(15)->create();


       
    }
}
