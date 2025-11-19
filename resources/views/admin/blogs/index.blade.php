@extends('layouts.dashboard')
@section('content')
    <!-- In your layout -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            .ck-editor__editable[role="textbox"] {
                min-height: 350px !important;
            }

            .ck-editor__editable[role="textbox"] {
                min-height: 350px !important;
            }

        </style>
    @endpush

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a  href="{{route('admin.blog.create')}}" class="btn btn-primary float-end"   >
                        Add New Blog
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>Title</th>
                                <th>Topics</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog as $key => $b)
                                <!-- Change $B to $b -->
                                <tr>
                                    <td>{{ $key + 1 }}</td> <!-- Start numbering from 1 -->
                                    <td>{{ $b->title }}</td>
                                    <td>{{ $b->topic }}</td>
                                    <td>{{ \Carbon\Carbon::parse($b->created_at)->format('Y-m-d') }}</td>
                                    <td>
                                        <form action="{{ route('admin.blog.toggle-status', $b->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 border-0"
                                                title="{{ $b->status ? 'Deactivate' : 'Activate' }}">
                                                @if ($b->status)
                                                    <i class="fas fa-toggle-on text-success" style="font-size: 1.2rem;"></i>
                                                @else
                                                    <i class="fas fa-toggle-off text-secondary"
                                                        style="font-size: 1.2rem;"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td class="table-action">
                                        <a href="{{ route('admin.blog.edit', $b->id) }}" class="edit" data-id="{{ $b->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2 align-middle">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.blog.destroy', $b->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 border-0"
                                                onclick="return confirm('Are you sure you want to delete this blog?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash align-middle text-danger">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $blog->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="m-4">
        <!-- Add this in your Blade view -->
        <!-- Modal -->
        <div class="modal fade" id="addBlogModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="addBlogModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addBlogForm" method="POST" action="{{ route('admin.blog.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBlogModalLabel">Add New Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="topic">Topics</label>
                                <input type="text" class="form-control" id="topic" name="topic" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Content</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
   <script>
        // Image upload adapter
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file
                            .then(function(file) {
                                return new Promise(function(resolve, reject) {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', '{{ url("/admin/ckeditor-upload") }}', true);
                                    xhr.setRequestHeader('x-csrf-token', window._token);
                                    xhr.setRequestHeader('Accept', 'application/json');
                                    xhr.responseType = 'json';

                                    xhr.addEventListener('error', function() {
                                        reject(`Upload failed: ${file.name}`);
                                    });
                                    xhr.addEventListener('abort', function() {
                                        reject('Upload aborted.');
                                    });
                                    xhr.addEventListener('load', function() {
                                        var response = xhr.response;

                                        if (!response || xhr.status !== 201) {
                                            return reject(response && response.message ?
                                                `${response.message}` :
                                                `Upload error: ${xhr.status} ${xhr.statusText}`);
                                        }

                                        resolve({
                                            default: response.url
                                        });
                                    });

                                    if (xhr.upload) {
                                        xhr.upload.addEventListener('progress', function(e) {
                                            if (e.lengthComputable) {
                                                loader.uploadTotal = e.total;
                                                loader.uploaded = e.loaded;
                                            }
                                        });
                                    }

                                    var data = new FormData();
                                    data.append('upload', file);
                                    xhr.send(data);
                                });
                            });
                    }
                };
            }
        }

        ClassicEditor
            .create(document.querySelector('#description'), {
                extraPlugins: [SimpleUploadAdapter],
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'insertTable', 'blockQuote', 'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $("#datatables-reponsive").DataTable({
                responsive: true
            });

            // Edit Blog - Open Modal
            $(document).on('click', '.edit', function() {
                var id = $(this).data('id');

                $.ajax({

                    url: "{{ route('admin.blog.edit', '') }}/" + id,
                    type: 'GET',
                    success: function(response) {
                        $('#edit_id').val(response.id);
                        $('#edit_title').val(response.title);
                        $('#edit_content').val(response.content);

                        if (response.image) {
                            $('#current_image').attr('src', '/storage/' + response.image);
                            $('#current_image').show();
                        } else {
                            $('#current_image').hide();
                        }

                        $('#editBlogModal').modal('show');
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to fetch blog details',
                            icon: 'error'
                        });
                    }
                });
            });

            // Update Blog Form Submission
            $('#editBlogForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var id = $('#edit_id').val();

                $.ajax({
                    url: "{{ route('admin.blog.update', '') }}/" + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#editBlogModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Blog updated successfully',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred',
                            icon: 'error'
                        });
                    }
                });
            });


        });
    </script>
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" role="dialog" style="display: block;" data-keyboard="false" data-backdrop="static" aria-modal="true"> --}}
    {{-- <div id="myModal" class="modal fade show" tabindex="-1" style="display: block;" data-keyboard="false" data-backdrop="static" aria-modal="true" role="dialog"> --}}
@endsection
