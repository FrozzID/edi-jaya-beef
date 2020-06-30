<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('backend.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('backend.partials.navbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            @include('backend.partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('backend.partials.modal')
    @include('backend.partials.scripts')

</body>

</html>