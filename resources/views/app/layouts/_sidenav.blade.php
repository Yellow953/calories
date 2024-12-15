<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('app') }}">
            <div class="d-flex align-items-center">
                <img alt="Logo" src="{{ asset('assets/images/logo.png') }}" class="h-50px app-sidebar-logo-default" />
                <h2 class="app-sidebar-logo-default mx-2 my-auto text-white">Calories</h2>
            </div>

            <img alt="Logo" src="{{ asset('assets/images/logo.png') }}" class="h-40px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate active"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('app*') ? 'active' : '' }}" href="{{ route('app') }}">
                        <span class="menu-icon">
                            <i class="bi bi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                @can('categories.read')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('categories*') ? 'active' : '' }}"
                        href="{{ route('categories') }}">
                        <span class="menu-icon">
                            <i class="bi bi-box2-fill"></i>
                        </span>
                        <span class="menu-title">Categories</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('products.read')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('products*') ? 'active' : '' }}"
                        href="{{ route('products') }}">
                        <span class="menu-icon">
                            <i class="bi bi-bag-fill"></i>
                        </span>
                        <span class="menu-title">Products</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('orders.read')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('orders*') ? 'active' : '' }}"
                        href="{{ route('orders') }}">
                        <span class="menu-icon">
                            <i class="bi bi-clipboard-fill"></i>
                        </span>
                        <span class="menu-title">Orders</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('users.read')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('users*') ? 'active' : '' }}" href="{{ route('users') }}">
                        <span class="menu-icon">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('notifications.read')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('notifications*') ? 'active' : '' }}"
                        href="{{ route('notifications') }}">
                        <span class="menu-icon">
                            <i class="bi bi-bell-fill"></i>
                        </span>
                        <span class="menu-title">Notifications</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan

                @can('logs.read')
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs('logs*') ? 'active' : '' }}" href="{{ route('logs') }}">
                        <span class="menu-icon">
                            <i class="bi bi-receipt"></i>
                        </span>
                        <span class="menu-title">Logs</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @endcan
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<!--end::Sidebar-->