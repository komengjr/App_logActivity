@extends('layouts.template')
@section('content')
<style>
    .card-profile {

        /* Ketebalan dan warna dasar border (Ganti #00f2fe dengan warna pilihanmu) */
        border: 1px solid #fe0000;

        /* Animasi bercahaya halus */
        animation: simple-glow 0.5s ease-in-out infinite alternate;
    }

    /* Animasi Cahaya Redup-Terang */
    @keyframes simple-glow {
        0% {
            box-shadow: 0 0 5px rgba(0, 242, 254, 0.2);
        }

        100% {
            box-shadow: 0 0 15px rgba(253, 3, 3, 0.6);
        }
    }
</style>
<div class="row g-0">
    <div class="col-lg-8 pe-lg-2 ">
        <div class="card mb-3 card-profile">
            <div class="card-header position-relative min-vh-25 mb-7 ">
                <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(../../asset/img/generic/4.jpg);">
                </div>
                <!--/.bg-holder-->

                <div class="avatar avatar-5xl avatar-profile"><img class="rounded-circle img-thumbnail shadow-sm" src="{{ asset('storage/' . $bio->gambar) }}" width="200" alt="" /></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb-1"> {{ Auth::user()->name }} <span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span>
                        </h4>
                        <h5 class="fs-0 fw-normal">IT Support & Developer - {{ $bio->nip }}</h5>
                        <p class="text-500">{{ $bio->alamat }}</p>
                        <h5 class="fs-0 fw-normal">Handle :
                            @foreach ($handle as $hand)
                            <strong class="text-primary">{{ $hand->nama_cabang }}</strong> ,
                            @endforeach
                        </h5>
                        <div class="btn-group mt-2">
                            <button class="btn dropdown-toggle btn-primary btn-sm px-3" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Check In
                            </button>

                            <div class="dropdown-menu">
                                @foreach ($handle as $hand)
                                <a class="dropdown-item" href="#" id="button-proses-check-in" data-bs-toggle="modal" data-bs-target="#modal-template" data-code="{{ $hand->kd_cabang }}">{{ $hand->nama_cabang }}</a>
                                @endforeach
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a> -->
                            </div>
                        </div>
                        <button class="btn btn-falcon-default btn-sm px-3 mt-2" type="button" data-bs-toggle="modal" data-bs-target="#modal-template">Laksanakan Tugas</button>
                        <!-- <div class="border-dashed-bottom my-4 d-lg-none"></div> -->
                    </div>
                    <div class="col ps-2 ps-lg-3">

                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header bg-light d-flex justify-content-between">
                <h5 class="mb-0">Activity log</h5><a class="font-sans-serif" href="../../app/social/activity-log.html">All logs</a>
            </div>
            <div class="card-body fs--1 p-0">
                <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl me-3">
                            <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🎁</span></div>
                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><strong>{{ Auth::user()->name }}</strong> Lorem <strong>{{ Auth::user()->name }}</strong></p>
                        <span class="notification-time">November 13, 5:00 Am</span>

                    </div>
                </a>

                <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl me-3">
                            <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🏷️</span></div>
                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex nam officia beatae voluptatibus neque, quia consequuntur vero deserunt pariatur totam amet odio quasi repellat nostrum sapiente, ab magni, necessitatibus rem!</strong> tagged <strong>{{ Auth::user()->name }}</strong> in a post.</p>
                        <span class="notification-time">November 8, 5:00 PM</span>

                    </div>
                </a>

                <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl me-3">
                            <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📋️</span></div>
                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><strong>{{ Auth::user()->name }}</strong> joined <strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab in similique, fugiat amet veritatis temporibus nemo iste modi ex velit vel enim, voluptatum esse adipisci voluptate, suscipit aspernatur odit perferendis.</strong> with <strong>{{ Auth::user()->name }}</strong></p>
                        <span class="notification-time">November 01, 11:30 AM</span>

                    </div>
                </a>

                <a class="notification border-x-0 border-bottom-0 border-300 rounded-top-0" href="#!">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl me-3">
                            <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📅️</span></div>
                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><strong>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam ducimus est sunt rerum maiores veniam ut harum quos cumque debitis eaque ex atque nulla minus, itaque consequuntur porro et enim!</strong> invited <strong>{{ Auth::user()->name }}</strong> to an event</p>
                        <span class="notification-time">October 28, 12:00 PM</span>

                    </div>
                </a>

            </div>
        </div>

    </div>
    <div class="col-lg-4 ps-lg-2">
        <div class="sticky-sidebar">
            <div class="card mb-3 mb-lg-0">
                <div class="card-header bg-300">
                    <h5 class="mb-0">Rekap Laporan</h5>
                </div>
                <div class="card-body fs--1">
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month bg-success">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal-template" id="button-monitoring-harian">Monitoring Back Up Harian</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-success mb-0">Ready</p>
                            Note : Backup Harian & Kritis
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month bg-info">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#">Monitoring Back Up Bulanan</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-danger mb-0">Coming Soon</p>
                            Note : Backup Bulanan
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#">Monitoring Laporan User</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-danger mb-0">Coming Soon</p>
                            Note : Catatan Laporan User
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month bg-primary">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#">Rencana Maintenance Bulanan</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-danger mb-0">Coming Soon</p>
                            Note : Pastikan Jadwal Bulanan Sudah di setting
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light p-0 border-top"><a class="btn btn-link d-block w-100" href="#">All Feature<span class="fas fa-chevron-right ms-1 fs--2"></span></a></div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('base.js')

<script>
    $(document).on("click", "#button-proses-check-in", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('dashboard_check_in_proses') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });



    $(document).on("click", "#button-monitoring-harian", function(e) {
        e.preventDefault();
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('dashboard_monitoring_harian_kritis') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": 2123
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });
    $(document).on("click", "#button-preview-backup-harian-kritis", function(e) {
        e.preventDefault();
        const tanggal = document.getElementById('tanggal_monitoring_harian').value;
        $('#report-backup-harian').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        console.log(tanggal);

        $.ajax({
            url: "{{ route('dashboard_monitoring_harian_backup_kritis') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "date": tanggal
            },
            dataType: 'html',
        }).done(function(data) {
            $("#report-backup-harian").html(
                '<iframe src="data:application/pdf;base64, ' +
                data +
                '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
            );
        }).fail(function() {
            $('#report-backup-harian').html('eror');
        });
    });
    $(document).on("click", "#button-preview-backup-harian", function(e) {
        e.preventDefault();
        const tanggal = document.getElementById('tanggal_monitoring_harian').value;
        $('#report-backup-harian').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        console.log(tanggal);

        $.ajax({
            url: "{{ route('dashboard_monitoring_harian_backup_report') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "date": tanggal
            },
            dataType: 'html',
        }).done(function(data) {
            $("#report-backup-harian").html(
                '<iframe src="data:application/pdf;base64, ' +
                data +
                '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
            );
        }).fail(function() {
            $('#report-backup-harian').html('eror');
        });
    });
</script>
@endsection
