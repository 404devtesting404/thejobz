@extends('layouts.dashboard')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        p.mb-2.illustration-text {
            font-weight: 500;
        }

        p.mb-2.illustration-text {
            text-decoration: underline 1px black;
        }
    </style>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Dashboard</h3>
        </div>
        <div class="col-auto ms-auto text-end mt-n1">
            <div class="dropdown me-2 d-inline-block">
                <a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown"
                    data-bs-display="static">
                    <i class="align-middle mt-n1" data-feather="calendar"></i> Today
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <button class="btn btn-primary shadow-sm">
                <i class="align-middle" data-feather="filter">&nbsp;</i>
            </button>
            <button class="btn btn-primary shadow-sm">
                <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card illustration flex-fill">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="illustration-text p-3 m-1">
                                <h4 class="illustration-text">Welcome Back, Chris!</h4>
                                <p class="mb-0">AppStack Dashboard</p>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="{{ asset('resources/dashboard_assets/img/illustrations/customer-support.png') }}"
                                alt="Customer Support" class="img-fluid illustration-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8   d-flex">
            <div class="card illustration  flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="p-3">
                            <h3 class="mb-2 ">{{ $total_jobs }}</h3>
                            <p class="mb-2 illustration-text">Total Jobs</p>
                        </div>
                        <div class="p-3">
                            <h3 class="mb-2">{{ $army_jobs_count }}</h3>
                            <p class="mb-2 illustration-text">Total Army Jobs </p>
                        </div>
                        <div class="p-3">
                            <h3 class="mb-2">{{ $navy_jobs_count }}</h3>
                            <p class="mb-2 illustration-text">Total Navy Jobs</p>
                        </div>
                        <div class="p-3">
                            <h3 class="mb-2">{{ $police_jobs_count }}</h3>
                            <p class="mb-2 illustration-text">Total Police Jobs</p>
                        </div>
                        <div class="p-3">
                            <h3 class="mb-2">{{ $bank_jobs_count }}</h3>
                            <p class="mb-2 illustration-text">Total Bank Jobs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            @if($content_update_by->isEmpty())
        <div class="alert alert-info">
            No updates found.
        </div>
    @else
        <div class="card shadow rounded">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Update Date</th>
                                <th>Updated By</th>
                                <th>Total Updates</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($content_update_by as $index => $row) 
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->update_date)->format('d M, Y') }}</td>
                                    <td>{{ $row->fullname }}</td>
                                    <td><strong>{{ $row->total_updates }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <span class="badge bg-info float-end">Today</span>
                    <h5 class="card-title mb-0">Daily feed</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('resources/dashboard_assets/img/avatars/avatar-5.jpg') }}" width="36"
                            height="36" class="rounded-circle me-2" alt="Ashley Briggs">
                        <div class="flex-grow-1">
                            <small class="float-end">5m ago</small>
                            <strong>Ashley Briggs</strong> started following <strong>Stacie
                                Hall</strong><br />
                            <small class="text-muted">Today 7:51 pm</small><br />
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('resources/dashboard_assets/img/avatars/avatar.jpg') }}" width="36"
                            height="36" class="rounded-circle me-2" alt="Chris Wood">
                        <div class="flex-grow-1">
                            <small class="float-end">30m ago</small>
                            <strong>Chris Wood</strong> posted something on <strong>Stacie
                                Hall</strong>'s timeline<br />
                            <small class="text-muted">Today 7:21 pm</small>
                            <div class="border text-sm text-muted p-2 mt-1">
                                Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem
                                quam semper libero, sit amet adipiscing...
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('resources/dashboard_assets/img/avatars/avatar-4.jpg') }}" width="36"
                            height="36" class="rounded-circle me-2" alt="Stacie Hall">
                        <div class="flex-grow-1">
                            <small class="float-end">1h ago</small>
                            <strong>Stacie Hall</strong> posted a new blog<br />
                            <small class="text-muted">Today 6:35 pm</small>
                        </div>
                    </div>
                    <hr />
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Load more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card flex-fill">
        <div class="card-header">
            <div class="card-actions float-end">
                <div class="dropdown position-relative">
                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                        <i class="align-middle" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-0">Popular Job Department</h5>
        </div>
        <table id="data-table" class="table table-bordered user_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Total Jobs</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="card flex-fill">
        <div class="card-header">
            <div class="card-actions float-end">
                <div class="dropdown position-relative">
                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                        <i class="align-middle" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-0">Popular Job City</h5>
        </div>
        <table id="data-table_city" class="table table-bordered user_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>City Name</th>
                    <th>Total Jobs</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="card flex-fill">
        <div class="card-header">
            <div class="card-actions float-end">
                <div class="dropdown position-relative">
                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                        <i class="align-middle" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-0">Popular Jobs</h5>
        </div>
        <table id="data-table_popular_job" class="table table-bordered user_datatable">
            <thead>
                <tr>
                    <th>View</th>
                    <th>Paper Name</th>
                    <th>Posted</th>
                    <th>Department</th>
                    <th>Title</th> 
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <div class="dropdown position-relative">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title mb-0">Calendar</h5>
                </div>

            </div>
        </div>
        <div class="col-12 col-xl-4 d-none d-xl-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <div class="dropdown position-relative">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title mb-0">Weekly sales</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Source</th>
                                    <th class="text-end">Revenue</th>
                                    <th class="text-end">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-square-full text-primary"></i> Direct</td>
                                    <td class="text-end">$ 2602</td>
                                    <td class="text-end text-success">+43%</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-square-full text-warning"></i> Affiliate</td>
                                    <td class="text-end">$ 1253</td>
                                    <td class="text-end text-success">+13%</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-square-full text-danger"></i> E-mail</td>
                                    <td class="text-end">$ 541</td>
                                    <td class="text-end text-success">+24%</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-square-full text-dark"></i> Other</td>
                                    <td class="text-end">$ 1465</td>
                                    <td class="text-end text-success">+11%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <div class="dropdown position-relative">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title mb-0">Appointments</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <strong>Chat with Carl and Ashley</strong>
                            <span class="float-end text-muted text-sm">30m ago</span>
                            <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet
                                nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris...</p>
                        </li>
                        <li class="timeline-item">
                            <strong>The big launch</strong>
                            <span class="float-end text-muted text-sm">2h ago</span>
                            <p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer
                                eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper
                                ipsum rutrum
                                nunc...</p>
                        </li>
                        <li class="timeline-item">
                            <strong>Coffee break</strong>
                            <span class="float-end text-muted text-sm">3h ago</span>
                            <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet,
                                leo. Maecenas malesuada...</p>
                        </li>
                        <li class="timeline-item">
                            <strong>Chat with team</strong>
                            <span class="float-end text-muted text-sm">30m ago</span>
                            <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet
                                nec, imperdiet iaculis, ipsum...</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(function() {
            var table = $('#data-table').DataTable({
                processing: false,
                serverSide: false,
                searching: true,
                ordering: true,
                bLengthChange: false,

                ajax: "{{ route('admin.home') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'department_count',
                        name: 'department_count',
                        orderable: true,
                        searchable: true
                    },

                ]
            });

        });
        $(function() {
            var table = $('#data-table_city').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                ordering: false,
                bLengthChange: false,

                ajax: "{{ route('admin.popular_job_city') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'city_count',
                        name: 'city_count',
                        orderable: true,
                        searchable: true
                    },

                ]
            });
        });
        $(function() {

            $('#data-table_popular_job').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.popular_job') }}",
                order: [
                    [0, "desc"]
                ], // First column (view) descending order me ho
                columns: [{
                        data: 'view',
                        name: 'view'
                    },
                    {
                        data: 'paper_name',
                        name: 'paper_name'
                    },
                    {
                        data: 'posted',
                        name: 'posted'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'action', // new column for button
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
 
        });
    </script>
@endsection
