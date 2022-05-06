<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.home') }}">
                <i class="fa fa-home mr-3" aria-hidden="true"></i>
                <span class="menu-title">Website</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="far fa-chart-bar menu-icon"></i>
                <span class="menu-title {{ Route::is('admin.dashboard') ? 'active-link' : '' }}">Thống kê</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Hàng hóa</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Sản phẩm
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('categories.create') }}">Danh mục
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('attribute.index') }}">Thuộc
                            tính</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('stock.index')}}">Kho hàng</a></li>
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('brand.index') }}">
                <i class="far fa-chart-bar menu-icon"></i>
                <span class="menu-title {{ Route::is('brand.index') ? 'active-link' : '' }}">Thuong hieu</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('voucher.index')}}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Mã giảm giá</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.order.index')}}">
                <i class="fas fa-shipping-fast menu-icon"></i>
                <span class="menu-title">Đơn hàng</span>
            </a>
        </li>
        <!-- nếu là quản lý thì ms dc  -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#account" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="far fa-user menu-icon"></i>
                <span class="menu-title">Tài khoản</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="account">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('user.index')}}">Danh sách</a></li>
                    <li class="nav-item"> <a class="nav-link" href="account?action=add">Phân quyền</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#comment" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="far fa-comments menu-icon"></i>
                <span class="menu-title">Phản hồi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="comment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="comment">Tổng hợp</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#news" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="far fa-newspaper menu-icon"></i>
                <span class="menu-title">Tin tức</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="news">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="news?action=list">Tổng hợp</a></li>
                    <li class="nav-item"> <a class="nav-link" href="news?action=add">Thêm tin tức</a></li>
                </ul>
            </div>
        </li>
        

        <li class="nav-item">
            <a class="nav-link" href="display">
                <i class="fas fa-tv menu-icon"></i>
                <span class="menu-title">Giao diện</span>
            </a>

        </li>



    </ul>
</nav>
