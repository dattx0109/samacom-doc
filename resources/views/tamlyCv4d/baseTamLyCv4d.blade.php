<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Quản trị Danh sách tâm lý KH - CV4D</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- Sass main CSS -->
    <link href="{{asset('css/sass/dist/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/sass/dist/partials.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/bootstrap-markdown/bootstrap-markdown.min.css')}}" rel="stylesheet">

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="{{(Request::routeIs('count-tam-ly-cv-4d')) ? 'active' : ''}}">
                    <a href="{{url('/count-tam-ly-cv-4d')}}">
                        <i class="fa fas fa-building"></i>
                        <span class="nav-label">Tổng hợp khảo sát khách hàng</span>
                    </a>
                </li>
                <li class="{{(Request::routeIs('list-tam-ly')) ? 'active' : ''}}">
                    <a href="{{url('/list-tam-ly')}}">
                        <i class="fa fas fa-building"></i>
                        <span class="nav-label">Danh sách khảo sát đọc vị tâm lý khách hàng</span>
                    </a>
                </li>
                <li class="{{(Request::routeIs('list-cv4d')) ? 'active' : ''}}">
                    <a href="{{url('/list-cv4d')}}">
                        <i class="fa fas fa-building"></i>
                        <span class="nav-label">Danh sách khảo sát đăng ký CV-4D</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
{{--                    <form role="search" class="navbar-form-custom" action="search_results.html">--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="text" placeholder="Search for something..." class="form-control"--}}
{{--                                   name="top-search" id="top-search">--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        {{--                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                        {{--                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>--}}
                        {{--                        </a>--}}
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>.
                                        <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica
                                            Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <a href="{{url('/login')}}">--}}
                    {{--                            <i class="fa fa-sign-out"></i> Log out--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    {{--                    <li>--}}
                    {{--                        <a class="right-sidebar-toggle">--}}
                    {{--                            <i class="fa fa-tasks"></i>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                </ul>

            </nav>
        </div>
        <div class="row  border-bottom dashboard-header">
            @yield('content-tam-ly-cv4d')
        </div>

    </div>
</div>



<!-- Mainly scripts -->
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

{{--<!-- Custom and plugin javascript -->--}}
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- GITTER -->
<script src="{{asset('js/plugins/gritter/jquery.gritter.min.js')}}"></script>

<!-- ChartJS-->
<script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>

<!-- SUMMERNOTE -->
<script src="{{asset('js/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{asset('js/plugins/auto-format-currency/simple.money.format.js')}}"></script>
<script src="{{asset('js/plugins/auto-format-currency/simple.money.format.js')}}"></script>
<script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

@yield('javascript-bottom')
</body>


