@extends('index')
@section('content')
    <div class="container">
        <h1 class="text-center">User List</h1>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                <strong>{{ session()->get('message') }}</strong>
            </div>
        @endif
        <div class="table-responsive">
            <a href="{{ route('user.create') }}" class="btn btn-primary mt-2 mb-4">Create User</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr class="">
                            <td scope="row">{{ $n++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->role }}</td>
                            <td> <span
                                    class="badge badge-pill bg-{{ $user->is_verified ? 'success' : 'danger' }}">{{ $user->is_verified ? 'Active' : 'Block' }}</span>
                            </td>
                            <td>
                                <a class="btn btn-danger change-status" data-bs-toggle="modal"data-bs-target="#modalId" data-id="{{ $user->id }}">Change Status</a>
                                <a  class="btn btn-warning change-password" data-bs-toggle="modal" data-bs-target="#updatePassword"data-id="{{ $user->id }}">Reset Password</a>
                                <a  class="btn btn-secondary change-user-detail" data-bs-toggle="modal"data-bs-target="#editUserDetail"data-id="{{ $user->id }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Update Status Start --}}
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="statusUpdate">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            User Status
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select class="form-select form-select-lg" name="status" id="status_data">
                                    <option>Select one</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success btnSave">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Update Status End --}}

    {{-- Update Password Start --}}
    <div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="passwordUpdate">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Update Password
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Enter new password" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="Confirm Password" />
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success btnPassword">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Update Password End --}}

        {{-- Update User Detail Start --}}
    <div class="modal fade" id="editUserDetail" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="userUpdate">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Update User Detail
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Full Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control user_name"
                                    placeholder=""
                                />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input
                                    type="text"
                                    name="email"
                                    class="form-control user_email"
                                    placeholder=""
                                />
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Roles</label>
                                <select
                                    class="form-select form-select-lg roles"
                                    name="role_id"
                                    id=""
                                >
                                    <option selected>Select one</option>
                                   @foreach ($roles as $role)
                                   <option value="{{ $role->id }}" >{{ $role->role }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success btnUserDetail">Update Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Update User Detail End --}}


    <script>
        $(document).ready(function() {
            $(".change-status").on("click", function() {
                let id = $(this).attr("data-id");
                console.log(id);
                $.ajax({
                    url: "/admin/fetch/status/" + id,
                    method: "get",
                    success: function(response) {
                        console.log(response);
                        $("#status_data").empty();
                        if (Array.isArray(response.message) && response.message.length > 0) {
                            let user = response.message[
                                0]; // Assuming response has a single user object in the array

                            if (user.is_verified === 1) {
                                $("#status_data").append(
                                    `<option value="1" selected>Active</option>`
                                );
                                $("#status_data").append(
                                    `<option value="0">Blocked</option>`
                                );
                            } else {
                                $("#status_data").append(
                                    `<option value="1">Active</option>`
                                );
                                $("#status_data").append(
                                    `<option value="0" selected>Blocked</option>`
                                );
                            }
                        } else {
                            $("#status_data").append(
                                `<option>No data available</option>`
                            );
                        }
                    },
                });

                // Update Status
                $("#statusUpdate").submit(function(event) {
                    event.preventDefault();
                    $(".btnSave").prop("disabled", true);
                    $(".btnSave").text("Updating...");
                    let formdata = new FormData(this);
                    $.ajax({
                        method: "POST",
                        url: "/admin/user/status/update/" + id,
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "User Saved Successfully",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        }
                    })
                })
            });

            // Update Password
            $(".change-password").on("click", function() {
                let id = $(this).attr("data-id");
                $("#passwordUpdate").on("submit", function(event) {
                    event.preventDefault();
                    $(".btnPassword").text("Updating....");
                    $(".btnPassword").prop("disabled", true);
                    let formdata = new FormData(this);
                    $.ajax({
                        method: "POST",
                        url: "/admin/user/password/update/" + id,
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Password Changed Successfully",
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
                                $(".btnPassword").text("Update Password");
                                $(".btnPassword").prop("disabled", false);
                            }
                        }
                    })
                })
            })

            // Show User Detail
            $(".change-user-detail").on("click",function(){
                let id=$(this).attr("data-id");
                // Fetch the value
                $.ajax({
                    method:"get",
                    url:"/admin/user/detail/show/"+id,
                    success:function(response){
                        console.log(response);
                        $(".user_name").val(response.message[0].name);
                        $(".user_email").val(response.message[0].email);
                        $(".roles").val(response.message[0].role_id);
                    }
                });

                // Update users
                $("#userUpdate").submit(function(event){
                    event.preventDefault();
                    let formdata=new FormData(this);
                    $(".btnUserDetail").text("Updating...");
                    $(".btnUserDetail").prop("disabled",true);
                    $.ajax({
                        method:"POST",
                        url:"/admin/user/detail/update/"+id,
                        data:formdata,
                        contentType:false,
                        processData:false,
                        success:function(response){
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Detail Updated Successfully",
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
                                $(".btnUserDetail").text("Update Details");
                                $(".btnUserDetail").prop("disabled", false);
                            }
                        }
                    })

                })
            });

        });
    </script>
@endsection
