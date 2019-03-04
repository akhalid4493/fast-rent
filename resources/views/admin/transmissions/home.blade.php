@extends('admin._layouts.master')
@section('title','جميع انواع ناقل الحركة')
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
                    <a href="#">جميع انواع ناقل الحركة</a>
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
                                انواع ناقل الحركة
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{ url(route('transmissions.create')) }}" class="btn sbold green">
                                            <i class="fa fa-plus"></i> اضافة نوع جديد
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light portlet-fit portlet-datatable bordered">
                            {{-- Filter DataTable --}}
                            <table class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="15%"> ترتيب بتاريخ الانشاء </th>
                                        <th width="15%"> بحث بالحالة </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <form id="formFilter">
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="from" placeholder="من" id="fromDate">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="to" placeholder="الى" id="toDate">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="status" class="form-control">
                                                        <option value="">اختر</option>
                                                        <option value="1">مفعل</option>
                                                        <option value="0">غير مفعل</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="search">
                                                    <i class="fa fa-search"></i>
                                                    بحث
                                                    </button>
                                                </div>
                                                
                                                <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i>
                                                حذف البحث
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                </thead>
                            </table>
                            <div class="portlet-body">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th width="2%" class="chkParent">
                                                    <a href="#.">تحديد الكل</a>
                                                </th>
                                                <th width="2%">#</th>
                                                <th>العنوان</th>
                                                <th>الحالة</th>
                                                <th>تاريخ الانشاء</th>
                                                <th>خيارات</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    @permission('delete_transmission')
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="xx" class="form-control">
                                                    <option value="delete">
                                                        حذف المحدد
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="deleteChecked" class="btn red btn-sm" onclick="deleteAllChecked('{{ url(route('transmissions.deletes')) }}')">
                                            تطبيق
                                            </button>
                                        </div>
                                    </div>
                                    @endpermission
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



@section('scripts')
<script> 
 function tableGenerate(data='') {

    var dataTable =
    $('#dataTable').DataTable({
        "ajax" : {
            url:"{{ route('transmissions.dataTable') }}",
            type:"GET",
            data : { 
                req : data, 
            },
        },
        "processing":true,
        "serverSide":true,
        "scrollX"   :true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
        },
        "order": [[ 1 , "desc" ]],
        "columns":[
            { "data": "listBox"   , "orderable": false  },
            { "data": "id"    },
            { "data": "name_ar" },
            { "data": "status" },
            { "data": "created_at" },
            { "data": "options"   , "orderable": false  },
        ],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50 , 100 , 500 , -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows' , '500 rows' ,'Show all' ]
        ],
        buttons: [
        'pageLength',
        'colvis',{
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
            extend: 'print',
            exportOptions: {
                stripHtml: true,
                columns: ':visible'
                }
            },
        ]
    });
}
</script>

{!!Html::script(asset('admin/js/custom-datatable.js'))!!}

@stop