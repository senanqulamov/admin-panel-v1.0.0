<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="{{ route('admin.index') }}" class="brand-logo">
            @if(!empty(setting('logo')))
                <img style="width: 85px" src="{{ asset('storage') }}/{{ setting('logo') }}" alt="Logo">
            @endif
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Toggle-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <!-- DASHBOARD -->
                <li class="menu-item {{ Route::is('admin.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path
                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                        fill="#000000" fill-rule="nonzero"/>
                                    <path
                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                        fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- CUSTOM SOZ -->
                <li class="menu-section">
                    <h4 class="menu-text">Menu</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <!-- Pages -->
{{--                <li class="menu-item menu-item-submenu {{ Route::is(['admin.page.index', 'admin.page.add', 'admin.page.edit']) ? 'menu-item-open' : '' }}" aria-haspopup="true"--}}
{{--                    data-menu-toggle="hover">--}}
{{--                    <a href="javascript:;" class="menu-link menu-toggle">--}}
{{--                        <span class="svg-icon menu-icon">--}}
{{--                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Substract.svg-->--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                    <rect x="0" y="0" width="24" height="24"/>--}}
{{--                                    <path--}}
{{--                                        d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z"--}}
{{--                                        fill="#000000" fill-rule="nonzero"/>--}}
{{--                                    <path--}}
{{--                                        d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z"--}}
{{--                                        fill="#000000" opacity="0.3"/>--}}
{{--                                </g>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <span class="menu-text">Səhifələr</span>--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                    </a>--}}
{{--                    <div class="menu-submenu">--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                        <ul class="menu-subnav">--}}
{{--                            <li class="menu-item {{ Route::is('admin.page.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.page.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Səhifələr</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is('admin.page.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.page.add') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Səhifə əlavə et</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <!-- Fayl Menecer -->
                <li class="menu-item {{ Route::is('admin.FileManager.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.FileManager.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/Group-folders.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M4.5,21 L21.5,21 C22.3284271,21 23,20.3284271 23,19.5 L23,8.5 C23,7.67157288 22.3284271,7 21.5,7 L11,7 L8.43933983,4.43933983 C8.15803526,4.15803526 7.77650439,4 7.37867966,4 L4.5,4 C3.67157288,4 3,4.67157288 3,5.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 Z"
                                        fill="#000000" opacity="0.3"/>
                                    <path
                                        d="M2.5,19 L19.5,19 C20.3284271,19 21,18.3284271 21,17.5 L21,6.5 C21,5.67157288 20.3284271,5 19.5,5 L9,5 L6.43933983,2.43933983 C6.15803526,2.15803526 5.77650439,2 5.37867966,2 L2.5,2 C1.67157288,2 1,2.67157288 1,3.5 L1,17.5 C1,18.3284271 1.67157288,19 2.5,19 Z"
                                        fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Fayl Menecer</span>
                    </a>
                </li>

                <!-- Post -->
{{--                <li class="menu-item menu-item-submenu {{ Route::is(['admin.post.index', 'admin.post.add', 'admin.post.edit', 'admin.post.category.index', 'admin.post.category.add', 'admin.post.category.edit', 'admin.post.search', 'admin.post.categories']) ? 'menu-item-open' : '' }}"--}}
{{--                    aria-haspopup="true" data-menu-toggle="hover">--}}
{{--                    <a href="javascript:;" class="menu-link menu-toggle">--}}
{{--                        <span class="svg-icon menu-icon">--}}
{{--                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Clipboard-list.svg-->--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                    <rect x="0" y="0" width="24" height="24"/>--}}
{{--                                    <path--}}
{{--                                        d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"--}}
{{--                                        fill="#000000" opacity="0.3"/>--}}
{{--                                    <path--}}
{{--                                        d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"--}}
{{--                                        fill="#000000"/>--}}
{{--                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>--}}
{{--                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>--}}
{{--                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>--}}
{{--                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>--}}
{{--                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>--}}
{{--                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>--}}
{{--                                </g>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <span class="menu-text">Bloqlar</span>--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                    </a>--}}
{{--                    <div class="menu-submenu">--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                        <ul class="menu-subnav">--}}
{{--                            <li class="menu-item {{ Route::is(['admin.post.index', 'admin.post.edit', 'admin.post.search']) ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.post.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Bloqlar</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is('admin.post.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.post.add') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Bloq əlavə et</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <!-- Gallery / Portfoliolar -->
{{--                <li class="menu-item menu-item-submenu {{ Route::is(['admin.gallery.index', 'admin.gallery.add', 'admin.gallery.edit', 'admin.gallery.search', 'admin.gallery.showHomePageFilter', 'admin.gallery.category.index', 'admin.gallery.category.add', 'admin.gallery.category.edit', 'admin.gallery.categories', 'admin.gallery.category.search', 'admin.gallery.activity.index', 'admin.gallery.activity.add', 'admin.gallery.activity.edit', 'admin.gallery.activities', 'admin.gallery.activity.search', 'admin.gallery.country.index', 'admin.gallery.country.add', 'admin.gallery.country.edit', 'admin.gallery.countries', 'admin.gallery.country.search']) ? 'menu-item-open' : '' }}"--}}
{{--                    aria-haspopup="true" data-menu-toggle="hover">--}}
{{--                    <a href="javascript:;" class="menu-link menu-toggle">--}}
{{--                        <span class="svg-icon menu-icon">--}}
{{--                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Tools/Pantone.svg-->--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                    <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--                                    <path--}}
{{--                                        d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L8,21 C5.790861,21 4,19.209139 4,17 C4,14.790861 5.790861,13 8,13 L20,13 C21.1045695,13 22,13.8954305 22,15 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"--}}
{{--                                        fill="#000000" opacity="0.3"/>--}}
{{--                                    <path--}}
{{--                                        d="M15.5421357,5.69999981 L18.3705628,8.52842693 C19.1516114,9.30947552 19.1516114,10.5758055 18.3705628,11.3568541 L9.88528147,19.8421354 C8.3231843,21.4042326 5.79052439,21.4042326 4.22842722,19.8421354 C2.66633005,18.2800383 2.66633005,15.7473784 4.22842722,14.1852812 L12.7137086,5.69999981 C13.4947572,4.91895123 14.7610871,4.91895123 15.5421357,5.69999981 Z"--}}
{{--                                        fill="#000000" opacity="0.3"/>--}}
{{--                                    <path d="M5,3 L9,3 C10.1045695,3 11,3.8954305 11,5 L11,17 C11,19.209139 9.209139,21 7,21 C4.790861,21 3,19.209139 3,17 L3,5 C3,3.8954305 3.8954305,3 5,3 L7,3 Z"--}}
{{--                                          fill="#000000"/>--}}
{{--                                </g>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <span class="menu-text">Portfoliolar</span>--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                    </a>--}}
{{--                    <div class="menu-submenu">--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                        <ul class="menu-subnav">--}}
{{--                            <li class="menu-item {{ Route::is(['admin.gallery.index', 'admin.gallery.edit', 'admin.gallery.search', 'admin.gallery.showHomePageFilter']) ? 'menu-item-active' : '' }}"--}}
{{--                                aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.gallery.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Portfoliolar</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is('admin.gallery.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.gallery.add') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Portfolio əlavə et</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is(['admin.gallery.category.index', 'admin.gallery.category.add', 'admin.gallery.category.edit', 'admin.gallery.categories', 'admin.gallery.category.search']) ? 'menu-item-active' : '' }}"--}}
{{--                                aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.gallery.category.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Kateqoriyalar</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is(['admin.gallery.activity.index', 'admin.gallery.activity.add', 'admin.gallery.activity.edit', 'admin.gallery.activities', 'admin.gallery.activity.search']) ? 'menu-item-active' : '' }}"--}}
{{--                                aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.gallery.activity.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Fəaliyyətlər</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is(['admin.gallery.country.index', 'admin.gallery.country.add', 'admin.gallery.country.edit', 'admin.gallery.countries', 'admin.gallery.country.search']) ? 'menu-item-active' : '' }}"--}}
{{--                                aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.gallery.country.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Ölkələr</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <!-- Service -->
                <li class="menu-item menu-item-submenu {{ Route::is(['admin.service.index', 'admin.service.add', 'admin.service.edit', 'admin.service.category.index', 'admin.service.category.add', 'admin.service.category.edit', 'admin.service.search', 'admin.service.categories']) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Server.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z"
                                        fill="#000000" opacity="0.3"/>
                                    <path
                                        d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z"
                                        fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">İstiqamətlər</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ Route::is(['admin.service.index', 'admin.service.edit', 'admin.service.search']) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.service.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">İstiqamətlər</span>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('admin.service.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.service.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">İstiqamət əlavə et</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Menular -->
                <li class="menu-item menu-item-submenu {{ Route::is(['admin.menu.index', 'admin.menu.edit', 'admin.menu.add']) ? 'menu-item-open' : '' }}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Menu.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                    <path
                                        d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                        fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Menyu</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ Route::is(['admin.menu.index', 'admin.menu.edit']) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.menu.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Menyu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Slides -->
                <li class="menu-item menu-item-submenu {{ Route::is(['admin.slide.index', 'admin.slide.add', 'admin.slide.edit']) ? 'menu-item-open' : '' }}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Image.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path
                                        d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
                                        fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">Slaydlar</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ Route::is('admin.slide.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.slide.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Slaydlar</span>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('admin.slide.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.slide.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Slayd əlavə et</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Faqlar -->
{{--                <li class="menu-item menu-item-submenu {{ Route::is(['admin.faq.index', 'admin.faq.add', 'admin.faq.edit']) ? 'menu-item-open' : '' }}" aria-haspopup="true" data-menu-toggle="hover">--}}
{{--                    <a href="javascript:;" class="menu-link menu-toggle">--}}
{{--                        <span class="svg-icon menu-icon">--}}
{{--                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Image.svg-->--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                    <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--                                    <path--}}
{{--                                        d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"--}}
{{--                                        fill="#000000"/>--}}
{{--                                </g>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <span class="menu-text">Faqlar</span>--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                    </a>--}}
{{--                    <div class="menu-submenu">--}}
{{--                        <i class="menu-arrow"></i>--}}
{{--                        <ul class="menu-subnav">--}}
{{--                            <li class="menu-item {{ Route::is('admin.faq.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.faq.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Faqlar</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item {{ Route::is('admin.faq.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.faq.add') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>--}}
{{--                                    <span class="menu-text">Faq əlavə et</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <!-- İstifadəçilər -->
                <li class="menu-item menu-item-submenu {{ Route::is(['admin.user.index', 'admin.user.add', 'admin.user.edit']) ? 'menu-item-open' : '' }}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Address-card.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
                                        fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">İstifadəçilər</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ Route::is('admin.user.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.user.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">İstifadəçilər</span>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('admin.user.add') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.user.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">İstifadəçi əlavə et</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Ayarlar -->
                <li class="menu-item menu-item-submenu {{ Route::is(['admin.logs', 'admin.setting.index']) ? 'menu-item-open' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                        <span class="svg-icon menu-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                   <rect x="0" y="0" width="24" height="24"/>
                                   <path
                                       d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                       fill="#000000"/>
                               </g>
                           </svg>
                        </span>
                        <span class="menu-text">Ayarlar</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ Route::is('admin.setting.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.setting.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Ayarlar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Dillər -->
                <li class="menu-item menu-item-submenu {{ Route::is(['admin.language.index', 'admin.language.search', 'admin.languageGroup.index', 'admin.languageGroup.search', 'admin.languageGroup.groupDetailSearch', 'admin.languageGroup.detail', 'admin.languagePhrase.index', 'admin.languagePhrase.search']) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z"
                                            fill="#000000"/>
                                        <path
                                            d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                                    </span>
                        <span class="menu-text">Dillər</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <!--  Dillər  -->
                            <li class="menu-item {{ Route::is(['admin.language.index', 'admin.language.search']) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.language.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Dillər</span>
                                </a>
                            </li>
                            <!--  Dil Qrupları  -->
                            <li class="menu-item {{ Route::is(['admin.languageGroup.index', 'admin.languageGroup.search', 'admin.languageGroup.groupDetailSearch', 'admin.languageGroup.detail']) ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.languageGroup.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Dil qrupları</span>
                                </a>
                            </li>
                            <!--  Ifadələr  -->
                            <li class="menu-item {{ Route::is(['admin.languagePhrase.index', 'admin.languagePhrase.search']) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('admin.languagePhrase.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">İfadələr</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
