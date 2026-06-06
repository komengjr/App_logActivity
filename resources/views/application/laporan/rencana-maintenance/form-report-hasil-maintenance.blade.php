<link href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Report Monitoring Harian</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-3 pb-1" id="menu-add-data-pr-all">
        <div id="report-backup-harian"></div>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
<script>
    $('#report-backup-harian').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('laporan_rencana_maintenance_cetak_report') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": "{{ $code }}",
            "petugas": "{{ $petugas }}"
        },
        dataType: 'html',
    }).done(function(data) {
        $("#report-backup-harian").html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
        );
    }).fail(function() {
        $('#report-backup-harian').html('eror');
    });
</script>
