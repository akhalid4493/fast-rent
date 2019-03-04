<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item start active">
                <a href="{{ url(route('admin')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">لوحة التحكم</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">الاعضاء و الصلاحيات</h3>
            </li>

            @permission('show_roles')
            <li class="nav-item">
                <a href="{{ url(route('roles.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-lock"></i>
                    <span class="title">عرض الصلاحيات</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_users')
            <li class="nav-item">
                <a href="{{ url(route('users.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">عرض الاعضاء</span>
                </a>
            </li>
            @endpermission
            
                        
            <li class="heading">
                <h3 class="uppercase">التحكم</h3>
            </li>

            @permission('show_governorates')
            <li class="nav-item">
                <a href="{{ url(route('governorates.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">عرض المحافظات</span>
                </a>
            </li>
            @endpermission


            @permission('show_provinces')
            <li class="nav-item">
                <a href="{{ url(route('provinces.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">عرض المناطق</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_slider')
            <li class="nav-item">
                <a href="{{ url(route('slider.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">الشرائح</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_transmission')
            <li class="nav-item">
                <a href="{{ url(route('transmissions.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">انواع ناقل الحركة</span>
                </a>
            </li>
            @endpermission

            @permission('show_colors')
            <li class="nav-item">
                <a href="{{ url(route('colors.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">الالوان</span>
                </a>
            </li>
            @endpermission

            @permission('show_features')
            <li class="nav-item">
                <a href="{{ url(route('features.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">مميزات ، امكانيات اضافية</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_categories')
            <li class="nav-item">
                <a href="{{ url(route('categories.index'))}}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">الاقسام</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_rent_types')
            <li class="nav-item">
                <a href="{{ url(route('types.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">انواع التأجير</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_brands')
            <li class="nav-item">
                <a href="{{ url(route('brands.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">العلامات التجارية</span>
                </a>
            </li>
            @endpermission

            @permission('show_models')
            <li class="nav-item">
                <a href="{{ url(route('models.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">الموديلات</span>
                </a>
            </li>
            @endpermission
            
            <li class="heading">
                <h3 class="uppercase">المكاتب و السيارات</h3>
            </li>

            @permission('show_agencies')
            <li class="nav-item">
                <a href="{{ url(route('agencies.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">المكاتب</span>
                </a>
            </li>
            @endpermission

            @permission('show_cars')
            <li class="nav-item">
                <a href="{{ url(route('cars.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">سيارات المكاتب</span>
                </a>
            </li>
            @endpermission

            <li class="heading">
                <h3 class="uppercase">اعدادات</h3>
            </li>

            {{-- @permission('show_notifications')
            <li class="nav-item">
                <a href="{{ url(route('notifications')) }}" class="nav-link nav-toggle">
                    <i class="fa fa-bell"></i>
                    <span class="title">اشعارات عامة</span>
                </a>
            </li>
            @endpermission --}}

            @permission('show_pages')
            <li class="nav-item">
                <a href="{{ url(route('pages.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">عرض الصفحات</span>
                </a>
            </li>
            @endpermission
            
            @permission('show_settings')
            <li class="nav-item">
                <a href="{{ url(route('settings.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">الآعدادات</span>
                </a>
            </li>
            @endpermission
        </ul>
    </div>
</div>