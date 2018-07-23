<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div>
                    @if(Auth::user()->avatar !== '')
                        <img src="{{asset('/files/users/avatars/thumbnails/thumb_') . \Illuminate\Support\Facades\Auth::user()->avatar}}" alt="user-img" class="img-circle">
                    @else
                        <img src="{{asset('/plugins/images/male_blank.jpg')}}" alt="user-img" class="img-circle">
                    @endif
                </div>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="{{url('me')}}"><i class="fa fa-user"></i> بياناتي </a></li>
                    <li><a href="#"><i class="fa fa-list-ul"></i> مفكرات </a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> رسائل </a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="fa fa-wrench"></i> إعدادات شخصية </a></li>
                    @role('admin')
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href={{url('users')}}><i class="fa fa-shield"></i> إدارة المستخدمين </a>
                    </li>
                    @endrole
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> خروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="بحث شامل ...">
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{url('/')}}" class="waves-effect">
                    <i class="fa fa-home fa-fw"></i>
                    <span class="hide-menu">الرئيسية </span>
                </a>
            </li>
            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-user fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> المستفيدون
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    @can('see_beneficiaries')
                    <li>
                        <a href="{{url('beneficiaries')}}"> قائمة المستفيدين </a>
                    </li>
                    @endcan
                    @can('add_beneficiary')
                    <li>
                        <a href="{{url('beneficiaries/create')}}"> إضافة مستفيد جديد </a>
                    </li>
                    @endcan
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-edit fa-fw" data-icon="v"></i>
                    <span class="hide-menu">  دراسة حالة
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    @can('see_researches')
                    <li>
                        <a href="{{url('researches')}}"> البحوث السابقة </a>
                    </li>
                    @endcan
                    @can('add_research')
                    <li>
                        <a href="{{url('researches/create')}}"> عمل دراسة </a>
                    </li>
                    @endcan
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-gift fa-fw" data-icon="v"></i>
                    <span class="hide-menu">  المساعدات
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    @can('see_distributions')
                    <li><a href="{{url('distributions')}}">قائمة المساعدات</a></li>
                    @endcan
                    @can('add_distribution')
                    <li><a href="{{url('distributions/create')}}">إضافة مساعدة</a></li>
                    @endcan
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-shield fa-fw" data-icon="v"></i>
                    <span class="hide-menu">  إدارة المستخدمين
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    @can('see_users')
                    <li><a href="{{url('users')}}">قائمة المستخدمين</a></li>
                    @endcan
                    @can('add_user')
                    <li><a href="{{url('users/create')}}">إضافة مستخدم </a></li>
                    @endcan
                    @can('see_roles')
                    <li><a href="{{url('roles')}}">المجموعات</a></li>
                    @endcan
                    @can('add_role')
                    <li><a href="{{url('roles/create')}}">إضافة مجموعة</a></li>
                    @endcan
                </ul>
            </li>
            @role('admin')
            <li>
                <a href="#" class="waves-effect">
                    <i class="fa fa-cogs fa-fw" data-icon="v"></i>
                    <span class="hide-menu">  الإعدادات
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('departments')}}"><i class="fa fa-sitemap"></i> الإدارات </a>
                    </li>

                    <li>
                        <a href="{{url('jobs')}}"><i class="fa fa-address-card-o"></i> الوظائف </a>
                    </li>

                    <li>
                        <a href="{{url('research-kinds')}}"><i class="fa fa-wheelchair"></i> أنواع حالات </a>
                    </li>

                    <li>
                        <a href="{{url('incomes')}}"><i class="fa fa-money"></i> مصادر الدخل </a>
                    </li>

                    <li>
                        <a href="{{url('expenses')}}"><i class="fa fa-cart-arrow-down"></i> أنواع المصروفات </a>
                    </li>

                    <li>
                        <a href="{{url('money-needs')}}"><i class="fa fa-ambulance"></i> الاحتياجات المالية </a>
                    </li>

                    <li>
                        <a href="{{url('item-needs')}}"><i class="fa fa-cubes"></i> الاحتياجات العينية </a>
                    </li>

                    <li>
                        <a href="{{url('items')}}"><i class="fa fa-shopping-cart"></i> مواد المساعدات </a>
                    </li>

                    <li>
                        <a href="{{url('banks')}}"><i class="fa fa-institution"></i> البنوك </a>
                    </li>

                    <li>
                        <a href="{{url('nationalities')}}"><i class="fa fa-flag"></i> الجنسيات </a>
                    </li>

                    <li>
                        <a href="{{url('graduations')}}"><i class="fa fa-graduation-cap"></i> المؤهلات الدراسية </a>
                    </li>

                    <li>
                        <a href="{{url('education-specialties')}}"><i class="fa fa-book"></i> التخصصات الدراسية </a>
                    </li>

                    <li>
                        <a href="{{url('marital-statuses')}}"><i class="fa fa-street-view"></i> الحالة الاجتماعية </a>
                    </li>

                    <li>
                        <a href="{{url('family-roles')}}"><i class="fa fa-share-alt"></i> العلاقات الأسرية </a>
                    </li>

                    <li>
                        <a href="{{url('professions')}}"><i class="fa fa-wrench"></i> المهن </a>
                    </li>

                    <li>
                        <a href="{{url('areas')}}"><i class="fa fa-map-signs"></i> المناطفق </a>
                    </li>

                    <li>
                        <a href="{{url('cities')}}"><i class="fa fa-map"></i> المدن </a>
                    </li>

                </ul>
            </li>
            @endrole
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->