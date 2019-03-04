<div class="tab-pane active" id="global_setting">
	<form role="form" method="post" action="{{route('settings.store')}}">
		
		{{ csrf_field() }}
		<div class="row">
			
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						العنوان [en]
					</label>
					<input required="" type="text" class="form-control" name="site_name_en"
					value="{{settings('site_name_en')}}"/>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group" dir="rtl">
					<label class="control-label">
						العنوان [بالعربي]
					</label>
					<input required="" type="text" class="form-control" name="site_name_ar"
					value="{{settings('site_name_ar')}}"/>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						الوصف لمحركات البحث [en]
					</label>
					<textarea class="form-control" name="meta_description_en" cols="30" rows="10">{!!settings('meta_description_en')!!}</textarea>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group" dir="rtl">
					<label class="control-label">
						الوصف لمحركات البحث [بالعربي]
					</label>
					<textarea class="form-control" name="meta_description_ar" cols="30" rows="10">{!!settings('meta_description_ar')!!}</textarea>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						كلمات دالة لمحركات البحث [en]
					</label>
					<input required="" type="text" class="form-control" name="meta_keywords_en"
					value="{{settings('meta_keywords_en')}}"/>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group" dir="rtl">
					<label class="control-label">
						كلمات دالة لمحركات البحث [بالعربي]
					</label>
					<input required="" type="text" class="form-control" name="meta_keywords_ar"
					value="{{settings('meta_keywords_ar')}}"/>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group" dir="rtl">
					<label class="control-label">
						قيمة التوصيل
					</label>
					<input required="" type="text" class="form-control" name="shipping"
					value="{{settings('shipping')}}"/>
				</div>
			</div>

		</div>
		
		<div class="margiv-top-10">
			<button type="submit" id="submit" class="btn green">حفظ التغيرات</button>
		</div>
	</form>
</div>
<div class="tab-pane" id="contact_info">
	<form role="form" method="post" action="{{route('settings.store')}}">
		
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label">
				رقم الهاتف
			</label>
			<input required="" type="text" class="form-control" name="company_contact"
			value="{{settings('company_contact')}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">
				العنوان
			</label>
			<input required="" type="text" class="form-control" name="company_address"
			value="{{settings('company_address')}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">
				البريد الالكتروني
			</label>
			<input required="" type="text" class="form-control" name="company_email"
			value="{{settings('company_email')}}"/>
		</div>
		<div id="result" style="display: none"></div>
		<div class="margiv-top-10">
			<button type="submit" id="submit" class="btn green">حفظ التغيرات</button>
		</div>
	</form>
</div>
<div class="tab-pane" id="tab_1_2">
	<form role="form" method="post" action="{{route('settings.store')}}"
		enctype="multipart/form-data">
		{{ csrf_field() }}
		
		<div class="form-group">
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					<img src="{{ url(settings('logo')) }}" alt="logo" style="max-width: 67%" />
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
				</div>
				<div>
					<input required="" type="file" name="logo" class="form-control">
				</div>
			</div>
		</div>
		<div class="margin-top-10">
			<button type="submit" class="btn green">حفظ التغيرات</button>
		</div>
	</form>
</div>
<div class="tab-pane" id="tab_1_4">
	<form role="form" method="post" action="{{route('settings.store')}}">
		
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label">
				Facebook Link
			</label>
			<input required="" type="text" class="form-control" name="facebook"
			value="{{settings('facebook')}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">
				Twitter Link
			</label>
			<input required="" type="text" class="form-control" name="twitter"
			value="{{settings('twitter')}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">
				Linkedin Link
			</label>
			<input required="" type="text" class="form-control" name="linkedin"
			value="{{settings('linkedin')}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">
				Google+ Link
			</label>
			<input required="" type="text" class="form-control" name="google_plus"
			value="{{settings('google_plus')}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">
				Instagram Link
			</label>
			<input required="" type="text" class="form-control" name="instagram"
			value="{{settings('instagram')}}"/>
		</div>
		
		<div id="result" style="display: none"></div>
		<div class="margiv-top-10">
			<button type="submit" id="submit" class="btn green">حفظ التغيرات</button>
		</div>
	</form>
</div>