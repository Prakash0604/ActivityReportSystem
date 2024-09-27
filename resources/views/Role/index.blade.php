@extends('index')
@section('content')
    <div class="container">
        <h1 class="text-center">Roles</h1>
        <button class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#modalId">Create Roles</button>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S.n</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($roles as $role)
                        <tr class="">
                            <td scope="row">{{ $n++ }}</td>
                            <td>{{ $role->role }}</td>
                            <td><span
                                    class="badge badge-pill bg-{{ $role->status ? 'success' : 'danger' }}">{{ $role->status ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <a href="" class="btn btn-warning editRole" data-id={{ $role->id }} data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                <a href="" class="btn btn-danger deleteRole" data-id={{ $role->id }} data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Roles  Create-->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="createRole">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Create Roles
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Role Name</label>
                                <input type="text" name="role" id="" class="form-control"
                                    placeholder="Enter the role" />
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary " id="btnSave">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Roles  Edit-->
     <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateRole">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Roles
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Role Name</label>
                                <input type="text" name="role" id="role_id" class="form-control"
                                    placeholder="Enter the role" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select
                                    class="form-select form-select-lg status"
                                    name="status"
                                    id="status"
                                >
                                    <option selected>Select one</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary btnUpdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Role Delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteRole">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Delete Roles
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h4 class="text-danger">Are you sure you want to delete ?</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger btnDelete">Confirm Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#createRole").submit(function(event){
                event.preventDefault();
                $("#btnSave").text("Saving...");
                $("#btnSave").prop("disabled",true);
                let formdata=new FormData(this);
                $.ajax({
                    method:"POST",
                    url:"/admin/role/create",
                    data:formdata,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Role Added Successfully",
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
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#btnSave").text("Create");
                                $("#btnSave").prop("disabled", false);
                            }
                    }
                })
            });

            // Edit Role
            $(".editRole").on("click",function(){
                let id=$(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method:"get",
                    url:"/admin/role/get/"+id,
                    success:function(response){
                        console.log(response);
                        $("#role_id").val(response.message.role);
                        $("#status").val(response.message.status);
                    }
                });

                $("#updateRole").submit(function(event){
                    event.preventDefault();
                    $(".btnUpdate").text("Updating....");
                    $(".btnUpdate").prop("disabled",true);
                    let formdata=new FormData(this);
                    $.ajax({
                        method:"POST",
                        url:"/admin/role/update/"+id,
                        data:formdata,
                        processData:false,
                        contentType:false,
                        success:function(response){
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Role Updated Successfully",
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
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#btnUpdate").text("Update");
                                $("#btnUpdate").prop("disabled", false);
                            }
                        }
                    })
                })
            });

            $(".deleteRole").on("click",function(){
                let id=$(this).attr("data-id");
                $("#deleteRole").submit(function(event){
                    event.preventDefault();
                    $(".btnDelete").text("Deleting...");
                    $(".btnDelete").prop("disabled",true);
                    $.ajax({
                        method:"get",
                        url:"/admin/role/delete/"+id,
                        success:function(response){
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Role Deleted Successfully",
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
                                $(".btnDelete").text("Confirm Delete");
                                $(".btnDelete").prop("disabled", false);
                            }
                        }
                    })
                })
            })
        });
    </script>
@endsection
