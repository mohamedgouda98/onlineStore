</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('adminAssets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('adminAssets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('adminAssets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminAssets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{ asset('adminAssets/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('adminAssets/plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/dashboard/dash_1.js') }}"></script>
<script src="{{ asset('adminAssets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
<script src="{{ asset('adminAssets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('adminAssets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('adminAssets/plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js')}}"></script>
<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage');
    $("input[name='quantity']").TouchSpin({
    buttondown_class: "btn btn-classic btn-danger",
    buttonup_class: "btn btn-classic btn-success"
});
</script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>
