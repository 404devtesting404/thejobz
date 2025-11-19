@extends('layouts.dashboard')
@section('content')
    @push('css_or_js')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .img-thumbnail {
                height: 20px;
                width: 50px;
            }

            path {
                display: none !important;
            }

            svg path {
                display: none !important;
                width: 1px !important;
            }

            svg.w-5.h-5 {
                display: none !important;
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
                    <h5 class="card-title delete_all_jobs_without_img">Total jobs with out img
                        {{ $total_jobs_with_out_img }}
                        <a href="#" rel="noopener noreferrer nofollow">Delete All</a> 
                    </h5> 
                    <h6 class="card-subtitle text-muted three_month_old_jobs">Total Three month old jobs
                        {{ $three_month_old_jobs }}
                        <a href="#" rel="noopener noreferrer nofollow">Delete All</a>.
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>Paper Name</th>
                                <th>Title</th>
                                <th>City</th>
                                <th>Posted Date</th>
                                <th>Department</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($jobs)
                                @foreach ($jobs as $key => $j)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $j->paper_name }}</td>
                                        <td>{{ Str::limit($j->title, 10) }}</td>
                                        <td>{{ $j->city }}</td>
                                        <td>{{ $j->posted }}</td>
                                        <td>{{ Str::limit($j->department, 10) }}</td>
                                        <td>
                                            <img data-enlargable
                                                src="{{ asset('storage/app/public/jobs/') . '/' . $j->img }}"
                                                width="50" height="58">
                                        </td>
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
                    {{ $jobs->links() }}
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
                    <div class="modal-body row g-3">
                        <div class="form-group" hidden>
                            <label for="exampleInputPassword1">id</label>
                            <input type="text" id="id" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Title</label>
                            <input type="text" id="title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Department</label>
                            <input type="text" id="department" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputPassword1">Paper Name</label>
                            <input type="text" id="paper_name" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputPassword1">City</label>
                            <input type="text" id="city" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputPassword1">Posted</label>
                            <input type="text" id="posted" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputPassword1">View</label>
                            <input type="text" id="view" class="form-control">
                        </div>
                        <img id="img-thumbnail" src="" alt="..." class="img-thumbnail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('img[data-enlargable]').addClass('img-enlargable').click(function() {
            var src = $(this).attr('src');
            $('<div>').css({
                background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
                backgroundSize: 'contain',
                width: '100%',
                height: '100%',
                position: 'fixed',
                zIndex: '10000',
                top: '0',
                left: '0',
                cursor: 'zoom-out'
            }).click(function() {
                $(this).remove();
            }).appendTo('body');
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });


        $(document).on('click', '.edit', function() {
            var id = $(this).attr("data-id");
            $("#myModal").css("display", "block");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.job.edit') }}",
                method: 'POST',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data)
                    // var img = "public/img/"+data.data.paper_name+'/'+data.data.img;
                    $('#id').val(data.data.id);
                    $('#title').val(data.data.title);
                    $('#paper_name').val(data.data.paper_name);
                    $('#department').val(data.data.department);
                    $('#city').val(data.data.city);
                    $('#posted').val(data.data.posted);
                    $('#view').val(data.data.view);
                    $('#img-thumbnail').attr("src", data.data.img);
                }
            });

        });

 

        $(document).on('click', '.delete_all_jobs_without_img', function() {
            swal({
                title: 'Are you sure delete this Jobs?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }, function() {
                $('.delete_all_jobs_without_img').html('Loading...'); // Show the loader

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.job.delete_all_jobs_without_img') }}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('All Jobs Without Imges deleted successfully');
                        setTimeout(function() {
                            // location.reload();
                        }, 1000);
                    },
                    complete: function() {
                        // location.reload();
                    }
                });
            });
        });


        $(document).on('click', '.three_month_old_jobs', function() {
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
                    url: "{{ route('admin.job.delete_three_month_old_jobs') }}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('All Jobs Without Imges deleted successfully');
                        setTimeout(function() {
                            // location.reload();
                        }, 1000);
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

 
        $(document).ready(function () {
            $('.delete').on('click', function (e) {
                e.preventDefault();

                let id = $(this).attr('id'); // Button ka ID fetch karein
                if (confirm("Kya aap is item ko delete karna chahte hain?")) {
                    $.ajax({
                        url: `/delete-item/${id}`, // Laravel route
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function (response) {
                            if (response.success) {
                                alert("Item delete ho gaya!");
                                $(`#${id}`).closest('tr').remove(); // Table row ko DOM se hatayein
                            } else {
                                alert("Item delete nahi ho saka.");
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                            alert("Kuch error hai, try again.");
                        }
                    });
                }
            });
        });
 

    </script>
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static" aria-modal="true"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" style="display: block;" data-keyboard="false" data-backdrop="static" aria-modal="true" role="dialog"> --}}
@endsection
