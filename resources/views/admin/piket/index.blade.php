@extends('layouts.base')
@section('content')
    <style>
        .full_modal-dialog {
            width: 98% !important;
            height: 92% !important;
            min-width: 98% !important;
            min-height: 92% !important;
            max-width: 98% !important;
            max-height: 92% !important;
            padding: 0 !important;
            margin: 1% !important;
        }

        .full_modal-content {
            height: 99% !important;
            min-height: 99% !important;
            max-height: 99% !important;
        }
    </style>
    <div class="content-wrapper gradient-meridian">
        <div class="container-fluid">
            <div class="row pt-2 pb-2">
                <div class="col-sm-12">
                    <h4 class="page-title"></h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Menu</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cabang</li>
                    </ol>
                </div>

            </div>
            @if ($message = Session::get('sukses'))
                <button class="btn btn-warning" onclick="sukses_notifikasi()" id="buttonnotif" hidden></button>
                <script>
                    function sukses_notifikasi() {
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'center top',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            icon: 'fa fa-check-circle',
                            width: 400,
                            msg: '{{ $message }}'
                        });
                    }
                    $(document).ready(function() {
                        $('#buttonnotif').click();
                    });
                </script>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Data Cabang</div>
                        <div class="card-body">
                            <form action="{{ url('api/bot/sendmessage', []) }}" method="post">
                                @csrf
                                <input type="text" name="pesan" id="pesan">
                                <button type="submit" class="btn-warning">sendmasgae</button>
                            </form>
                            <form action="{{ url('api/bot/getupdates', []) }}" method="post">
                                @csrf
                                <button type="submit" class="btn-warning">update</button>
                            </form>
                            <div class="">
                                <table id="default-datatable" class="styled-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Cabang</th>
                                            <th>Nama Cabang</th>
                                            <th>Alamat</th>
                                            <th>Total Order Cabang</th>
                                            <th>Total Handle User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td data-label="No">{{ $no++ }}</td>
                                                <td data-label="Kode Cabang">{{ $item->kd_cabang }}</td>
                                                <td data-label="Nama Cabang">{{ $item->nama_cabang }}</td>
                                                <td data-label="Alamat">{{ $item->alamat }}</td>
                                                <td data-label="Total Order">

                                                </td>
                                                <td class="text-right">
                                                    @php
                                                        $total = DB::table('users_handler_backup')
                                                            ->where('kd_cabang', $item->kd_cabang)
                                                            ->count();
                                                    @endphp
                                                    {{ $total }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a href="javascript:void();" class=" dropdown-toggle-nocaret"
                                                            data-toggle="dropdown">
                                                            <i class="icon-options"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modal-admin" id="button-modal-setting-hendle"
                                                                data-id="{{ $item->kd_cabang }}"><i
                                                                    class="fa fa-file-text"></i> Setting Hendle</a>
                                                            <a class="dropdown-item" href="javascript:void();"
                                                                data-toggle="modal" data-target="#showdatamaps"
                                                                id="tugasuserlainnya"><i class="fa fa-file-text"></i> Task
                                                                Cabang</a>
                                                            {{-- <a class="dropdown-item" href="javascript:void();">Another action</a> --}}
                                                            <div class="dropdown-divider"></div>
                                                            <a href="javaScript:void();" class="dropdown-item"
                                                                data-toggle="modal" data-target="#inputtiketbaruadmin"
                                                                id="buttonadminbuattiket"><i class="fa fa-tasks"></i>
                                                                Monitoring Cabang</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Row-->
        </div>
    </div>

    <div class="modal fade" id="modal-admin">
        <div class="modal-dialog modal-dialog-centered full_modal-dialog" id="button-modal-admin-show">
            <div class="modal-content full_modal-content">
                <div class="text-center">
                    <img src="{{ asset('loading1.gif', []) }}" alt="" srcset="" width="250"
                        style="height: auto;">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin-app.js', []) }}"></script>
@endsection
