@extends('layouts.base')
@section('content')
    @if (auth::user()->kd_akses == 1)
        @include('masteradmin.index') 
    @elseif(auth::user()->kd_akses == 2)
        @include('admin.index') 
    @elseif(auth::user()->kd_akses == 3)
        @include('userleader.index') 
    @elseif(auth::user()->kd_akses == 4)   
        @include('user.index') 
    @elseif(auth::user()->kd_akses == 5)   
        @include('verifikator.index') 
    @endif
@endsection
