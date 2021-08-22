  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('/project/images/logo2.png')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Electric Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">

          @if (Auth::check()) 
          <span style="color: white; display: block; font-size: 1.2rem">Welcome: {{Auth::user()->name}}</span> 
          <div>
            <a href="{{ route('logout') }}"  class="text-white" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
          @endif

        </div>
      </div>

      <!-- SidebarSearch Form -->
<!--       <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fa fa-book" aria-hidden="true"></i>
              <p>
                Sản Phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category_index')}}" class="nav-link">
                  <p>Danh sách danh mục</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('product_index')}}" class="nav-link">
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>


                @if (checkAvaiableRoute('sale_index') == true)
                  <li class="nav-item">
                <a href="{{route('sale_index')}}" class="nav-link">
                  <p>Doanh số</p>
                </a>
              </li>
                @endif
     
            </ul>
          </li>

<!--           <li class="nav-item menu-open">

            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Thương hiệu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('brand_index')}}" class="nav-link">
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('brand_create')}}" class="nav-link">
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li> -->         

          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
             <i class="fa fa-book" aria-hidden="true"></i>
              <p>
                Đơn hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('order_pending')}}" class="nav-link">
                  <p>Danh sách chờ xác nhận</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('order.index')}}" class="nav-link">
                  <p>Danh sách đã xác nhận</p>
                </a>
              </li>
   <!--            <li class="nav-item">
                <a href="" class="nav-link">
                  <p>Thêm mới</p>
                </a>
              </li> -->
            </ul>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
             <i class="fa fa-book" aria-hidden="true"></i>
              <p>
                Tin Tức
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('news_index')}}" class="nav-link">
                  <p>Danh sách tin tức</p>
                </a>
              </li>
            </ul>
          </li>


             @if (checkAvaiableRoute('users_index') == true)
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
             <i class="fa fa-book" aria-hidden="true"></i>
              <p>
                Cài Đặt 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users_index')}}" class="nav-link">
                  <p>Danh sách tài khoản</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('roles_index')}}" class="nav-link">
                  <p>Cài đặt chi tiết</p>
                </a>
              </li>
            </ul>
          </li>

          @endif 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>