<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/backend')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('vendor/backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/backend')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('vendor/backend')}}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor/backend')}}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('vendor/backend')}}/js/demo/chart-area-demo.js"></script>
<script src="{{asset('vendor/backend')}}/js/demo/chart-pie-demo.js"></script>

<script src="{{asset('vendor')}}/sweetalert/sweetalert.all.js"></script>
<script src="{{asset('vendor')}}/sweetalert/myscript.js"></script>

<script src="{{ asset('vendor/backend') }}/vendor/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('vendor/backend') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('vendor/backend') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<script type="text/javascript">
    $(function() {
        $('.btn-danger').click(function() {
            id = $(this).attr('data-id');
            $('#input-id').val(id);
            
            // alert( $('#input-id').val() )
        });
    });
</script>


@include('sweetalert::alert')
@yield('pageScripts')