@extends('admin._layouts.master')
@section('title','اضافة لون')
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
					<a href="{{ url(route('colors.index')) }}">جميع الالوان المتاحة</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">اضافة لون</a>
				</li>
			</ul>
		</div>
		<h1 class="page-title"></h1>
		
		<div class="row">
			<div class="profile-content">
				<div class="portlet light ">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">
								اضافة لون جديد
							</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="form" action="{{url(route('colors.store'))}}" enctype="multipart/form-data" class="form-horizontal form-row-seperated"
							method="POST">
							@csrf
							<div class="portlet">
								<div class="portlet-body">
									<div class="tabbable-bordered">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
													بيانات عامة
												</a>
											</li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="tab_general">
												<div class="form-group">
													<label class="control-label col-md-2">
														العنوان ar
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<input type="text" name="name_ar" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														العنوان en
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<input type="text" name="name_en" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														الحالة
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<div class="mt-radio-inline">
															<label class="mt-radio mt-radio-outline"> مفعل
																<input type="radio" name="status" value="1">
																<span></span>
															</label>
															<label class="mt-radio mt-radio-outline">
																غير مفعل
																<input type="radio" name="status" value="0">
																<span></span>
															</label>
														</div>
													</div>
												</div>
												
											</div>
											<div class="form-actions">
												<div id="result" style="display: none"></div>
												
												<div class="progress-info" style="display: none">
													<div class="progress">
														<span class="progress-bar progress-bar-warning"></span>
													</div>
													<div class="status" id="progress-status"></div>
												</div>
												
												<div class="form-group">
													<div class="col-md-offset-2 col-md-9">
														<button type="submit" id="submit" class="btn btn-lg blue">
														اضافة
														</button>
														<a href="{{url(route('colors.index')) }}" class="btn btn-lg red">
															الخلف
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop