<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('main')}}">
                <!-- Logo icon -->

                <img src="{{url('img/logo/dummy-logo.png')}}" alt="homepage" class="dark-logo" width="40px"/>


                <span>
                         <!-- dark Logo text -->
                         {{--<img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />--}}
                    <b>Lloyd Baker</b>
                    <!-- Light Logo text -->
                         {{--<img src="images/logo-light-text.png" class="light-logo" alt="homepage" />--}}
                </span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->

        {{--<div>--}}
            {{--<span style="text-align: center;color: white"><b>Product and Offer for Mirakl</b></span>--}}
        {{--</div>--}}

        <div class="navbar-collapse">

            <ul class="navbar-nav mr-auto mt-md-0 ">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->

                <span style="text-align: center; color: white; margin-right: 30%"><b>Product and Offer for Mirakl</b></span>

            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Welcome <b> {{ucfirst(Auth::user()->name)}} <i class="fa fa-sort-desc" aria-hidden="true"></i></b></a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">

                            {{--<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>--}}
                            {{--<li role="separator" class="divider"></li>--}}
                            <li>
                                <a style="text-align: center" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                    <i class="fa fa-power-off"> </i></a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>