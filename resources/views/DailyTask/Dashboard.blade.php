@extends('index')
@section('content')
    <div class="container">
        <h1 class="text-center mt-2 mb-2">Task Detail</h1>
        <canvas id="dashboardBarChart" width="400" height="200"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('dashboardBarChart').getContext('2d');
        var dashboardBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    label: 'Dashboard Data',
                    data: [
                        {{ $completed }},
                        {{ $pending }},
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 0, 0, 2)',
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 0, 0, 2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Don't begin at zero
                        max: 50           // Start from 1000
                    }
                }
            }
        });
    </script>

@endsection
