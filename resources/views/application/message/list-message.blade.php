<div class="os-resize-observer-host observed">
    <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
</div>
<div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
    <div class="os-resize-observer"></div>
</div>
<div class="os-content-glue" style="margin: 0px; height: 574px; width: 253px;"></div>
<div class="os-padding">
    <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px; height: auto; width: 100%;">
            <div class="list-group list-group-flush fw-normal fs--1">
                <div class="list-group-title border-bottom">Security</div>
                <!-- DATA SECURITY -->
                @foreach ($datasecurity as $datas)
                @if ($datas->laporan_security_status == 0 && $datas->laporan_security_respon == "")
                <div class="list-group-item text-warning" data-bs-toggle="modal" data-bs-target="#modal-template-xl" id="button-proses-data-pesan-security" data-code="{{ $datas->laporan_security_code }}">
                    <a class="notification notification-flush notification-unread" href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                                <img class="rounded-circle" src="{{ asset('img/security.png') }}" alt="">

                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1"><strong>{{ $datas->laporan_security_user }}</strong><br> TIngkat Kendala :
                                @if ($datas->laporan_security_level == '1')
                                <span class="badge bg-warning">Rendah</span>
                                @elseif ($datas->laporan_security_level == '2')
                                <span class="badge bg-warning">Sedang</span>
                                @elseif ($datas->laporan_security_level == '3')
                                <span class="badge bg-danger">Tinggi</span>
                                @endif
                            </p>
                            <span class="notification-time text-primary"><span class="me-2 fas fa-business-time"></span>{{ $datas->laporan_security_date }}</span>

                        </div>
                    </a>
                </div>
                @elseif($datas->laporan_security_status == 0 && $datas->laporan_security_it == Auth::user()->id_user)
                <div class="list-group-item text-warning" data-bs-toggle="modal" data-bs-target="#modal-template-xl" id="button-proses-data-pesan-security" data-code="{{ $datas->laporan_security_code }}">
                    <a class="notification notification-flush notification-unread" href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                                <img class="rounded-circle" src="{{ asset('img/security.png') }}" alt="">

                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1"><strong>{{ $datas->laporan_security_user }}</strong><br> TIngkat Kendala :
                                @if ($datas->laporan_security_level == '1')
                                <span class="badge bg-warning">Rendah</span>
                                @elseif ($datas->laporan_security_level == '2')
                                <span class="badge bg-warning">Sedang</span>
                                @elseif ($datas->laporan_security_level == '3')
                                <span class="badge bg-danger">Tinggi</span>
                                @endif
                            </p>
                            <span class="notification-time text-primary"><span class="me-2 fas fa-business-time"></span>{{ $datas->laporan_security_date }}</span>

                        </div>
                    </a>
                </div>
                @elseif($datas->laporan_security_status == 1 && $datas->laporan_security_it == Auth::user()->id_user)
                <div class="list-group-item text-warning" data-bs-toggle="modal" data-bs-target="#modal-template-xl" id="button-proses-data-pesan-security" data-code="{{ $datas->laporan_security_code }}">
                    <a class="notification notification-flush notification-unread" href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                                <img class="rounded-circle" src="{{ asset('img/security.png') }}" alt="">

                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1"><strong>{{ $datas->laporan_security_user }}</strong><br> TIngkat Kendala :
                                @if ($datas->laporan_security_level == '1')
                                <span class="badge bg-warning">Rendah</span>
                                @elseif ($datas->laporan_security_level == '2')
                                <span class="badge bg-warning">Sedang</span>
                                @elseif ($datas->laporan_security_level == '3')
                                <span class="badge bg-danger">Tinggi</span>
                                @endif
                            </p>
                            <span class="notification-time text-primary"><span class="me-2 fas fa-business-time"></span>{{ $datas->laporan_security_date }}</span>

                        </div>
                    </a>
                </div>
                @endif
                @endforeach
                <div class="list-group-title border-bottom">Support</div>
                <!-- DATA SUPPORT -->
                @foreach ($datapesan as $data)
                <div class="list-group-item" data-bs-toggle="modal" data-bs-target="#modal-template-xl" id="button-proses-data-pesan" data-code="{{ $data->tiket_laporan }}">
                    <a class="notification notification-flush notification-unread" href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-2xl me-3">
                                <img class="rounded-circle" src="{{ asset('img/notif.png') }}" alt="">

                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1"><strong>{{ $data->nama_user }}</strong><br> TIngkat Kendala :
                                @if ($data->tingkat_laporan == '1')
                                <span class="badge bg-warning">Rendah</span>
                                @elseif ($data->tingkat_laporan == '2')
                                <span class="badge bg-warning">Sedang</span>
                                @elseif ($data->tingkat_laporan == '3')
                                <span class="badge bg-danger">Tinggi</span>
                                @endif
                            </p>
                            <span class="notification-time text-primary"><span class="me-2 fas fa-business-time"></span>{{ $data->tgl_laporan }}</span>

                        </div>
                    </a>

                </div>
                @endforeach

                <!-- <div class="list-group-title border-bottom">Nasional</div> -->

            </div>
        </div>
    </div>
</div>
<div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
    <div class="os-scrollbar-track os-scrollbar-track-off">
        <div class="os-scrollbar-handle" style="transform: translate(0px, 0px); width: 100%;"></div>
    </div>
</div>
<div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
    <div class="os-scrollbar-track os-scrollbar-track-off">
        <div class="os-scrollbar-handle" style="transform: translate(0px, 0px); height: 52.9617%;"></div>
    </div>
</div>
<div class="os-scrollbar-corner"></div>
