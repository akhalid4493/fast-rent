@extends('admin._layouts.master')
@section('title','اضافة مكتب تآجير')
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
					<a href="{{ url(route('agencies.index')) }}">جميع مكاتب التآجير</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">اضافة مكتب تآجير</a>
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
								اضافة مكتب تآجير جديد
							</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="form" action="{{url(route('agencies.store'))}}" enctype="multipart/form-data" class="form-horizontal form-row-seperated"
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
											<li>
												<a href="#tab_address" data-toggle="tab">
													العنوان
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
														الوصف ar
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<textarea name="description_ar" cols="30" rows="10" class="form-control"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														الوصف en
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<textarea name="description_en" cols="30" rows="10" class="form-control"></textarea>
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
												<div class="form-group">
													<label class="control-label col-md-2">
														مالك المكتب
													</label>
													<div class="col-md-9">
														<select name="user_id" id="single" class="form-control select2" >
															<option></option>
															@foreach ($users as $user)
															<option value="{{$user->id}}">
																{{$user->full_name}}
															</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														الصورة
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<input type="file" name="image" class="form-control">
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_address">
												<div class="form-group">
													<label class="control-label col-md-2">
														اختر المنطقة
													</label>
													<div class="col-md-9">
														<select id="single"
															name="province_id"
															class="form-control select2">
															<option value=""></option>
															@foreach ($governorats as
															$governorat)
															<optgroup label="- {{$governorat->name_ar}}">
																@foreach ($governorat->province as $province)
																<option value="{{$province->id}}">
																	{{ $province['name_ar'] }}
																</option>
																@endforeach
															</optgroup>
															@endforeach
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														القطعة
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<input type="text" name="block" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														الشارع
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<input type="text" name="street" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">
														العنوان التفصيلي
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<textarea class="form-control" name="address" cols="30" rows="10"></textarea>
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
														<a href="{{url(route('agencies.index')) }}" class="btn btn-lg red">
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