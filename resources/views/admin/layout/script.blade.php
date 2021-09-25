<script src="{{ asset('assets/js/app_admin.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('assets/fancybox/js/jquery.fancybox.min.js') }}"></script>

<script>
    const admin_call_ajax = "{{ route('admin_call_ajax') }}";

    function changeStatus(id, status, table) {
        $.ajax({
            type: "post",
            url: admin_call_ajax,
            data: {
                _token: '{{ csrf_token() }}',
                type: 'status',
                id: id,
                status: status,
                table: table
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                let status = false;
                if (response.status == 1) {
                    status = $(this).find('input').is(":checked");
                    $(this).find('input').attr('checked', status ? false : true);
                } else {
                    alert("Lỗi phát sinh vui lòng thử lại!");
                }
            }
        });
    }

    $(document).ready(function() {
        $(".price").change(function() {
            $(".price_sale").attr("max", $(this).val());
        });
        $(".price_sale, .price").on("input", function() {
            $(this).next().html(Number(this.value).toLocaleString('en-US') + 'đ');
        });
    });
</script>