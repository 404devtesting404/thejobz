@extends('layouts.dashboard')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

    <script>
        window._token = '{{ csrf_token() }}'; // Required for upload
    </script>

    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required />
        </div>

        <div class="form-group mb-3">
            <label for="topic">Topics</label>
            <input type="text" name="topic" id="topic" class="form-control" required />
        </div>

        <div class="form-group mb-3">
            <label for="description">Content</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="meta_keywords">Meta Keywords</label>
            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" required />
        </div>

        <div class="form-group mb-3">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="meta_description" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

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
                                    xhr.open('POST', '{{ url('/admin/ckeditor-upload') }}', true);
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
                                                `Upload error: ${xhr.status} ${xhr.statusText}`
                                            );
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
@endsection
