<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link rel="icon" href="{{asset('backend')}}/img/favicon.ico">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/animate.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/ripples.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/jquery-jvectormap-2.0.2.css">
    <link rel="stylesheet" href="{{asset('backend')}}/css/outlay.css">

    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/css/bootstrap-markdown.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/summernote/summernote.css">

    <link rel="stylesheet" href="{{asset('backend')}}/css/colors/green.css">

</head>

<body class="hold-transition sidebar-mini">
<!-- Preloader -->
<div id="preloader">
    <div class="spinner"></div>
</div>
<div class="wrapper">
    <!-- Main Header -->
    @include('admin.includes.header')
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar sidebar-light">
        <!-- sidebar -->
    @include('admin.includes.sidebar')
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Home
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Built with  <i class="fa fa-heart"></i>  by Gagik Movsisyan
        </div>
    </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
<script src="{{asset('backend')}}/plugins/js/jquery-3.1.1.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/bootstrap.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery.sparkline.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/countUp.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/raphael.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/morris.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('backend')}}/plugins/js/material.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/ripples.min.js"></script>
<script src="{{asset('backend')}}/plugins/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/Chart.bundle.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery.slimscroll.min.js"></script>
<script src="{{asset('backend')}}/js/dashboard.js"></script>
<script src="{{asset('backend')}}/js/widgets.js"></script>

<script src="{{asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/jszip.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/pdfmake.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/vfs_fonts.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables/buttons.colVis.min.js"></script>
<script src="{{asset('backend')}}/js/datatables.js"></script>


<script src="{{asset('backend')}}/plugins/js/jquery.validate.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery.inputmask.bundle.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/bootstrap-tagsinput.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/select2.full.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/bootstrap-colorpicker.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/moment.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery.bootstrap-wizard.js"></script>
<script src="{{asset('backend')}}/plugins/js/markdown.js"></script>
<script src="{{asset('backend')}}/plugins/js/to-markdown.js"></script>
<script src="{{asset('backend')}}/plugins/js/bootstrap-markdown.js"></script>
<script src="{{asset('backend')}}/plugins/summernote/summernote.min.js"></script>
<script src="{{asset('backend')}}/plugins/tinymce/tinymce.min.js"></script>
<script src="{{asset('backend')}}/plugins/js/jquery.slimscroll.js"></script>

<script src="{{asset('backend')}}/js/form.js"></script>
<script src="{{asset('backend')}}/js/app.js"></script>

@yield('scripts')

</body>


<!-- Mirrored from www.upplanet.com/bighero/outlay-demo/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Apr 2018 13:18:53 GMT -->
</html>
