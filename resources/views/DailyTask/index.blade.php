@extends('index')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
            Add Task
        </button>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
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
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($tasks as $task)
                        <tr class="">
                            <td>{{ $n++ }}</td>
                            <td class="text-left">{{ $task->title }}</td>
                            <td>
                                {{ DB::table('tasks')->join('task_details', 'task_details.task_id', 'tasks.id')->where('task_details.status', 1)->where('task_id', $task->id)->count() }}/{{ $task->taskDetail->count() }}
                            </td>
                            <td>{{ $task->starting_date }}</td>
                            <td>{{ $task->due_date ?? 'Date not Set ' }}</td>
                            <td>{{ $task->createdBy->name }}</td>
                            <td>
                                <a href="{{ route('task.details',$task->id) }}" class="btn btn-warning">View Details</a>
                                <a class="btn btn-primary editTasks" data-id="{{ $task->id }}"data-bs-toggle="modal" data-bs-target="#editTasks">Edit</a>
                                <a  class="btn btn-danger" data-id="{{ $task->id }}"   data-bs-toggle="modal" data-bs-target="#deleteTasks">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Create Task Modal -->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
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
                                    <div>
                                        <button class="btn btn-primary mt-1 mb-3" type="button" id="addMore">Add
                                            More</button>
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
                                                            class="form-control" placeholder=""
                                                            aria-describedby="helpId" />
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

        {{-- Edit Tasks Modal --}}
        <div class="modal fade" id="editTasks" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-xl" role="document">
                <div class="modal-content">
                    <form id="editTaskDetails">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Implement Task Edit
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    @csrf
                                    <div class="mb-3 mt-2 mb-2">
                                        <label for="" class="form-label">Title</label>
                                        <input type="text" name="title" id=""
                                            class="form-control editTitle" placeholder="" aria-describedby="helpId" />
                                    </div>

                                    <div class="row mt-2 mb-2">
                                        <div class="col-6">
                                            <label for="" class="form-label">Starting Date</label>
                                            <input type="date" name="starting_date" id=""
                                                class="form-control editStartingDate" placeholder=""
                                                aria-describedby="helpId" />
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="form-label">Due Date</label>
                                            <input type="date" name="due_date" id=""
                                                class="form-control editDueDate" placeholder=""
                                                aria-describedby="helpId" />
                                        </div>
                                    </div>
                                    <div class=" mt-2 mb-4">
                                        <label for="" class="form-label">Note</label>
                                        <textarea class="form-control editNote" name="note" id="" rows="3"></textarea>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary EditMore mt-1 mb-3" type="button">Add
                                            More</button>
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
                                            <tbody class="editTasksDatas">
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
                            <button type="submit" class="btn btn-success updateTaskBtn">Update Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--Delete Tasks Modal -->
        <div
            class="modal fade"
            id="deleteTasks"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Delete tasks
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h4 class="text-danger">Are you sure you want to delete ?</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-danger">Confirm Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var modalId = document.getElementById('modalId');

            modalId.addEventListener('show.bs.modal', function (event) {
                  // Button that triggered the modal
                  let button = event.relatedTarget;
                  // Extract info from data-bs-* attributes
                  let recipient = button.getAttribute('data-bs-whatever');

                // Use above variables to manipulate the DOM
            });
        </script>


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

                $(".removerow").on("click", function() {
                    $(this).closest('tr').remove();

                });
            });

            // Create a task
            $("#createTask").on("submit", function(event) {
                event.preventDefault();
                $("#btnSaveTask").prop("disabled", true);
                $("#btnSaveTask").text("Saving...");
                let formdata = new FormData(this);
                console.log(formdata);
                $.ajax({
                    method: "POST",
                    url: "/admin/task/add",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
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
                                title: "Something went wrong",
                                text: "Please refresh and try again",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#btnSaveTask").text("Confirm Delete");
                            $("#btnSaveTask").prop("disabled", false);
                        }
                    }
                });
            });

            $(".editTasks").on("click", function() {
                let id = $(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method: "get",
                    url: "/admin/task/edit/" + id,
                    success: function(response) {
                        console.log(response);
                        $(".editTitle").val(response.tasks.title);
                        $(".editStartingDate").val(response.tasks.starting_date);
                        $(".editDueDate").val(response.tasks.due_date);
                        $(".editNote").val(response.tasks.note);
                        $(".editTasksDatas").empty();
                        response.message.forEach(element => {

                            let statusOptions = `
                    <option value="">Select one</option>
                    <option value="1" ${element.status == 1 ? 'selected' : ''}>Completed</option>
                    <option value="0" ${element.status == 0 ? 'selected' : ''}>Pending</option>
                `;

                            $(".editTasksDatas").append(`
                             <tr class="">
                                                <td scope="row">
                                                    <input type="text" name="assignment[]" id=""
                                                        class="form-control" placeholder="" aria-describedby="helpId" value="${element.assignment}" />
                                                </td>
                                                <td>
                                                    <input type="text" name="remarks[]" id=""
                                                        class="form-control" placeholder="" aria-describedby="helpId" value="${element.remarks ?? ""}" />
                                                </td>
                                                <td scope="row">
                                                      <select class="form-select" name="status[]">
                                                  ${statusOptions}
                                                </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" type="button">Remove</button>
                                                </td>
                                            </tr>
                            `);
                        });


                    }
                })

                $("#editTaskDetails").submit(function(event) {
                    event.preventDefault();
                    $(".updateTaskBtn").text("Updating...");
                    $(".updateTaskBtn").prop("disabled", true);
                    let formdata = new FormData(this);
                    $.ajax({
                        method: "POST",
                        url: "/admin/task/update/"+id,
                        data:formdata,
                        contentType:false,
                        processData:false,
                        success:function(response){
                            console.log(response);
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Task Updated Successfully",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Something went wrong",
                                    text: "Please refresh and try again",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $(".btnDelete").text("Confirm Delete");
                                $(".btnDelete").prop("disabled", false);
                            }
                        }
                    })
                })
            })

            $(".EditMore").on("click", function() {
                $(".editTasksDatas").append(`
                                         <tr class="">
                                            <td scope="row">
                                                <input   type="text" name="assignment[]" id="" class="form-control" placeholder=""  aria-describedby="helpId"/>
                                            </td>
                                            <td>
                                              <input type="text" name="remarks[]" id="" class="form-control" placeholder="" aria-describedby="helpId"/>
                                            </td>
                                            <td scope="row">
                                              <select  class="form-select" name="status[]" id="" >
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

                $(".removerow").on("click", function() {
                    $(this).closest('tr').remove();
                });
            });

        })
    </script>
@endsection
