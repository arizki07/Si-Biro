@include('layout.partials.head')

@yield('css')
<!-- Begin page -->
<div id="layout-wrapper">

    @include('layout.partials.header')
    <!-- ========== App Menu ========== -->

    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        @include('layout.partials.navbar')

        @include('layout.partials.sidebar')

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('content')
        <!-- End Page-content -->

        @include('layout.partials.footer')
    </div>
    <!-- end main content-->
</div>

<!-- END layout-wrapper -->

@yield('scripting')


@include('layout.partials.themes_setting')

@include('layout.partials.script')

</body>

</html>
