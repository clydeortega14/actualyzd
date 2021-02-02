<!-- Favicon-->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="{{ asset('admin-bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="{{ asset('admin-bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

<!-- Animation Css -->
<link href="{{ asset('admin-bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- Morris Chart Css-->
<link href="{{ asset('admin-bsb/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{  asset('admin-bsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

<!-- Bootstrap DatePicker Css -->
<link href="{{  asset('admin-bsb/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

<!-- Custom Css -->
<link href="{{ asset('admin-bsb/css/style.css') }}" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{ asset('admin-bsb/css/themes/all-themes.css') }}" rel="stylesheet" />

<!-- Custom Css for every page -->
@yield('custom_css')