<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Proses Data Validasi Bisone</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-4 pb-3" id="menu-create-data-form">
        <div id="loading-table"></div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-300 fs--1">
                <tr>
                    <th>No</th>
                    <th>Kategori Menu</th>
                    <th>Sub Menu</th>
                    <th>Token</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody class="fs--1">
                @php
                $no = 1;
                @endphp
                @foreach ($data as $datas)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $datas->b_menus_kategori }} </td>

                    <td>
                        @php
                        $sub = DB::table('b_menus_sub')->where('b_menus_code',$datas->b_menus_code )->get();
                        @endphp
                        @foreach ($sub as $subs)
                        <li>{{ $subs->b_menus_sub_name }}</li>
                        @endforeach
                    </td>
                    <td>
                        @php
                        $token = DB::table('b_validasi_data_req')->where('b_validasi_data_code',$code )->where('b_menus_code',$datas->b_menus_code )->first();
                        @endphp
                        @if ($token)
                        {{ $token->b_validasi_data_req_code }} <br>
                        {{ route('v3_get_token_validasi',['token'=>$token->b_validasi_data_req_code]) }}
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm float-end" id="button-create-data-form" data-code="{{ $datas->b_menus_code }}" data-id="{{ $code }}">Create Form</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
