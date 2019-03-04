@extends('admin._layouts.master')
@section('title','الاعدادات  العامة')
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
                    <a href="#">الاعدادات  العامة</a>
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
                                اضافة اعلان جديد
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal form-row-seperated" action="#">
                            <div class="portlet">
                                <div class="portlet-body">
                                    <div class="tabbable-bordered">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_general" data-toggle="tab"> General </a>
                                            </li>
                                            <li>
                                                <a href="#tab_meta" data-toggle="tab"> Meta </a>
                                            </li>
                                            <li>
                                                <a href="#tab_images" data-toggle="tab"> Images </a>
                                            </li>
                                            <li>
                                                <a href="#tab_reviews" data-toggle="tab"> Reviews
                                                    <span class="badge badge-success"> 3 </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab_history" data-toggle="tab"> History </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_general">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Name:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" name="product[name]" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Description:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="product[description]"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Short Description:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="product[short_description]"></textarea>
                                                            <span class="help-block"> shown in product listing </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Available Date:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                                <input type="text" class="form-control" name="product[available_from]">
                                                                <span class="input-group-addon"> to </span>
                                                                <input type="text" class="form-control" name="product[available_to]">
                                                            </div>
                                                            <span class="help-block"> availability daterange. </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">SKU:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" name="product[sku]" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Price:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" name="product[price]" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Tax Class:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <select class="table-group-action-input form-control input-medium" name="product[tax_class]">
                                                                <option value="">Select...</option>
                                                                <option value="1">None</option>
                                                                <option value="0">Taxable Goods</option>
                                                                <option value="0">Shipping</option>
                                                                <option value="0">USA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Status:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <select class="table-group-action-input form-control input-medium" name="product[status]">
                                                                <option value="">Select...</option>
                                                                <option value="1">Published</option>
                                                                <option value="0">Not Published</option>
                                                            </select>
                                                        </div>
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