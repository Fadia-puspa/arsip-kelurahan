<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('img/logo.png') }}" alt="Logo Kelurahan"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Arsip Kelurahan</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
                @if(auth()->user() !== null)
                <li class="nav-item">
                  <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-speedometer2"></i> Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/suratmasuk" class="nav-link {{ request()->is('suratmasuk') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-envelope-arrow-down"></i> Surat Masuk
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/suratkeluar" class="nav-link {{ request()->is('suratkeluar') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-envelope-arrow-up"></i> Surat Keluar
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/uploadsurat" class="nav-link {{ request()->is('uploadsurat') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-upload"></i> Upload Surat
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/profile" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-person-circle"></i> Profil
                  </a>
                </li>
                <li class="nav-item">
                <a href="/logout" class="nav-link text-danger">
                  <i class="nav-icon bi bi-box-arrow-right"></i> Keluar
                </a>
              </li>
              @else
                <li class="nav-item">
                  <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-speedometer2"></i> Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/suratmasuk" class="nav-link {{ request()->is('suratmasuk') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-file-earmark-text"></i> Lihat Surat Masuk
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/suratkeluar" class="nav-link {{ request()->is('suratkeluar') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-clock-history"></i> Lihat Surat Keluar
                  </a>
                </li>
              @endif
              
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>