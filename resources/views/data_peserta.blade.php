@extends('layouts.base')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><i class="fa fa-table"></i> Data Exporting</div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>email pesera</th>
                    <th>nama Peserta</th>
                    <th>Pre_test</th>
                    <th>waktu Pre_test</th>
                    <th>Post Tes</th>
                    <th>WaktuPost Tes</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($peserta as $peserta)

                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$peserta->nama}}</td>
                    <td>{{$peserta->email}}</td>

                        @php
                            $cekpretest = DB::table('pre_test')->where('nama',$peserta->nama)->get();
                        @endphp
                        @if ($cekpretest->isEmpty())
                        <td></td>
                        <td></td>
                        @else
                        <td>{{$cekpretest[0]->score}}</td>
                        <td>{{$cekpretest[0]->waktu_pre}}</td>
                        @endif


                        @php
                            $cekpretest1 = DB::table('post_test')->where('nama',$peserta->nama)->get();
                        @endphp
                        @if ($cekpretest1->isEmpty())
                        <td></td>
                        <td></td>
                        @else
                        <td>{{$cekpretest1[0]->score}}</td>
                        <td>{{$cekpretest1[0]->waktu}}</td>
                        @endif


                </tr>

                @endforeach

                {{-- @foreach ($post_test as $post_test)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$post_test->email}}</td>
                    <td>
                        @php
                            $carinama = DB::table('event_peserta')->where('email',$post_test->email)->get();
                        @endphp
                        @if ($carinama->isEmpty())

                        @else
                            {{$carinama[0]->nama}}
                        @endif
                    </td>
                </tr>
                @endforeach --}}

                {{-- @foreach ($pre_test as $pre_test)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$pre_test->email}}</td>
                    <td>
                        @php
                            $carinama = DB::table('event_peserta')->where('email',$pre_test->email)->get();
                        @endphp
                        @if ($carinama->isEmpty())

                        @else
                            {{$carinama[0]->nama}}
                        @endif
                    </td>
                </tr> --}}
                {{-- @endforeach --}}
            </tbody>

        </table>
        </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
  <script>
    $(document).ready(function() {
     //Default data table
      $('#default-datatable').DataTable();


      var table = $('#example').DataTable( {
       lengthChange: false,
       buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
     } );

    table.buttons().container()
       .appendTo( '#example_wrapper .col-md-6:eq(0)' );

     } );

   </script>
@endsection
