 <div class="card mb-3 shadow-sm">
 <div class="card border border-danger">
                     <div class="card-header bg-danger">
                         <h6 class="fw-bold text-white mb-0"><i class="fas fa-clock-history me-1"></i> Log Backup Harian</h6>
                     </div>
                     <div class="card-body p-2">

                         <table class="table table-sm bg-white table-bordered align-middle mb-0 fs--2" id="table-backup-harian">
                             <thead class="bg-300">
                                 <tr>
                                     <td class="text-center">No</td>
                                     <td class="text-center">Verifikasi Backup</td>
                                     <td class="text-center">Sistem Backup</td>
                                     <td class="text-center">Proses Backup</td>
                                     <td class="text-center">Deskripsi</td>
                                     <td class="text-center">Bukti</td>
                                 </tr>
                             </thead>
                             <tbody>
                                 @php
                                 $no = 1;
                                 @endphp
                                 @foreach ($backupharian as $item)
                                 <tr>
                                     <td>{{$no++}}</td>
                                     <td>{{$item->created_at }}</td>
                                     <td>{{$item->sistem_backup_harian }}</td>
                                     <td>{{$item->proses_backup_harian }}</td>
                                     <td class="text-justify">
                                         @php
                                         echo $item->deskripsi_backup_harian;
                                         @endphp
                                     </td>
                                     <td class="text-center">
                                         @if ($item->file_backup_harian == "-")
                                         <span class="badge bg-danger">Kosong</span>
                                         @else
                                         <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('storage/' . $item->file_backup_harian))) }}" width="150">

                                         @endif
                                     </td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>

                     </div>
                 </div>
 <script>
    $(document).ready(function() {
    // CONTOH BASE64 IMAGE (Ganti string di bawah ini dengan kode Base64 gambar/logo kamu sendiri)
    // Jangan lupa hapus 'data:image/png;base64,' jika mengambil dari online generator, ambil string kodenya saja.
    var base64Logo = "iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUHBgUQCQ0TIn18vAAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdpdGggR0lNUFeBDhcAAAAMdEVYdFRpdGxlAExvZ28gQ29tcGFuefS17wAAArJJREFUeN7t21FKA0EQRNEe...";

    $('#table-backup-harian').DataTable({
        dom: "<'row mb-3'<'col-md-6 d-flex justify-content-start'B><'col-md-6 d-flex justify-content-end'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
        buttons: [
            { extend: 'copy', className: 'btn btn-secondary btn-sm' },
            { extend: 'csv', className: 'btn btn-secondary btn-sm' },
            {
                extend: 'excel',
                className: 'btn btn-success btn-sm',
                title: 'Log Patient Data',
                messageTop: '\n\n\n', // Memberikan ruang kosong di atas tabel untuk tempat gambar
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];

                    // 1. Definisikan Gambar ke dalam struktur file Excel
                    xlsx.xl['drawing'] = xlsx.xl['drawing'] || {};
                    xlsx.xl['media'] = xlsx.xl['media'] || {};

                    // Daftarkan gambar base64 ke folder media Excel
                    xlsx.xl['media']['image1.png'] = base64Logo;

                    // Buat XML relasi gambar
                    var drawingRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                        '<relationships xmlns="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' +
                        '<relationship id="rId1" type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" target="../media/image1.png"/>' +
                        '</relationships>';
                    xlsx.xl['drawing']['_rels'] = xlsx.xl['drawing']['_rels'] || {};
                    xlsx.xl['drawing']['_rels']['drawing1.xml.rels'] = drawingRels;

                    // Buat XML Gambar yang menempel di Cell Excel (Contoh ini menaruh di koordinat Cell A1 sampai B3)
                    var drawingXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                        '<xdr:wsDr xmlns:xdr="http://schemas.openxmlformats.org/drawingml/2006/spreadsheetDrawing" xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main">' +
                        '<xdr:twoCellAnchor>' +
                        '<xdr:from><xdr:col>0</xdr:col><xdr:colOff>0</xdr:colOff><xdr:row>0</xdr:row><xdr:rowOff>0</xdr:rowOff></xdr:from>' + // Mulai dari Kolom 1 (A), Baris 1
                        '<xdr:to><xdr:col>2</xdr:col><xdr:colOff>0</xdr:colOff><xdr:row>3</xdr:row><xdr:rowOff>0</xdr:rowOff></xdr:to>' +     // Selesai di Kolom 3 (C), Baris 4
                        '<xdr:pic>' +
                        '<xdr:nvPicPr><xdr:cNvPr id="1" name="Logo"/><xdr:cNvPicPr/></xdr:nvPicPr>' +
                        '<xdr:blipFill><a:blip xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" r:embed="rId1"/><a:stretch><a:fillRect/></a:stretch></xdr:blipFill>' +
                        '<xdr:spPr><a:xfrm><a:off x="0" y="0"/><a:ext cx="0" cy="0"/></a:xfrm><a:prstGeom prst="rect"><a:avLst/></a:prstGeom></xdr:spPr>' +
                        '</xdr:pic>' +
                        '<xdr:clientData/>' +
                        '</xdr:twoCellAnchor>' +
                        '</xdr:wsDr>';
                    xlsx.xl['drawing']['drawing1.xml'] = drawingXml;

                    // 2. Hubungkan Drawing XML ini ke Sheet utama
                    var sheetRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                        '<relationships xmlns="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' +
                        '<relationship id="rIdDrawing" type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/drawing" target="../drawing/drawing1.xml"/>' +
                        '</relationships>';
                    xlsx.xl['worksheets']['_rels'] = xlsx.xl['worksheets']['_rels'] || {};
                    xlsx.xl['worksheets']['_rels']['sheet1.xml.rels'] = sheetRels;

                    // Tambahkan tag drawing ke dalam file sheet1.xml sebelum tag penutup
                    var drawingTag = '<drawing xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" r:id="rIdDrawing"/>';
                    sheet.childNodes[0].appendChild(new DOMParser().parseFromString(drawingTag, 'text/xml').documentElement);
                }
            },
            { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Log Patient Data', orientation: 'landscape', pageSize: 'A4' },
            { extend: 'print', className: 'btn btn-info btn-sm' }
        ],
        language: {
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
