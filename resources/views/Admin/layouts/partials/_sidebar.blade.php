<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ url('assets/images/logo-sm.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ url('assets/images/logo - tradres.jpg') }}" alt="" height="80">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ url('assets/images/logo-sm.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">

                <img src="{{ url('assets/images/download.gif') }}" alt="" height="65" class="mt-2">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>


                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                        <i class="ri-funds-box-fill"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><span>Master</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'banner.index') active @endif" href="{{ route('banner.index') }}">
                        <i class="ri-slideshow-4-line"></i> <span>Banner</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'stats.index') active @endif" href="{{ route('stats.index') }}">
                        <i class="ri-line-chart-fill"></i> <span>Our Stats</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'service.index') active @endif" href="{{ route('service.index') }}">
                        <i class="ri-git-merge-fill"></i> <span>Services</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'feature.index') active @endif" href="{{ route('feature.index') }}">
                        <i class="ri-lightbulb-flash-fill"></i> <span>Features</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'product.index') active @endif" href="{{ route('product.index') }}">
                        <i class="ri-stack-line"></i> <span>Product</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'faq.index') active @endif" href="{{ route('faq.index') }}">
                        <i class="ri-question-answer-fill"></i> <span>Faq</span>
                    </a>
                </li>

                <li class="menu-title"><span>Quote and Feedbacks</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'quote.index') active @endif" href="{{ route('quote.index') }}">
                        <i class="ri-chat-quote-fill"></i> <span>Quotes List</span>
                    </a>
                </li>

                <li class="menu-title"><span>Information / Detail </span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'contact.index') active @endif" href="{{ route('contact.index') }}">
                        <i class="ri-contacts-book-2-fill"></i> <span>Contact Info</span>
                    </a>
                </li>

                <li class="menu-title"><span>Setting</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'profile.index') active @endif" href="{{ route('profile.index') }}">
                        <i class="ri-user-settings-fill"></i> <span>Profile</span>
                    </a>
                </li>

            </ul>





        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>