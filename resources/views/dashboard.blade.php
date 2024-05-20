@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Tasks</h5>
                    <p class="card-text display-4">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <p class="card-text display-4">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text display-4">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Recent Tasks</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($recentTasks as $task)
                            <li class="list-group-item">
                                <h6>{{ $task->title }}</h6>
                                <p>{{ $task->description }}</p>
                                <p class="text-muted">
                                    Status: {{ ucfirst($task->status) }}
                                    @if ($task->complited)
                                        | Completed
                                    @endif
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Task Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="taskStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Ambil data status tugas dari controller
    const taskStatusData = {!! json_encode($taskStatusData) !!};

    // Buat dataset untuk grafik
    const data = {
        labels: ['Pending', 'In Progress', 'Done'],
        datasets: [
            {
                label: 'Task Status',
                data: [taskStatusData.pending, taskStatusData.inProgress, taskStatusData.done],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }
        ]
    };

    // Buat grafik
    const ctx = document.getElementById('taskStatusChart').getContext('2d');
    const taskStatusChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


