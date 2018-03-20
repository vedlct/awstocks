<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/images/favicon.png')}}">
    <title>Lloyd Baker</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('date/date-picker.css')}}">

    <link href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{url('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{url('css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <!--[endif]-->

    @yield('header')

</head>

<body class="fix-header fix-sidebar card-no-border">


<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @include('topbar')
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    @include('leftSidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            @if(Session::has('danger'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('danger') }}</p>
        @endif

        @yield('content')


            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2018 Lloyd Baker Leather
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>



<script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{url('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{url('js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{url('js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{url('js/sidebarmenu.js')}}"></script>
<!--stickey kit -->
<script src="{{url('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{url('js/custom.min.js')}}"></script>
<script src="{{url('date/jquery-ui.js')}}"></script>
<script src="{{url('date/script.js')}}"></script>


@yield('foot-js')


</body>

</html>
