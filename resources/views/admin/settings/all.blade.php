@extends('admin._layouts.master')
@section('title','الاعدادات')
@section('content')

<div class="page-content-wrapper">
	<div class="page-content">

		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="{{ url(route('admin')) }}">الرئيسية</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<span>الاعدادات</span>
				</li>
			</ul>
		</div>

		@include('admin._layouts._msg')

		<div class="row">
			<div class="col-md-12">
                <div class="portfolio-content portfolio-1">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light">

								<div class="portlet-title tabbable-line">
									<div class="caption caption-md">
										<i class="icon-globe theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">
											الاعدادات
										</span>
									</div>
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#global_setting" data-toggle="tab">
												اعدادات عامة
											</a>
										</li>
										<li>
											<a href="#contact_info" data-toggle="tab">تواصل معنا</a>
										</li>
										<li>
											<a href="#tab_1_2" data-toggle="tab">الشعار</a>
										</li>
										<li>
											<a href="#tab_1_4" data-toggle="tab">التواصل الاجتماعي</a>
										</li>

									</ul>
								</div>

								<div class="portlet-body">
									<div class="tab-content">
										
										@include('admin.settings.tabs')
																				
									</div>
								</div>

								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop