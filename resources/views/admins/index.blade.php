@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Data Admins</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    @if (session()->has('succes'))
        <div class="alert alert-success">
            {{ session('succes') }}
        </div>
    @endif


    <div class="table-responsive small me-5 ms-5 pe-2 ps-2 ">
        <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#registerModal">
            <i class="bi bi-plus-circle-fill"></i> Add Admin
        </button>
        <table class="table table-striped table-sm">
            <thead class="table-light fs-6">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="fs-6">
                @foreach ($data['admins'] as $index => $admin)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $admin['name_user'] }}</td>
                        <td>{{ $admin['email'] }}</td>
                        <td>{{ $admin['pass'] }}</td>
                        <td>
                            <a href="" class="text-decoration-none btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#EditModal{{ $admin['id_user'] }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="" class="text-decoration-none btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $admin['id_user'] }}">
                                <i class="bi bi-trash3"></i>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="EditModal{{ $admin['id_user'] }}" tabindex="-1"
                        aria-labelledby="EditModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="EditModalLabel">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admins.update', ['admin' => $admin['id_user']]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <ul>
                                            <li class="list-group-item mt-2">
                                                <label for="name_user" class="form-label fs-5 d-block">Name :</label>
                                                <input type="text" name="name_user" class="form-control"
                                                    value="{{ $admin['name_user'] }}" required />
                                            </li>
                                            <li class="list-group-item mt-2">
                                                <label for="email" class="form-label fs-5 d-block">Email :</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $admin['email'] }}" required />
                                            </li>
                                            <li class="list-group-item mt-2">
                                                <label for="password" class="form-label fs-5 d-block">Password :</label>
                                                <input type="text" name="pass" class="form-control"
                                                    value="{{ $admin['pass'] }}" required />
                                            </li>
                                            <input type="text" name="passOld" value="{{ $admin['pass'] }}"
                                                class="visually-hidden">
                                        </ul>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $admin['id_user'] }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ url('admins/' . $admin['id_user']) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerModalLabel">Sign Up Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <ul class="list-unstyled">
                            <li class="list-group-item mt-2">
                                <label for="name_user" class="form-label fs-5 d-block">
                                    <i class="bi bi-person-fill"></i> Name :
                                </label>
                                <input type="text" name="name_user" class="form-control"
                                    placeholder="Enter your Name" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="email" class="form-label fs-5 d-block">
                                    <i class="bi bi-envelope-fill"></i> Email :
                                </label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter a valid email address" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="pass" class="form-label fs-5 d-block">
                                    <i class="bi bi-key-fill"></i> Password :
                                </label>
                                <input type="password" name="pass" class="form-control"
                                    placeholder="Enter your password" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="confirmPass" class="form-label fs-5">
                                    <i class="bi bi-key-fill"></i> Konfirmasi Password :
                                </label>
                                <input type="password" name="confirmPass" class="form-control"
                                    placeholder="Re-type your password" required />
                            </li>
                        </ul>
                        <div class="modal-footer">
                            <button type="submit" name="addAdmin" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
