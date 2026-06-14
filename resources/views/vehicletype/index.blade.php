@extends('layouts.app')

@section('header_action')
    <div class="d-flex align-items-center gap-3">
        
        <div class="input-group mb-0" style="max-width: 180px;">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
        </div>
        
        <a href="{{ route('vehicletype.create') }}" class="btn bg-gradient-primary btn-sm mb-0 text-nowrap">+ ADD NEW VEHICLE TYPE</a>
        
        <a href="#" class="nav-link text-body font-weight-bold px-0 text-nowrap d-flex align-items-center mb-0 ms-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 0.82rem;">
            <i class="fa-solid fa-sign-out-alt me-2"></i>
            <span class="d-sm-inline d-none">Sign Out</span>
        </a>
        
        <form id="logout-form" action="/logout" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endsection

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="text-primary font-weight-bolder">Vehicle Type <span class="text-dark font-weight-normal">Data Table</span></h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2 mt-3">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NO</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">VEHICLE TYPE</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">FIRST HOUR</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NEXT HOUR</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MAX PER DAY</th>
                </tr>
              </thead>
              <tbody>
                @foreach($vehicleTypes as $key => $vt)
                <tr>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $key + 1 }}</span></td>
                  <td><span class="text-sm font-weight-bold text-uppercase">{{ $vt->jenis }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $vt->perjam_pertama }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $vt->perjam_berikutnya }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $vt->max_perhari }}</span></td>
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
        color: white !important;
    }
</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@if (session('simpan'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        swal("Success!", "{{ session('simpan') }}", "success");
    });
</script>
@endif

@endsection