@extends('layouts.back-end.app')
@section('title','Problems View')
@push('css_or_js')
<link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* loader css  */
    .loader__wrapp {
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff38;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        /* transform: translate(-50%, -50%); */
        z-index: 999;
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
    }

    /* loader css  */
</style>
@endpush

@section('content')
<div class="loader__wrapp">
    <div class="loder"></div>
</div>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('messages.Dashboard')}}</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Problems</li>
        </ol>
    </nav>
    <!-- Page Heading -->
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-black-50"> {{trans('messages.View User Message')}}</h1>
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body mt-3 ml-4">
                        <div class="row ">
                            <div class="col-md-3 col-lg-3 hidden-xs hidden-sm" hidden>
                                <img onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" style="height: 8rem; width: 9rem;" class="img-circle" src="{{asset('public/assets/front-end')}}/img/contacts/blank.jpg" alt="User Pic">

                            </div>

                            <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                                <strong style="margin-right: 20px">{{$problem->subject}}</strong>
                                <br>
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{$problem->f_name .' '. $problem->l_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('messages.Email')}}:</td>
                                            <td>{{$problem->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number:</td>
                                            <td>{{$problem->mobile_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('messages.messages')}}</td>
                                            <td>
                                                <p style="font-width:16px;"> {{$problem->message}}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>File:</td> 
                                            <td>
                                            <img class="img-fluid" src="{!! isset($problem->file)
                                                                ? asset('public/storage/problem') . '/' . $problem->file
                                                                : asset('public/assets/back-end/img/900x400/img1.jpg') !!}"
                                                                alt="image" />
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection

@push('script')
<script src="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script>
    $(document).on('click', '.btn', function() {
        $(".loader__wrapp").css("display", "flex");
        $(".loader__wrapp .loder").addClass("spinner-border");
    });
</script>
@endpush