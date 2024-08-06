<div id="updatedata">
    <table>
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
                    <td>{{ $data['update_id'] }}</td>
                    <td>{{ $data['chat_id'] }}</td>
                    <td>{{ $data['first_name'] }}</td>
                    <td>{{ $data['last_name'] }}</td>
                    <td>{{ $data['text'] }}</td>
                    <td>{{ $data['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="{{ asset('js/script.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: "../../api/bot/getupdates",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'html',
                success: function(response) {
                    $('#updatedata').html(response);
                }
            });
        }, 10000);
    });
</script>
{{-- <script>
    function showTime() {
        $.ajax({
                url: "../../api/bot/getupdates",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'html',
            })
            .done(function(data) {
                $('#updatedata').html(data);
                // console.log('sukses');

            })
            .fail(function() {
                // $("#kayu").html(
                //     '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                // );
                console.log('eror');

            });

    }
    setInterval('showTime()', 4000);
</script> --}}
