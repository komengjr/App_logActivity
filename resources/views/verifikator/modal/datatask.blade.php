<div class="modal-content border-danger">
    <div class="modal-header bg-dark">
        <form action="{{ asset('verifikator/datatask/user/pdf') }}" target="print_popup" method="post" enctype="multipart/form-data" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
            @csrf
            <input type="text" name="id" id="" value="{{$data->kd_schedule}}" hidden>
            <button type="submit" class="btn-info"><i class="fa fa-print"></i> Cetak</button>
        </form>

        <span>

            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="divtableworklist">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h5 class="page-title">Deskripsi Tugas :</h4>

            </div>

        </div>
        <div class="card p-3">
            @php
                echo $data->ket_schedule;
            @endphp
        </div>
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h5 class="page-title">Penyelesaian Tugas :</h4>

            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
    </div>
</div>
