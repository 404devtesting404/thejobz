@extends('layouts.app1')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      @php
        $title = 'Gold Rate in Pakistan Today - 1 Tola, 10 Gram & 1 Gram 24K Live Updates 2025';
        $description =
            'Check today latest gold price in Pakistan. Live updates of 1 Tola, 10 Gram & 1 Gram 24K gold. City-wise rates (Karachi, Lahore, Islamabad) with last 10 days history.';
        $keywords =
            'gold rate Pakistan today, 1 tola gold price Pakistan, gold price Karachi, Lahore gold rate, 10 gram gold price, gold price history Pakistan';
        $fullUrl = url()->full();
    @endphp
    @section('title') Find the Best Jobs in Pakistan — Apply Online Today @endsection
@section('meta') 
    <meta name="description" content="{{ $description }}"> 
    <link rel="canonical" href="{{ $fullUrl }}" />
@endsection
@section('content')
<style>
    .form-control {
        width: 70%;
        display: inline-block;
    }
    div#calc-result {
        padding-left: 10px;
        text-align: center !important;
    }
</style>

<div class="container my-4">
    <!-- Top summary cards -->
    <div class="card p-3 mb-4">
        <h4>Gold Rate in Pakistan - Live</h4>
        <div class="row text-center mt-3">
            <div class="col"><small>1 Tola 24K</small>
                <div id="card-tola" class="h4 fw-bold">--</div>
            </div>
            <div class="col"><small>10 Gram 24K</small>
                <div id="card-gram10" class="h4 fw-bold">--</div>
            </div>
            <div class="col"><small>1 Gram 24K</small>
                <div id="card-gram1" class="h4 fw-bold">--</div>
            </div>
            <div class="col"><small>Updated</small>
                <div id="card-updated" class="h6 text-muted">--</div>
            </div>
        </div>

        <!-- Gold calculator -->
        <div class="mt-4 bg-dark text-white p-3 rounded">
            <div class="d-flex gap-2 align-items-center">
                <select id="calc-type" class="form-control form-select w-auto">
                    <option value="tola">Tola</option>
                    <option value="gram10">10 Gram</option>
                    <option value="gram1">1 Gram</option>
                </select>
                <input id="calc-value" type="number" min="1" max="1000" class="form-control"
                    placeholder="Enter quantity (e.g. 1)">
                <button id="calc-btn" class="btn btn-success">Calculate</button>
                <div id="calc-result" class="ms-3 text-white"></div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card mb-4 p-3">
        <h5 id="chart">24K Gold Price - Last 10 Days</h5>
        <canvas id="goldChart" height="120"></canvas>
    </div>

    <!-- City rates table -->
    <div class="card mb-4 p-3">
        <h5 id="city-table">Gold Price Today in Major Cities of Pakistan</h5>
        <table id="cityRatesTable" class="display w-100">
            <thead>
                <tr>
                    <th>City</th>
                    <th>Bidding</th>
                    <th>Asking</th>
                    <th>Updated At</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Last 10 days table -->
    <div class="card mb-4 p-3">
        <h5>Gold Rate in Pakistan - Last 10 Days</h5>
        <table id="last10Table" class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>1 Tola 24K</th>
                    <th>10 Gram 24K</th>
                    <th>1 Gram 24K</th>
                </tr>
            </thead>
            <tbody id="last10Body"></tbody>
        </table>
    </div>

    <!-- SEO Content + FAQs -->
    <div class="card mb-4 p-3">
        <h4>Gold Price in Pakistan</h4>
        <p>Latest updates and historical prices for gold in Pakistan.</p>
        <h5>FAQs</h5>
        <p><strong>What is 1 tola gold price today?</strong> See table above for updated price.</p>
    </div>

    <!-- Comments -->
    <div class="card mb-5 p-3" id="comments">
        <h5>Comments on Gold Rates in Pakistan</h5>
        <div id="commentsList"></div>
        <form id="commentForm" class="mt-3">
            <div class="mb-2"><input name="name" id="com-name" class="form-control"
                    placeholder="Your name (optional)"></div>
            <div class="mb-2">
                <textarea name="comment" id="com-text" class="form-control" placeholder="Write a comment..." required></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Number limit (1 - 1000)
    document.getElementById("calc-value").addEventListener("input", function() {
        let value = parseInt(this.value, 10);
        if (value < 1) this.value = 1;
        if (value > 1000) this.value = 1000;
    });

    function formatDateTime(dateString) {
        let d = new Date(dateString); // ab ye sahi chalega
        let day = String(d.getDate()).padStart(2, '0');
        let month = String(d.getMonth() + 1).padStart(2, '0');
        let year = d.getFullYear();
        let hours = d.getHours();
        let minutes = String(d.getMinutes()).padStart(2, '0');
        let seconds = String(d.getSeconds()).padStart(2, '0');
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        // return `${day}-${month}-${year}, ${hours}:${minutes}:${seconds} ${ampm}`;
        return `${day}-${month}-${year}`;
    }


    $(function() {
        // Load overall card
        fetch("{{ route('api.gold.overall') }}")
            .then(r => r.json())
            .then(data => {
                $('#card-tola').text(data.tola1_24k ?? '--');
                $('#card-gram10').text(data.gram10_24k ?? '--');
                $('#card-gram1').text(data.gram1_24k ?? '--');
                $('#card-updated').text(formatDateTime(data.updated_at));
            });

        // City rates table
        $('#cityRatesTable').DataTable({
            ajax: {
                url: "{{ route('api.gold.cities') }}",
                dataSrc: 'data'
            },
            columns: [{
                    data: 'city'
                },
                {
                    data: 'bidding'
                },
                {
                    data: 'asking'
                },
                {
                    data: 'updated_at',
                    render: d => formatDateTime(d)
                }
            ],
            pageLength: 10,
            ordering: false,
            searching: false
        });

        // Last 10 days chart + table
        fetch("{{ route('api.gold.last10') }}")
            .then(r => r.json())
            .then(resp => {
                // Chart
                const ctx = document.getElementById('goldChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: resp.labels,
                        datasets: [{
                            label: '1 Tola 24K',
                            data: resp.data,
                            borderColor: 'gold',
                            backgroundColor: 'rgba(255,215,0,0.3)',
                            tension: 0.3,
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // Table
                let rows = '';
                resp.raw.forEach(r => {
                    rows += `<tr>
                        <td>${r.date}</td>
                        <td>${r.tola1_24k}</td>
                        <td>${r.gram10_24k}</td>
                        <td>${r.gram1_24k}</td>
                    </tr>`;
                });
                $('#last10Body').html(rows);
            });

        // Comments load
        function loadComments() {
            fetch("{{ route('api.comments') }}")
                .then(r => r.json())
                .then(data => {
                    let html = '';
                    data.forEach(c => {
                        html += `<div class="mb-2"><strong>${c.name}</strong>
                                 <small class="text-muted">${formatDateTime(c.created_at)}</small>
                                 <p>${c.comment}</p></div>`;
                    });
                    $('#commentsList').html(html);
                });
        }
        loadComments();

        // Comment submit
        $('#commentForm').on('submit', function(e) {
            e.preventDefault();
            let name = $('#com-name').val();
            let comment = $('#com-text').val();
            if (!comment) return alert('Comment required');
            fetch("{{ route('api.comments.post') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name,
                    comment
                })
            }).then(r => r.json()).then(resp => {
                if (resp.success) {
                    $('#com-text').val('');
                    $('#com-name').val('');
                    loadComments();
                }
            });
        });

        // Calculator
        $('#calc-btn').on('click', function() {
            let type = $('#calc-type').val();
            let qty = parseFloat($('#calc-value').val()) || 0;
            fetch("{{ route('api.gold.overall') }}").then(r => r.json()).then(d => {
                let price = type === 'tola' ? d.tola1_24k : type === 'gram10' ? d.gram10_24k : d
                    .gram1_24k;
                let total = (parseFloat(price) || 0) * qty;
                $('#calc-result').html(`<strong>Rs ${total.toLocaleString()}</strong>`);
            });
        });
    });
</script>
@endsection
