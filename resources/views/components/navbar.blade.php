
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            
              <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img
                  src="{{ asset('img/logo.png') }}"
                  class="user-image rounded-circle shadow me-2"
                  alt="User Image"
                  style="width: 32px; height: 32px;"
                />
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                @if (auth()->check() == false)
                    
                <li class="user-header text-bg-primary d-none">
                  <img
                    src="{{ asset('img/logo.png') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="/" class="btn btn-default btn-flat">Kembali</a>
                  <a href="/login" class="btn btn-default btn-flat float-end">Masuk</a>
                </li>
                <!--end::Menu Footer-->

                {{-- Tampilan sekretariat --}}
                @else
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ auth()->user()->foto !== null ? asset('foto/'. auth()->user()->foto) : asset('img/person.png') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                    style="margin: 0 auto;"
                  />

                  <p>
                    {{ auth()->user()->name }}
                    {{-- <small>Member since Nov. 2023</small> --}}
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                  <a href="/logout" class="btn btn-default btn-flat float-end">Keluar</a>
                </li>
                <!--end::Menu Footer-->
                @endif
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
      
        </div>
        <!--end::Container-->
      </nav>
