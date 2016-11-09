@if(Session::has('toast_message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-full-width",
            "onclick": null,
            "showDuration": "4000",
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "1000",
            "showEasing": "linear",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.{{Session::get('toast_message')['type']}}("{{Session::get('toast_message')['content']}}");
    </script>
@endif