@extends('layouts.app')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/css/bootstrap.css" rel="stylesheet"
        type="text/css">
    <link href="https://dprd.sulselprov.go.id/web/assets/DataTables-1.10.15/media/css/dataTables.bootstrap4.css"
        rel="stylesheet" type="text/css">
    <link
        href="https://dprd.sulselprov.go.id/web/assets/DataTables-1.10.15/extensions/Responsive/css/responsive.bootstrap4.css"
        rel="stylesheet" type="text/css">
    <div id="menu-updatedata">

        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Update Id </th>
                    <th>Chat Id </th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Text</th>
                    <th>date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->update_id }}</td>
                        <td>{{ $data->chat_id }}</td>
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->text }}</td>
                        <td>{{ $data->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <script src="{{ asset('js/script.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://dprd.sulselprov.go.id/web/assets/DataTables-1.10.15/media/js/jquery.dataTables.js"></script>
    <script src="https://dprd.sulselprov.go.id/web/assets/DataTables-1.10.15/media/js/dataTables.bootstrap4.js"></script>
    <script
        src="https://dprd.sulselprov.go.id/web/assets/DataTables-1.10.15/extensions/Responsive/js/dataTables.responsive.js">
    </script>
    <script
        src="https://dprd.sulselprov.go.id/web/assets/DataTables-1.10.15/extensions/Responsive/js/responsive.bootstrap4.js">
    </script>
    <script>
        // $(document).ready(function() {
        //     setInterval(function() {
        //         $.ajax({
        //             url: "../../api/bot/getupdates",
        //             type: "POST",
        //             cache: false,
        //             data: {
        //                 "_token": "{{ csrf_token() }}",
        //             },
        //             dataType: 'html',
        //             success: function(response) {
        //                 console.log(response);
        //                 if (response == 'false') {
        //                     $('#updatedata').html('123');
        //                 }else{
        //                     $('#updatedata').html(response);
        //                 }
        //             }
        //         });
        //     }, 5000);
        // });
    </script>
    {{-- <script>
        function showTime() {
                var waktu = $("#detikwaktu").text();
                $.ajax({
                        url: "user/notifikasi/lihatnotifwaktu",
                        type: "GET",
                        dataType: "html",
                    })
                    .done(function(data) {
                        $("#kayu").html(data);
                        if (waktu == data || data == 0) {

                        } else {
                            alert("Hello! I am an alert box!!");
                        }
                    })
                    .fail(function() {
                        $("#kayu").html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                        );
                    });

            }
            setInterval('showTime()', 2000);
    </script> --}}
@endsection
