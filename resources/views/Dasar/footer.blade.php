<script src="{{ url('/MFC/library/jquery.js') }}"></script>
<script src="{{ url('/MFC/library/sfAct.js') }}" ></script>
<script src="{{ url('/MFC/library/sfInput.js') }}"></script>
<script src="{{ url('/MFC/library/sfLib.js') }}"></script>
<script src="{{ url('/MFC/library/sfTabel.js') }}"></script>
<script src="{{ url('/MFC/library/sfForm.js') }}"></script>
<script src="{{ url('/MFC/library/toastr/toastr.min.js') }}"></script>
<script src="{{ url('/MFC/library/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url('/MFC/library/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ url('/MFC/library/canvasjs/canvasjs.min.js') }}"></script>
<script src="@yield('folder')"></script>
<script>    
    const _router = {!! json_encode(url('/')) !!}, _code = {!! json_encode($code) !!};
    _       = {!! json_encode($dt) !!};
</script>
<script src="{{ url('/MFC/library/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/MFC/library/datatables/jquery.dataTables.js') }}"></script>

<script src="{{ url('/MFC/library/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/MFC/library/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/MFC/library/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/MFC/library/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ url('/MFC/library/sfApp.js') }}"></script>



