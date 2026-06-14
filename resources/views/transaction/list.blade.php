@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="text-primary font-weight-bolder">All Parking <span class="text-dark font-weight-normal">Tickets Log</span></h6>
          <a href="{{ route('transaction.index') }}" class="btn btn-dark btn-sm mb-0">BACK TO DASHBOARD</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2 mt-3">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NO</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TICKET NUMBER</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">POLICE NUMBER</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">LOCATION</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TYPE</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TIME IN</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TIME OUT</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TOTAL PAY</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">STATUS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tickets as $key => $t)
                <tr>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $key + 1 }}</span></td>
                  <td><span class="text-sm font-weight-bold text-dark">#{{ $t->no_tiket }}</span></td>
                  <td><span class="text-sm font-weight-bold text-uppercase text-dark">{{ $t->no_polisi }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold">{{ $t->lokasi->location_name ?? '-' }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold text-uppercase">{{ $t->jenisKendaraan->jenis ?? '-' }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold text-secondary">{{ $t->masuk }}</span></td>
                  <td class="align-middle text-center"><span class="text-sm font-weight-bold text-secondary">{{ $t->keluar ?? '-' }}</span></td>
                  <td class="align-middle text-center">
                    <span class="text-sm font-weight-bold text-dark">
                      {{ $t->total_bayar ? 'Rp '.number_format($t->total_bayar, 0, ',', '.') : '-' }}
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    @if($t->keluar)
                      <span class="badge bg-gradient-success">COMPLETED</span>
                    @else
                      <span class="badge bg-gradient-warning">PARKED</span>
                    @endif
                  </td>
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
@endsection