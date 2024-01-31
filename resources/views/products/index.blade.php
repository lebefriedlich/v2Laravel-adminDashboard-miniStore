@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Products</h1>
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
        <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addProduct">
            <i class="bi bi-plus-circle-fill"></i> Add Product
        </button>
        <table class="table table-striped table-sm">
            <thead class="table-light fs-6">
                <tr>
                    <th class="col-0">No</th>
                    <th class="col-2">Nama Product</th>
                    <th class="col-3">Deskripsi</th>
                    <th class="col-2">Gambar</th>
                    <th class="col-1">Harga</th>
                    <th class="col-1">Stok</th>
                    <th class="col-1">Kategori</th>
                    <th class="col-1">Merek</th>
                    <th class="col-1">Aksi</th>
                </tr>
            </thead>
            <tbody class="fs-6">
                @foreach ($data['products'] as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product['name_product'] }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td><img src="{{ asset('images/product/' . $product['image']) }}"
                                alt="Gambar {{ $product['name_product'] }}" style="width: 200px; height: 200px;"></td>
                        <td>{{ 'Rp' . number_format($product['price'], 2, ',', '.') }}</td>
                        <td>{{ $product['qty'] }}</td>
                        <td>{{ $product['category'] }}</td>
                        <td>{{ $product['brand'] }}</td>
                        <td>
                            <a href="" class="text-decoration-none btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editProduct{{ $product['id_product'] }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="" class="text-decoration-none btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteProduct{{ $product['id_product'] }}">
                                <i class="bi bi-trash3"></i>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editProduct{{ $product['id_product'] }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <form action="{{ BASEURL }}products/editProduct" method="post" --}}
                                    enctype="multipart/form-data">
                                    <input type="text" name="id_product" value="{{ $product['id_product'] }}"
                                        class="visually-hidden">
                                    <ul>
                                        <li class=" list-group-item mt-2">
                                            <label for="name" class="form-label fs-5 d-block">
                                                Name Product :
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $product['name_product'] }}" required />
                                        </li>
                                        <li class="list-group-item mt-2">
                                            <label for="description" class="form-label fs-5 d-block">
                                                Description :
                                            </label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $product['description'] }}" required />
                                        </li>
                                        <li class="list-group-item mt-2">
                                            <label for="image" class="form-label fs-5 d-block">
                                                Image Product :
                                            </label>
                                            <img src="{{ asset('images/product/' . $product['image']) }}"
                                                alt="Gambar {{ $product['name_product'] }}"
                                                style="width: 200px; height: 200px;">
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" name="image">
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item mt-2">
                                            <label for="price" class="form-label fs-5 d-block">
                                                Price :
                                            </label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ $product['price'] }}" required />
                                        </li>
                                        <li class="list-group-item mt-2">
                                            <label for="qty" class="form-label fs-5 d-block">
                                                Quantity :
                                            </label>
                                            <input type="text" name="qty" class="form-control"
                                                value="{{ $product['qty'] }}" required />
                                        </li>
                                        <li class="list-group-item mt-2">
                                            <label for="category" class="form-label fs-5 d-block">
                                                Category :
                                            </label>
                                            <input type="text" name="category" class="form-control"
                                                value="{{ $product['category'] }}" required />
                                        </li>
                                        <li class="list-group-item mt-2">
                                            <label for="brand" class="form-label fs-5 d-block">
                                                Brand :
                                            </label>
                                            <input type="text" name="brand" class="form-control"
                                                value="{{ $product['brand'] }}" required />
                                        </li>
                                    </ul>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="edit" class="btn btn-primary">Edit
                                            Product</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteProduct{{ $product['id_product'] }}" tabindex="-1"
                        aria-labelledby="deleteProductLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProductLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form action="{{ url('products/' . $product['id_product']) }}" method="post">
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

    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <ul>
                            <li class=" list-group-item mt-2">
                                <label for="name_product" class="form-label fs-5 d-block">
                                    Name Product :
                                </label>
                                <input type="text" name="name_product" class="form-control" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="description" class="form-label fs-5 d-block">
                                    Description :
                                </label>
                                <input type="text" name="description" class="form-control" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="image" class="form-label fs-5 d-block">
                                    Image Product :
                                </label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="image" id="inputGroupFile02"
                                        required>
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="price" class="form-label fs-5 d-block">
                                    Price :
                                </label>
                                <input type="text" name="price" class="form-control" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="qty" class="form-label fs-5 d-block">
                                    Quantity :
                                </label>
                                <input type="text" name="qty" class="form-control" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="category" class="form-label fs-5 d-block">
                                    Category :
                                </label>
                                <input type="text" name="category" class="form-control" required />
                            </li>
                            <li class="list-group-item mt-2">
                                <label for="brand" class="form-label fs-5 d-block">
                                    Brand :
                                </label>
                                <input type="text" name="brand" class="form-control" required />
                            </li>
                        </ul>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
