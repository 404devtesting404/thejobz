@extends('layouts.app')
@section('content')
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            margin: 0px;
            white-space: nowrap;
            text-align: right;
            top: !important;
            padding: 30px;
        }

        .p-category.style2 {
            height: 68%;
        }

        .block {
            padding: 60px 0 !important;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            margin: 0px;
            white-space: nowrap;
            text-align: right;
            top: !important;
            padding: 30px;
        }

        .p-category.style2.city {
            height: 68%;
        }

        .form-location-sec h1 {
            float: left;
            width: 100%;
            color: #ffffff;
            font-size: 60px;
            margin: 0;
            margin-top: -15px;
        }

        .job-lctn i {
            float: none;
            font-size: 15px !important;
        }

        .job-listings-sec.style2 .job-listing .job-lctn {
            display: contents;
            padding-top: 20px;
            width: 100%;
            font-size: 13px !important;
        }

        .job-listing.wtabs .job-lctn i {
            float: none;
            font-size: 13px;
        }
    </style>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
    <section>
        <div class="block remove-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 column">
                        <div class="heading left">
                            <h2>Search Result</h2>
                        </div><!-- Heading -->
                        <div class="job-listings-sec style2">
                            <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (!empty($search_result))
                                            {{-- {{ dd($search_result);}} --}}
                                            <table id="data-table" class="dataTable no-footer" role="grid"
                                                aria-describedby="data-table_info" style="width: 848px;">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 812px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($search_result as $r)
                                                        <tr role="row" class="even">
                                                            <td>
                                                                <div class="job-listing">
                                                                    <div class="job-title-sec">
                                                                        <div class="c-logo">
                                                                            <img class="img_test"
                                                                                src="{{ asset('storage/app/public/jobs') . '/' . $r->img }}"
                                                                                alt="{{ $r->title }}"
                                                                                style="width: 60px; height: 60px;">
                                                                        </div>
                                                                        <h3>
                                                                            <a href="{{ route('job-department', $r->department_slug) }}"
                                                                            title="{{ $r->department }}">{{ Str::limit($r->department, 30, '...') }}</a>
                                                                        </h3>
                                                                        <span>{{ Str::limit($r->title, 30, '...') }}</span>
                                                                        <div class="job-lctn"><i
                                                                                class="la la-map-marker">Job
                                                                                city:{{ $r->city }}
                                                                                <i class="la">
                                                                                    Job posted:{{ $r->posted }}</i></i>
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{ route('job-single', ['slug' => $r->slug]) }}"
                                                                        target="_blank" title="{{ $r->title }}"
                                                                        class="aply-btn">See More</a>
                                                                    <span class="job-is ft"> {{ $r->paper_name }}</span>
                                                                    <span class="fav-job">
                                                                        <i class="la la-heart-o"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="pagination-wrapper">
                                                {{ $search_result->links('pagination::bootstrap-4') }}
                                            </div>
                                        @else
                                            <p>Not found any jobs</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 column">
                        <div class="heading left">
                            <h2>Recent Jobs</h2>
                        </div><!-- Heading -->
                        <div class="job-grid-sec">
                            @include('partials.front_right_side_bar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
