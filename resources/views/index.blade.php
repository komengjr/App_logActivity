@extends('layouts.base')
@section('content')
@if (Auth::user()->status_user == 1)
    @if (Auth::user()->kd_akses == 1)
        @include('masteradmin.index')
    @elseif(Auth::user()->kd_akses == 2)
        @include('admin.index')
    @elseif(Auth::user()->kd_akses == 3)
        @include('userleader.index')
    @elseif(Auth::user()->kd_akses == 4)
        @include('user.index')
    @elseif(Auth::user()->kd_akses == 5)
        @include('verifikator.index')
    @elseif(Auth::user()->kd_akses == 6)
        @include('verfy.index')
    @endif
@else

<script>
    document.getElementById("keluarform").click();
</script>

@endif
@endsection
