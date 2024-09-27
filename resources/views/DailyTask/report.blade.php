@extends('index')
@section('content')
    <div class="container">
        <a type="button" class="btn btn-primary" id="filterData">Toggle Filter</a>
        <div class="container togglebutton">
            <form action="">
                <div class="row">
                    <div class="col-6">
                        <label for="" class="form-label">User</label>
                        <select class="form-select form-select-lg" name="" id="">
                            <option selected>Select one</option>
                            <option value="">New Delhi</option>
                            <option value="">Istanbul</option>
                            <option value="">Jakarta</option>
                        </select>
                    </div>
                    <div class="col-6 mt-4">
                        <button class="btn btn-primary mt-1 btn-lg">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container report-container">
            <style>
                .report-container {
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
                    text-align: center;
                }

                .btn {
                    margin: 5px;
                }

                  /* Styling for Print */
                  @media print {
                    body {
                        -webkit-print-color-adjust: exact;
                        /* To ensure background colors print */
                    }

                    /* Hide navigation and buttons */
                    body * {
                        visibility: hidden;
                    }

                    /* Show only the report container */
                    .report-container, .report-container * {
                        visibility: visible;
                    }

                    /* Hide elements that should not appear in print */
                    .navbar,
                    .footer,
                    .btn,
                    .togglebutton,
                    .d-print-none {
                        display: none !important;
                    }

                    /* Adjust margins and layout for print */
                    .report-container {
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 100%;
                        padding: 0;
                        margin: 0;
                    }

                    /* Optional: adjust table and text size for print */
                    .table th, .table td {
                        font-size: 12px; /* Adjust as needed */
                        padding: 8px;
                    }

                    .report-header h4,
                    .report-header h5 {
                        font-size: 1.2em; /* Adjust heading size */
                    }
                }
            </style>
            <div class="report-header">
                <h4>Overall Activity Report</h4>
                <h5>Name: {{ Auth::user()->name }}</h5>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="8" class="text-center">Assignment Detail</th>
                    </tr>
                    <tr>
                        <th>S.N</th>
                        <th class="w-20">Title</th>
                        <th class="w-20">Assignment</th>
                        <th class="w-20">Starting Date</th>
                        <th class="w-20">Due Date</th>
                        <th>Status</th>
                        <th class="w-20">Remarks</th>
                        <th class="w-20">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($users as $user)
                        @php
                            $taskCount = $user->taskDetail->count();
                        @endphp
                        <tr>
                            <td rowspan="{{ $taskCount }}">{{ $n++ }}</td>
                            <td rowspan="{{ $taskCount }}">{{ $user->title }}</td>
                            <td>{{ $user->taskDetail->first()->assignment }}</td>
                            <td rowspan="{{ $taskCount }}">{{ $user->starting_date }}</td>
                            <td rowspan="{{ $taskCount }}">{{ $user->due_date }}</td>
                            <td>{{ $user->taskDetail->first()->status ? 'Completed' : 'Pending' }}</td>
                            <td>{{ $user->taskDetail->first()->remarks }}</td>
                            <td rowspan="{{ $taskCount }}">{{ $user->note }}</td>
                        </tr>
                        @foreach ($user->taskDetail->skip(1) as $task)
                            <tr>
                                <td>{{ $task->assignment }}</td>
                                <td>{{ $task->status ? 'Completed' : 'Pending' }}</td>
                                <td>{{ $task->remarks }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <div>
                    <p>Created By: {{ $user->createdBy->name }}</p>
                </div>
                <div class="text-right">
                    <p>____________________________</p>
                    <p>Approved by</p>
                </div>
            </div>
            <div class="container mt-4 d-flex justify-content-center">
                <button onclick="window.print()" class="btn btn-primary">Print</button>
                <a href="{{ route('task.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    <script>
        $("#filterData").on("click", function() {
            $(".togglebutton").toggle(1500);
        })
    </script>
@endsection
