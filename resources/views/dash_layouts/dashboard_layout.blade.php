<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    @include('dash_layouts.head')
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        @include('dash_layouts.main_menu')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            @include('dash_layouts.topbar')
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                @yield('content')

            </div> <!-- content -->
        
            <!-- Footer Start -->
            @include('dash_layouts.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('dash_layouts.foot')

</body>

</html>