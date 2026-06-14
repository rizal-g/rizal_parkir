@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="text-primary font-weight-bolder">Vehicle Type <span class="text-dark font-weight-normal">Input Form</span></h6>
        </div>
        <div class="card-body">
          <form action="{{ route('vehicletype.store') }}" method="POST" id="vehicleTypeForm" novalidate>
            @csrf
            <div class="form-group mb-3">
              <label class="text-sm font-weight-bolder">Vehicle Type</label>
              <select name="jenis" id="jenis" class="form-control" required>
                  <option value="motorcycle" {{ old('jenis') == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                  <option value="car" {{ old('jenis') == 'car' ? 'selected' : '' }}>Car</option>
                  <option value="other" {{ old('jenis') == 'other' ? 'selected' : '' }}>Truck/Bus/Other</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label class="text-sm font-weight-bolder">First Hour Price</label>
              <input type="number" name="perjam_pertama" id="perjam_pertama" class="form-control" value="{{ old('perjam_pertama') }}" required placeholder="Contoh: 2000" min="0">
            </div>
            <div class="form-group mb-3">
              <label class="text-sm font-weight-bolder">Next Hour Price</label>
              <input type="number" name="perjam_berikutnya" id="perjam_berikutnya" class="form-control" value="{{ old('perjam_berikutnya') }}" required placeholder="Contoh: 1000" min="0">
            </div>
            <div class="form-group mb-4">
              <label class="text-sm font-weight-bolder">Max Per Day Price</label>
              <input type="number" name="max_perhari" id="max_perhari" class="form-control" value="{{ old('max_perhari') }}" required placeholder="Contoh: 10000" min="0">
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('vehicletype.index') }}" id="cancelBtn" class="btn btn-dark w-50 me-2">CANCEL</a>
              <button type="submit" class="btn bg-gradient-primary w-50 ms-2">SAVE VEHICLE TYPE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
    .swal-button--confirm, .swal-button--confirm:hover {
        background-color: #e91e63 !important; 
        color: white !important;
    }
    .swal-button--cancel, .swal-button--cancel:hover {
        background-color: #344767 !important; 
        color: white !important;
    }
</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('vehicleTypeForm');
    const cancelBtn = document.getElementById('cancelBtn');
    
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetLink = this.getAttribute('href');

            swal({
                title: "Are you sure?",
                text: "Your data will not be submitted or saved!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "No, Stay Here",
                        value: false,
                        visible: true,
                        className: "btn btn-primary"
                    },
                    confirm: {
                        text: "Yes, Cancel It!",
                        value: true,
                        visible: true,
                        className: "btn btn-dark"
                    }
                },
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    window.location.href = targetLink;
                }
            });
        });
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            let jenis = document.getElementById('jenis').value.trim();
            let perjamPertama = document.getElementById('perjam_pertama').value.trim();
            let perjamBerikutnya = document.getElementById('perjam_berikutnya').value.trim();
            let maxPerhari = document.getElementById('max_perhari').value.trim();

            if (jenis === '') {
                document.getElementById('jenis').focus();
                swal("Invalid!", "Vehicle Type Cannot Be Empty!", "error");
            } else if (perjamPertama === '') {
                document.getElementById('perjam_pertama').focus();
                swal("Invalid!", "First Hour Price Cannot Be Empty!", "error");
            } else if (perjamBerikutnya === '') {
                document.getElementById('perjam_berikutnya').focus();
                swal("Invalid!", "Next Hour Price Cannot Be Empty!", "error");
            } else if (maxPerhari === '') {
                document.getElementById('max_perhari').focus();
                swal("Invalid!", "Max Per Day Price Cannot Be Empty!", "error");
            } else {
                swal({
                    title: "Are you sure?",
                    text: "Do you want to save this vehicle type data?",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "No, Cancel",
                            value: false,
                            visible: true,
                            className: "btn btn-dark"
                        },
                        confirm: {
                            text: "Yes, Save It!",
                            value: true,
                            visible: true,
                            className: "btn btn-primary"
                        }
                    },
                }).then((willSubmit) => {
                    if (willSubmit) {
                        form.submit(); 
                    }
                });
            }
        });
    }
});
</script>

@if (session('duplikat'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        swal("Duplicated Data!", "{{ session('duplikat') }}", "error");
    });
</script>
@endif
@endsection