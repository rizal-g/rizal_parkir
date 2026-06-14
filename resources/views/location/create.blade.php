@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card mb-4">
        <div class="card-header pb-0">
            <h6 class="text-primary font-weight-bolder">Location <span class="text-dark font-weight-normal">Input Form</span></h6>
        </div>
        <div class="card-body">
            <form action="{{ route('location.store') }}" method="POST" id="locationForm" novalidate>
            @csrf
            <div class="form-group mb-3">
                <label class="text-sm font-weight-bolder">Location Name</label>
                <input type="text" name="location_name" id="location_name" class="form-control" required placeholder="Gedung A">
            </div>
            <div class="form-group mb-3">
                <label class="text-sm font-weight-bolder">Max Motorcycle</label>
                <input type="number" name="max_motorcycle" id="max_motorcycle" class="form-control" required placeholder="3" min="0">
            </div>
            <div class="form-group mb-3">
                <label class="text-sm font-weight-bolder">Max Car</label>
                <input type="number" name="max_car" id="max_car" class="form-control" required placeholder="0" min="0">
            </div>
            <div class="form-group mb-4">
                <label class="text-sm font-weight-bolder">Max Truck/Bus/Other</label>
                <input type="number" name="max_other" id="max_other" class="form-control" required placeholder="0" min="0">
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('location.index') }}" id="cancelBtn" class="btn btn-dark w-50 me-2">CANCEL</a>
                <button type="submit" class="btn btn-primary w-50 ms-2">SAVE LOCATION</button>
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
    const form = document.getElementById('locationForm');
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
            
            let locationName = document.getElementById('location_name').value.trim();
            let maxMotorcycle = document.getElementById('max_motorcycle').value.trim();
            let maxCar = document.getElementById('max_car').value.trim();
            let maxOther = document.getElementById('max_other').value.trim();

            if (locationName === '') {
                document.getElementById('location_name').focus();
                swal("Invalid!", "Location Name Cannot Be Empty!", "error");
            } else if (maxMotorcycle === '') {
                document.getElementById('max_motorcycle').focus();
                swal("Invalid!", "Max Motorcycle Cannot Be Empty!", "error");
            } else if (maxCar === '') {
                document.getElementById('max_car').focus();
                swal("Invalid!", "Max Car Cannot Be Empty!", "error");
            } else if (maxOther === '') {
                document.getElementById('max_other').focus();
                swal("Invalid!", "Max Truck/Bus/Other Cannot Be Empty!", "error");
            } else {
                swal({
                    title: "Are you sure?",
                    text: "Do you want to save this location data?",
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