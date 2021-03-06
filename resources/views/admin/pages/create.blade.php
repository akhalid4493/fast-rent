@extends('admin._layouts.master')
@section('title','اضافة صفحة جديدة')
@section('content')
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="{{ url(route('admin')) }}">الرئيسية</a><i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="{{ url(route('pages.index')) }}">جميع الصفحات</a><i class="fa fa-circle"></i>
				</li>
				<li><span>اضافة صفحة جديدة</span></li>
			</ul>
		</div>
		<h1 class="page-title"></h1>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light bordered form-fit">
					
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-equalizer font-green-haze"></i>
							<span class="caption-subject font-green-haze bold uppercase">
								اضافة صفحة جديدة
							</span>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="form" method="POST" action="{{url(route('pages.store'))}}" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
							
							{{ csrf_field() }}
							<div class="portlet-body">
								<div class="tabbable-bordered">
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#general" data-toggle="tab"> بيانات عامة </a>
										</li>
									</ul>
									<div class="tab-content">
										
										{{-- GENERAL CONTENT --}}
										<div class="tab-pane active" id="general">
											<div class="form-body">
												
												<div class="form-group">
													<label class="control-label col-md-3">
														عنوان الصفحة
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<input type="text" name="name_ar" placeholder="تعرف علينا" class="form-control">
													</div>
												</div>

		

												<div class="form-group">
													<label class="control-label col-md-3">
														وصف الصفحة
														<span class="required">*</span>
													</label>
													<div class="col-md-9">
														<textarea name="description_ar" class="form-control" cols="30" rows="10"></textarea>
													</div>
												</div>


												<div class="form-group">
													<label class="control-label col-md-3">
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
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" id="submit" class="btn btn-lg blue">
													اضافة
													</button>
													<a href="{{url(route('pages.index')) }}" class="btn btn-lg red">
														الخلف
													</a>
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

@section('scripts')
<script>
function disableMyText(){
    if(document.getElementById("main_page").checked == true){
        document.getElementById("single").disabled = true;
    }else{
        document.getElementById("single").disabled = false;
    }
}
</script>
@stop