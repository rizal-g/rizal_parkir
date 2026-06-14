@extends('layouts.app') 

@section('header_action')
<div class="d-flex align-items-center gap-3">
        <div class="input-group" style="max-width: 180px;">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
        </div>

        <a href="{{ route('location.create') }}" class="btn btn-primary btn-sm mb-0 text-nowrap">+ ADD NEW LOCATION</a>

        <a href="#" class="nav-link text-body font-weight-bold px-0 text-nowrap ms-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-sign-out-alt me-sm-1"></i>
            <span class="d-sm-inline d-none">Sign Out</span>
        </a>
        
    </div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success text-white">
            {{ session('success') }}
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6 class="text-primary font-weight-bolder">Location <span class="text-dark font-weight-normal">Data Table</span></h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2 mt-3">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">LOCATION NAME</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MAX MOTORCYCLE</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MAX CAR</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MAX TRUCK/BUS/OTHER</th>
                </tr>
                </thead>
                <tbody>
                @foreach($locations as $key => $loc)
                <tr>
                    <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $key + 1 }}</span></td>
                    <td><span class="text-sm font-weight-bold">{{ $loc->location_name }}</span></td>
                    <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $loc->max_motorcycle }}</span></td>
                    <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $loc->max_car }}</span></td>
                    <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $loc->max_other }}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<div class="page-footer pt-3">© ASAT 2026, made by <a href="#">Eure Reeyn</a> for ASAT Web And Mobile Development - SMKN 1 Cibinong.</div>


<style>
    .swal-button--confirm, .swal-button--confirm:hover {
        background-color: #e91e63 !important; 
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session('simpan'))
<script>
    swal("Success!", "{{ session('simpan') }}", "success");
</script>
@endif
@endsection