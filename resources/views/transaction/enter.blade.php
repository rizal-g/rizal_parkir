@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="text-primary font-weight-bolder">Vehicle <span class="text-dark font-weight-normal">Entry Form</span></h6>
        </div>
        <div class="card-body">
          <form action="{{ route('transaction.storeEnter') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
              <label class="text-sm font-weight-bolder">Select Parking Location</label>
              <select name="id_lokasi" class="form-control" required>
                @foreach($locations as $loc)
                  <option value="{{ $loc->id }}">{{ $loc->location_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3">
              <label class="text-sm font-weight-bolder">Police Number</label>
              <input type="text" name="no_polisi" class="form-control" required placeholder="Contoh: B 1234 ABC" max="15">
            </div>
            <div class="form-group mb-4">
              <label class="text-sm font-weight-bolder">Vehicle Type</label>
              <select name="id_jenis" class="form-control" required>
                @foreach($vehicleTypes as $vt)
                  <option value="{{ $vt->id }}">{{ strtoupper($vt->jenis) }}</option>
                @endforeach
              </select>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('transaction.index') }}" class="btn btn-dark w-50 me-2">CANCEL</a>
              <button type="submit" class="btn bg-gradient-primary w-50 ms-2">ENTER VEHICLE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection