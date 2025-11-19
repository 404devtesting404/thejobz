@extends('layouts.dashboard')
@section('content')
    @push('css_or_js')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .img-thumbnail {
                height: 20px;
                width: 50px;
            }
        </style>
    @endpush
    <h1 class="h3 mb-3">Responsive DataTables </h1>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <p class="mb-0">
                <strong>jQuery required!</strong> This plugin requires jQuery to be functional. If you
                want to remove jQuery from your application, please check out <a
                    href="docs-installation.html#drop-jquery">these docs</a>.
            </p>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title delete_all_jobs_without_img">
                        <a href="#" rel="noopener noreferrer nofollow flout-r" class="float-end">Add new</a>
                    </h5>
                </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @if ($adds)
                                @foreach ($adds as $key => $j)
                                    {{ $key++ }}
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $j->name }}</td>
                                        <td class="table-action">
                                            <a href="#" class="edit" data-id="{{ $j->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2 align-middle">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash align-middle delete"
                                                    id="{{ $j->id }}">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('job-single', $j->id) }}" target="_blank">
                                                <i class="align-middle me-2 fas fa-fw fa-link link_data">
                                                    <span class="align-middle">
                                                    </span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="m-4">
        <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" data-keyboard="false"
            data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="updateForm">
                        <div class="modal-body row g-3">
                            <div class="form-group" hidden>
                                <label for="exampleInputPassword1">id</label>
                                <input type="text" id="id" class="form-control">
                            </div>
                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" id="name" class="form-control">
                        </div>

                        <div class="modal-body row g-3">
                            <label for="code">Code</label>
                            <textarea id="code" name="code" class="form-control" aria-label="Code input area">At w3schools.com you will ...</textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });
        $(document).ready(function() {

            $(document).on('click', '.edit', function() {
                CKEDITOR.replace('code');
                var id = $(this).attr("data-id");
                $("#myModal").css("display", "block");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.adds.edit') }}",
                    method: 'Get',
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        // var img = "public/img/"+data.data.paper_name+'/'+data.data.img;
                        $('#id').val(data.data.id);
                        $('#name').val(data.data.name);
                        // $('#code').val(data.data.code);
                        if (CKEDITOR.instances['code']) {
                            CKEDITOR.instances['code'].setData(data.data.code);
                        }
                    }
                });

            });

            $('#updateForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data
                var codeData = CKEDITOR.instances['code'].getData(); // Get CKEditor content

                $.ajax({
                    url: "{{ route('admin.adds.update') }}", // Update route
                    method: 'POST',
                    data: {
                        ...formData,
                        code: codeData, // Add CKEditor content to form data
                        "_token": "{{ csrf_token() }}" // CSRF token
                    },
                    success: function(response) {
                        // Handle success response
                        $('#myModal').modal('hide');
                        // Optionally, update the page or show a success message
                        alert('Record updated successfully!');
                    },
                    error: function(xhr) {
                        // Handle error response
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            });

        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            swal({
                title: 'Are you sure delete this Jobs?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }, function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.job.delete') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('Jobs deleted successfully');
                        location.reload();
                    }
                });
            });
        });





        $(document).on('click', '.btn-close', function() {
            $("#myModal").modal().hide();
            // $("#myModal").modal('hide');
        });
        $(document).on('click', '.btn-secondary', function() {
            $("#myModal").modal().hide();
        });
        $(document).on('click', '.link_data', function() {
            var herf = $(this).attr("data-herf");
            var myString = herf.substr(herf.indexOf("?") + 1)
            console.log(myString);
            window.location.href = myString;
            // var myString = val.substr(val.indexOf("?") + 1)
            window.open(myString);
        });
    </script>
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static" aria-modal="true"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" style="display: block;" data-keyboard="false" data-backdrop="static" aria-modal="true" role="dialog"> --}}
@endsection
