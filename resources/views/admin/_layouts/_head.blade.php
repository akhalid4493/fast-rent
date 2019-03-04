<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="{{ url(settings('logo')) }}">
	<title>@yield('title', 'الرئيسية') || {{ settings('site_name_ar') }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	
	{!!Html::style(asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css'))!!}
	{!!Html::style(asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/datatables/datatables.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'))!!}
	<link href="{{ url('admin/assets/global/css/components-md-rtl.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/cubeportfolio/css/cubeportfolio.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/jquery-minicolors/jquery.minicolors.css'))!!}
	{!!Html::style(asset('admin/assets/pages/css/invoice-2-rtl.min.css'))!!}
	{!!Html::style(asset('admin/assets/pages/css/portfolio.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/select2/css/select2.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/select2/css/select2-bootstrap.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/morris/morris.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/fullcalendar/fullcalendar.min.css'))!!}
	{!!Html::style(asset('admin/assets/global/plugins/jqvmap/jqvmap/jqvmap.css'))!!}
	{!!Html::style(asset('admin/assets/layouts/layout/css/layout-rtl.min.css'))!!}
	{!!Html::style(asset('admin/assets/layouts/layout/css/themes/darkblue-rtl.min.css'))!!}
	{!!Html::style(asset('admin/assets/layouts/layout/css/custom-rtl.min.css'))!!}
	<style>
	body{
	font-family: 'NeoSansArabic', sans-serif !important;
	}
	.portlet.box>.portlet-body{
	padding: 27px 12px 80px;
	}
	</style>
</head>