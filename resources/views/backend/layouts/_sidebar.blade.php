<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/img/logo-ha-noi.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
      <span class="brand-text font-weight-bold">TP HÀ NỘI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="{{asset(Auth::user()->role == 0 ? 'assets/img/unnamed.png' : 'storage/avatars/'.Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image" />
          </div>
          <div class="info">
              <a href="{{url('admin/profile')}}" class="d-block">{{Auth::user()->human->full_name}}</a>
          </div>
      </div>

      <!-- SidebarSearch Form -->
      {{--
      <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
              <div class="input-group-append">
                  <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                  </button>
              </div>
          </div>
      </div>
      --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            @if (Auth::user()->role <= 1)
                <li class="nav-item">
                    <a href="{{url('/admin/unit')}}" class="nav-link">
                    <i class="nav-icon fas fa-university"></i>
                        <p>
                            Đơn vị
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/users')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                            Quản lý cán bộ
                        </p>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('/admin/applications')}}" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>
                            Quản lý đơn cấp
                        </p>
                    </a>
                </li>
            @endif
              
              <li class="nav-item">
                  <a href="{{url('/admin/confirm-history')}}" class="nav-link">
                    <i class="nav-icon far fa-calendar-check"></i>
                      <p>
                          Lịch sử cấp giấy
                      </p>
                  </a>
              </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
