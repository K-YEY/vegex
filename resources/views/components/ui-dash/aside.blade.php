<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=":void" target="_blank">
        <img src="{{asset('assets/images/ico/android-chrome-192x192.png')}}" class="navbar-brand-img border-radius-md" width="32" height="32" alt="main_logo">
        <span class="ms-1 text-sm text-dark">{{env('APP_NAME')}}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li><hr class="horizontal dark mt-0">
        <li class="nav-item mb-2 mt-0">
            <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-dark collapsed" aria-controls="ProfileNav" role="button" aria-expanded="false">
              <img src="{{ Auth::user()->pic ?? asset('assets/images/vegex.png') }}" class="avatar">
              <span class="nav-link-text ms-2 ps-1">{{Auth::user()->name}}</span>
            </a>
            <div class="collapse" id="ProfileNav" style="">
              <ul class="nav ">
                <li class="nav-item">
                  <a class="nav-link text-dark" href="../../pages/pages/profile/overview.html">
                    <span class="sidenav-mini-icon"> MP </span>
                    <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark " href="../../pages/pages/account/settings.html">
                    <span class="sidenav-mini-icon"> S </span>
                    <span class="sidenav-normal  ms-3  ps-1"> Settings </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark " href="../../pages/authentication/signin/basic.html">
                    <span class="sidenav-mini-icon"> L </span>
                    <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                  </a>
                </li>
              </ul>
            </div>
          </li><hr class="horizontal dark mt-0">
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/tables.html">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>

      </ul>
    </div>

  </aside>
