<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Data Petugas </h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-4 pb-3" id="menu-add-data-pr-all">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-300 fs--1">
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>NIK / NIP</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Cabang</th>
                    <th>Divisi / Jabatan</th>
                    <th>Status Peserta</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="fs--2">
                @php
                $no = 1;
                @endphp

            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer px-4 bg-300">
    <span id="menu-add-data-simpanan">
        <button class="btn btn-success float-end"  data-bs-dismiss="modal">Close Data</button>
    </span>
</div>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
