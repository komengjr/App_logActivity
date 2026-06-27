<div class="card mb-3 shadow-sm">
    <div class="card-header bg-primary py-3">
        <h5 class="mb-0 h6 fw-bold text-white">3. Laporan Kendala User</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle fs--1" id="example">
                <thead class="bg-300">
                    <tr>
                        <td class="text-center">No</td>
                        <td class="text-center">Tiket Laporan</td>
                        <td class="text-center">Nama Pelapor</td>
                        <td class="text-center">Kategori Laporan</td>
                        <td class="text-center">Deskripsi Masalah</td>
                        <td class="text-center">Tanggal Laporan</td>
                        <td class="text-center">Terima Laporan</td>
                        <td class="text-center">Tindakan Perbaikan</td>
                        <td class="text-center">Selesai Laporan</td>
                        <td class="text-center">Di Bawah 5 Menit</td>
                        <td class="text-center">Status Laporan</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($kendala as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->tiket_laporan }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td>
                            @if ($item->kategori_laporan == 'ER-001')
                            Software
                            @else
                            Hardware
                            @endif
                        </td>
                        <td>
                            @php
                            echo $item->deskripsi_laporan;
                            @endphp
                        </td>
                        <td>{{ $item->tgl_laporan }}</td>
                        <td>{{ $item->tgl_respon_laporan }}</td>
                        <td>
                            @php
                            $penyelesaian = DB::table('tbl_laporan_user_log')->where('tiket_laporan',$item->tiket_laporan)->first();
                            @endphp
                            @if ($penyelesaian)
                            @php
                            echo $penyelesaian->deskripsi_penyelesaian;
                            @endphp
                            @endif
                        </td>
                        <td>{{ $item->tgl_selesai_laporan }}</td>
                        <td><span class="badge bg-success">
                                @php
                                $dari = date_create($item->tgl_respon_laporan);
                                $sampai = date_create($item->tgl_selesai_laporan);
                                $diff = date_diff($dari, $sampai);
                                echo $diff->format(' %H:%i:%s');
                                @endphp

                                {{-- {{$datamenit}} --}}
                            </span>
                        </td>
                        <td>
                            @if ($item->status_laporan == 2)
                            Selesai
                            @else
                            Belum Selesai
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: "<'row mb-3'<'col-md-6 d-flex justify-content-start'B><'col-md-6 d-flex justify-content-end'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-secondary btn-sm'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-secondary btn-sm'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success btn-sm',
                    title: 'Log Patient Data'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: 'Log Email Data',
                    orientation: 'landscape', // Opsional: dibuat landscape karena kolomnya cukup lebar
                    pageSize: 'A4'
                },
                {
                    extend: 'print',
                    className: 'btn btn-info btn-sm'
                }
            ],
            language: {
                // Opsional: Untuk mengubah teks pencarian menjadi bahasa Indonesia
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(disaring dari _MAX_ total data)"
            }
        });
    });
</script>
