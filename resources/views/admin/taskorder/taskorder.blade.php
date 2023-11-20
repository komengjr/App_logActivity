@extends('layouts.base')
@section('content')
    <div class="content-wrapper gradient-meridian">
        <div class="container-fluid">
            <div class="row pt-3 pb-2">
                <div class="col-sm-9">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Menu</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Task Order</li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i>
                            Setting</button>
                        <button type="button"
                            class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                            data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="javaScript:void();" class="dropdown-item">Action</a>
                            <a href="javaScript:void();" class="dropdown-item">Another action</a>
                            <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                        </div>
                    </div>
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
            <div class="row ">
                <div class="col-lg-12">
                    <div class="card gradient-meridian">
                        {{-- <div class="card-header text-uppercase">List Group with Custom content</div> --}}
                        <div class="">
                            <div class="list-group">
                                <span class="list-group-item flex-column align-items-start ">
                                    <div class="card bg-light m-3">
                                        <div class="card-body">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Monitoring Harian</h5>
                                                <small class="text-muted"><button class="btn-success" data-toggle="modal" data-target="#modal-task-order"><i
                                                            class="fa fa-plus"></i> Order</button></small>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table id="default-datatable" class="styled-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Order</th>
                                                <th>Group Kinerja</th>
                                                <th>Group Order</th>
                                                <th>Point</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($dataharian as $dataharian)
                                                <tr>
                                                    <td data-label="No">{{ $no++ }}</td>
                                                    <td data-label="Nama Order">{{ $dataharian->kinerja_sub }}</td>
                                                    <td data-label="Group Kinerja">{{ $dataharian->kinerja }}</td>
                                                    <td data-label="Group Order">{{ $dataharian->kd_jenis_kinerja }}</td>
                                                    <td class="text-right" data-label="Point">
                                                        {{ $dataharian->point_kinerja_sub }} Poin</td>
                                                    <td class="text-center" data-label="-">
                                                        <button class="btn-dark"><i class="fa fa-tasks"></i></button>
                                                        <button class="btn-danger"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <small class="text-muted">Donec id elit non mi porta.</small> --}}
                                </span>
                                <span class="list-group-item flex-column align-items-start mt-5">
                                    <div class="card bg-light m-3">
                                        <div class="card-body">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Monitoring Bulanan</h5>
                                                <small class="text-muted"><button class="btn-success"><i
                                                            class="fa fa-plus"></i> Order</button></small>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table id="default-datatable1" class="styled-table">
                                        <thead>
                                            <tr class="bg-warning">
                                                <th>No</th>
                                                <th>Nama Order</th>
                                                <th>Group Kinerja</th>
                                                <th>Group Order</th>
                                                <th>Point</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($databulanan as $databulanan)
                                                <tr>
                                                    <td data-label="No">{{ $no++ }}</td>
                                                    <td data-label="Nama Order">{{ $databulanan->kinerja_sub }}</td>
                                                    <td data-label="Group Kinerja">{{ $databulanan->kinerja }}</td>
                                                    <td data-label="Group Order">{{ $databulanan->kd_jenis_kinerja }}</td>
                                                    <td class="text-right" data-label="Point">
                                                        {{ $databulanan->point_kinerja_sub }} Poin</td>
                                                    <td class="text-center">
                                                        <button class="btn-dark"><i class="fa fa-tasks"></i></button>
                                                        <button class="btn-danger"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <small class="text-muted">Donec id elit non mi porta.</small> --}}
                                </span>
                                <span class="list-group-item flex-column align-items-start mt-5">
                                    <div class="card bg-light m-3">
                                        <div class="card-body">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Monitoring Tahunan</h5>
                                                <small class="text-muted"><button class="btn-success"><i
                                                            class="fa fa-plus"></i> Order</button></small>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table id="default-datatable2" class="styled-table">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th>No</th>
                                                <th>Nama Order</th>
                                                <th>Group Kinerja</th>
                                                <th>Group Order</th>
                                                <th>Point</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    {{-- <small class="text-muted">Donec id elit non mi porta.</small> --}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-task-order">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Monitoring</h5>
                    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('taskorder/postmonitoringharian', []) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nama Order</label>
                                <input type="text" name="order" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Group Kinerja</label>
                                <select name="kinerja" id="" class="form-control" required>
                                    <option value="">Pilih Group Kinerja</option>
                                    @foreach ($datakinerja as $item)
                                        <option value="{{$item->kd_kinerja}}">{{$item->kinerja}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Group Order</label>
                                <select name="jenis" id="" class="form-control" required>
                                    <option value="">Pilih Group Order</option>
                                    <option value="server">Server</option>
                                    <option value="network">Network</option>
                                    <option value="pc">PC / Komputer</option>
                                    <option value="massages">Gateway</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Poin Order</label>
                                <input type="text" class="form-control" name="poin" id="" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-times"></i>
                        Close</button>
                    <button type="submit" class="btn-primary"><i class="fa fa-check-square-o"></i> Save
                        changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
