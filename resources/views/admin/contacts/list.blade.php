@extends('layouts.dashboard')
@section('title', 'Contact List')
@push('css_or_js')
    <!-- Custom styles for this page -->
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('messages.Dashboard') }}</a> --}}
                {{-- </li> --}}
                <li class="breadcrumb-item" aria-current="page">{{ trans('messages.Customer Message') }}</li>
            </ol>
        </nav>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-black-50">{{ trans('messages.Customer Message') }} {{ trans('messages.List') }}</h1>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ trans('messages.Customer Message') }} {{ trans('messages.table') }}</h5>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ trans('messages.SL#') }}</th>
                                        <th>{{ trans('messages.Name') }}</th>
                                        <th>number</th>
                                        <th>Message</th>
                                        <th>{{ trans('messages.Email') }}</th>
                                        <th>{{ trans('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $k => $contact)
                                        <tr>
                                            <td>{{ $k + 1 }}</td>
                                            <td>{{ $contact['name'] }}</td>
                                            <td>{{ $contact['mobile_number'] }}</td>
                                            <td> {{ Str::limit($contact['message'], 10) }}</td>
                                            <td>{{ $contact['email'] }}</td>
                                            <td class="table-action">
                                                <a href="#" class="edit" data-id="{{ $contact->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2 align-middle">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="#" class="delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash align-middle delete"
                                                        id="{{ $contact->id }}">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });


        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            alert(id);
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
                    url: "{{ route('admin.contacts.delete') }}",
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
    </script>
@endpush
