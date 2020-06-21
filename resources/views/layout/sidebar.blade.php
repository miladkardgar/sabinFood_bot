<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ \Illuminate\Support\Facades\Request::is('/dashboard') ? 'active' : '' }}" href="/">
                    <i class="fa fa-dashboard"></i>
                    داشبورد <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ \Illuminate\Support\Facades\Request::path()=='foodList' ? 'active' : '' }}" href="{{route('foodList.index')}}">
                    <i class="fa fa-list"></i>
                    منو غذا
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \Illuminate\Support\Facades\Request::path()==='foodDay' ? ' active' : '' }}" href="{{route('foodDay.index')}}">
                    <i class="fa fa-th-list"></i>
                    برنامه ماهانه
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('foodDay.reserveUser')}}">
                    <i class="fa fa-th-list"></i>
                    رزرو غذا
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <span data-feather="file-text"></span>--}}
{{--                    Current month--}}
{{--                </a>--}}
{{--            </li>--}}

        </ul>
    </div>
</nav>