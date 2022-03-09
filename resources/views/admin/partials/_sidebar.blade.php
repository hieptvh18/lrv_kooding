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
              <span class="menu-title">Thống kê</span>
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
                  <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Danh sách
                      </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('product.create') }}">Thêm</a>
                  </li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('attribute.index')}}">Thuộc
                          tính</a></li>
              </ul>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#cate" aria-expanded="false"
              aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Danh mục sản phẩm</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="cate">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{route('categories.index')}}">Danh sách</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('categories.create')}}">Thêm</a></li>
              </ul>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="order">
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
                  <li class="nav-item"> <a class="nav-link" href="account">Danh sách</a></li>
                  <li class="nav-item"> <a class="nav-link" href="account?action=add">Thêm tài khoản</a>
                  </li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#comment" aria-expanded="false"
              aria-controls="ui-basic">
              <i class="far fa-comments menu-icon"></i>
              <span class="menu-title">Bình luận</span>
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
          <a class="nav-link" data-toggle="collapse" href="#voucher" aria-expanded="false"
              aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Mã giảm giá</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="voucher">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="vourcher?action=list">Tổng hợp</a></li>
                  <li class="nav-item"> <a class="nav-link" href="vourcher?action=add">Thêm mã</a></li>
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
