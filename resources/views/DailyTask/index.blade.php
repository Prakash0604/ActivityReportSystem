@extends('index')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
            Add Task
        </button>

        <div
            class="table-responsive mt-4"
        >
            <table
                class="table table-bordered"
            >
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Assignment</th>
                        <th scope="col">Starting Date</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n=1;
                    @endphp
                    @foreach ($tasks as $task)
                    <tr class="">
                        <td>{{ $n++ }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            @foreach ($task->taskDetail as $tasks)
                                <li>{{ $tasks->assignment }}</li>
                            @endforeach
                        </td>
                        <td>{{ $task->starting_date }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->createdBy->name }}</td>
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            <a href="" class="btn btn-warning">View Details</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Create Task Modal -->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-xl" role="document">
                <div class="modal-content">
                    <form id="createTask">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Implement Task
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                    <div class="mb-3 mt-2 mb-2">
                                        <label for="" class="form-label">Title</label>
                                        <input type="text" name="title" id="" class="form-control"
                                            placeholder="" aria-describedby="helpId" />
                                    </div>

                                    <div class="row mt-2 mb-2">
                                        <div class="col-6">
                                            <label for="" class="form-label">Starting Date</label>
                                            <input type="date" name="starting_date" id="" class="form-control"
                                                placeholder="" aria-describedby="helpId" />
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="form-label">Due Date</label>
                                            <input type="date" name="due_date" id="" class="form-control"
                                                placeholder="" aria-describedby="helpId" />
                                        </div>
                                    </div>
                                    <div class=" mt-2 mb-4">
                                        <label for="" class="form-label">Note</label>
                                        <textarea class="form-control" name="note" id="" rows="3"></textarea>
                                    </div>
                                    <div class="table-responsive mt-2 mb-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Assignment</th>
                                                    <th scope="col">Remark</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="fetchMore">
                                                <tr class="">
                                                    <td scope="row">
                                                        <input type="text" name="assignment[]" id=""
                                                            class="form-control" placeholder="" aria-describedby="helpId" />

                                                    </td>
                                                    <td>
                                                        <input type="text" name="remarks[]" id=""
                                                            class="form-control" placeholder="" aria-describedby="helpId" />
                                                    </td>
                                                    <td scope="row">
                                                        <select class="form-select" name="status[]" id="">
                                                            <option value="">Select one</option>
                                                            <option value="1">Completed</option>
                                                            <option selected value="0">Pending</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger" type="button">Remove</button>
                                                    </td>
                                                </tr>
                                                <div>
                                                    <button class="btn btn-primary" type="button" id="addMore">Add More</button>
                                                </div>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" id="btnSaveTask" class="btn btn-success">Save Task</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#addMore").on("click", function() {
                $("#fetchMore").append(`
                                         <tr class="">
                                            <td scope="row">
                                                <input
                                                  type="text"
                                                  name="assignment[]"
                                                  id=""
                                                  class="form-control"
                                                  placeholder=""
                                                  aria-describedby="helpId"
                                                />

                                            </td>
                                            <td>
                                              <input
                                              type="text"
                                              name="remarks[]"
                                              id=""
                                              class="form-control"
                                              placeholder=""
                                              aria-describedby="helpId"
                                            />
                                            </td>
                                            <td scope="row">
                                              <select
                                              class="form-select"
                                              name="status[]"
                                              id=""
                                            >
                                              <option value="">Select one</option>
                                              <option value="1">Completed</option>
                                              <option selected value="0">Pending</option>
                                            </select>
                                            </td>
                                            <td>
                                              <button class="btn btn-danger removerow" type="button" >Remove</button>
                                            </td>
                                          </tr>
                `);

                $(".removerow").on("click",function(){
                    $(this).closest('tr').remove();

                });
            });

            // Create a task
            $("#createTask").on("submit",function(event){
                event.preventDefault();
                $("#btnSaveTask").prop("disabled",true);
                $("#btnSaveTask").text("Saving...");
                let formdata=new FormData(this);
                console.log(formdata);
                $.ajax({
                    method:"POST",
                    url:"/admin/task/add",
                    data:formdata,
                    contentType:false,
                    processData:false,
                    success:function(response){
                        console.log(response);
                        if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Task Saved Successfully",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Warning",
                                    text: "Tagged in another module",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#btnSaveTask").text("Confirm Delete");
                                $("#btnSaveTask").prop("disabled", false);
                            }
                    }
                });
            });


        })
    </script>
@endsection
