@extends('layouts.dashboard')


@section('title', 'Web Config')

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="row" style="padding-bottom: 20px;">
            <div class="col-md-12 mb-3 mt-3">
                <div class="card">
                    <div class="card-body" style="padding-bottom: 12px">
                        <div class="row">
                            <div class="col-6">
                                <h5>
                                    <i class="tio-settings-outlined"></i>
                                    Add show checked is on / unchecked is off
                                </h5>
                            </div>
                            <div class="col-6">
                                <label class="switch ml-3 float-right">
                                    <input type="checkbox" class="status adsterra_ads"
                                        {{ isset($data['config']) && $data['config']->value == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- adsterra_social_adds --}}
                <div class="card">
                    <div class="card-body" style="padding-bottom: 12px">
                        <div class="row">
                            <div class="col-6">
                                <h5>
                                    <i class="tio-settings-outlined"></i>
                                    Adsterra Social Add show checked is on / unchecked is off
                                </h5>
                            </div>
                            <div class="col-6">
                                <label class="switch ml-3 float-right">
                                    <input type="checkbox" class="status adsterra_social_adds"
                                        {{ isset($data['adsterra_social_adds']) && $data['adsterra_social_adds']->value == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="padding-bottom: 12px">
                        <div class="row">
                            <div class="col-6">
                                <h5>
                                    <i class="tio-settings-outlined"></i>
                                    Alert Add show checked is on / unchecked is off
                                </h5>
                            </div>
                            <div class="col-6">
                                <label class="switch ml-3 float-right">
                                    <input type="checkbox" class="status alert_add_update"
                                        {{ isset($data['alert']) && $data['alert']->value == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-body" style="padding-bottom: 12px">
                        <div class="row">
                            <div class="col-6">
                                <h5>
                                    <i class="tio-settings-outlined"></i>
                                    Whatupp popup show checked is on / unchecked is off
                                </h5>
                            </div>
                            <div class="col-6">
                                <label class="switch ml-3 float-right">
                                    <input type="checkbox" class="status whatsappJoinModal"
                                        {{ isset($data['whatsappJoinModal']) && $data['whatsappJoinModal']->value == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.adsterra_ads', function() {
            swal({
                title: 'Are you sure ?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }, function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('admin.business-settings.maintenance-add') }}',
                    method: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('All Jobs Without Imges deleted successfully');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        });

        $(document).on('click', '.adsterra_social_adds', function() {
            swal({
                title: 'Are you sure ?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }, function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('admin.business-settings.adsterra_social_adds') }}',
                    method: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('success test');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                });
            });
        });

        $(document).on('click', '.alert_add_update', function() {
            swal({
                title: 'Are you sure ?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }, function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('admin.business-settings.alert_add_update') }}',
                    method: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('All Jobs Without Imges deleted successfully');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        });

         $(document).on('click', '.whatsappJoinModal', function() {
            swal({
                title: 'Are you sure ?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }, function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('admin.business-settings.whatsappJoinModal') }}',
                    method: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        toastr.success('Whatsapp Join Modal successfully Add');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            });
        });


    </script>
@endsection
