@extends('index')
@section('content')
    <div class="container col-6">
        <h1 class="text-center">Create Users</h1>
        <div class="card p-3">
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Full Name</label>
                <input
                    type="text"
                    name="name"
                    id=""
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder=""
                    aria-describedby="helpId"
                />
                @error('name')
                <small id="helpId" class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    id=""
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder=""
                    aria-describedby="helpId"
                />
                @error('email')
                <small id="helpId" class="text-danger">{{ $message }}</small>
                @enderror
            </div>
             <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    id=""
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder=""
                    aria-describedby="helpId"
                />
                @error('password')
                <small id="helpId" class="text-danger">{{ $message }}</small>
                @enderror
            </div>
             <div class="mb-3">
                <label for="" class="form-label">Confirm Password</label>
                <input
                    type="password"
                    name="confirm_password"
                    id=""
                    class="form-control @error('confirm_password') is-invalid @enderror"
                    placeholder=""
                    aria-describedby="helpId"
                />
                @error('confirm_password')
                <small id="helpId" class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Roles</label>
                <select
                    class="form-select form-select-lg"
                    name="role_id"
                    id=""
                >
                    <option selected>Select one</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button class="btn btn-primary" id="addUser">Add User</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    </div>
@endsection
