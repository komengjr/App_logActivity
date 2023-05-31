<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#profile" data-toggle="pill"
                            class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i
                                class="fa fa-tasks"></i> <span class="hidden-xs">Penilaian</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i
                                class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">User Profile</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Nama</h6>
                                <p>
                                    {{$detailuser[0]->name}}
                                </p>
                                <h6>Akses</h6>
                                <p>
                                    @if ($detailuser[0]->kd_akses == 3)
                                        User Leader
                                    @elseif ($detailuser[0]->kd_akses == 4)
                                        User
                                    @elseif ($detailuser[0]->kd_akses == 5)
                                        Verifikator
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Grup Cabang</h6>
                                @foreach ($cabang as $cabang)
                                <a href="javascript:void();" class="badge badge-dark badge-pill">{{$cabang->nama_cabang}}</a>
                                @endforeach

                                <hr>
                                <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                                <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                                <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                            </div>
                            <div class="col-md-12">
                                <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Recent
                                    Activity</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>Dummy</strong> Telah dibuat tiket dengan nomor :
                                                    <strong>tiket-xxxxx</strong>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="messages">
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                                <i class="icon-info"></i>
                            </div>
                            <div class="alert-message">
                                <span><strong>Info!</strong> Lorem Ipsum is simply dummy text.</span>
                            </div>
                        </div>
                        <h6 class="mb-3">A. Kinerja Team</h6>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    @foreach ($kinerja as $item)
                                    @if ($item->jenis_kinerja == 1)

                                    <tr>
                                        <td>
                                            <span class="float-right font-weight-bold">0</span>{{$item->kinerja}}
                                        </td>
                                    </tr>
                                    @endif

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <h6 class="mb-3 pt-3">B. Kinerja Individu</h6>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    @foreach ($kinerja as $item1)
                                    @if ($item1->jenis_kinerja == 2)

                                    <tr>
                                        <td>
                                            <span class="float-right font-weight-bold">0</span>{{$item1->kinerja}}
                                        </td>
                                    </tr>
                                    @endif

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="edit">
                        <form>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="{{$detailuser[0]->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" value="11111122333">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Cancel">
                                    <input type="button" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
