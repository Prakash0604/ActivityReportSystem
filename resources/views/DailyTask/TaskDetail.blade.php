@extends('index')
@section('content')
<div class="container">
    <div class="container report-container">
        <style>
            .report-container {
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                border: 1px solid #ddd;
                background: #f9f9f9;
                border-radius: 10px;
            }

            .report-header {
                text-align: center;
                margin-bottom: 20px;
            }

            .table th,
            .table td {
                vertical-align: middle;
            }
        </style>
        <div class="report-header">
            <h4>Daily Activity Report</h4>
            <h5>{{ $tasks[0]->title }}</h3>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th class="w-75">Assignment</th>
                    <th>Remarks</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n=1;
                @endphp
                @foreach ($tasks as $task)
                    @foreach ($task->taskDetail as $detail)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $detail->assignment }}</td>
                            <td>{{ $detail->remarks }}</td>
                            <td>{{ $detail->status ? 'Completed' : 'Pending' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes:</label>
            <textarea class="form-control" id="notes" rows="3" readonly>{{ $task->note }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <p>Created By : {{ $task->createdBy->name }}</p>
            </div>
            <div>
                <p>____________________________</p>
                <p>Approved by</p>
            </div>
        </div>
        <div class="container mt-4">
            <a href="" class="btn btn-primary">Print</a>
            <a href="{{ route('task.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
