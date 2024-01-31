@extends('layouts.main')

@section('container')
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Dashboard</h1>
    </div>

    <div class="row m-2">
        <div class="col-md-6 col-xl-3 offset-2">
            <a href="customers" class="text-decoration-none">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon primary">
                        <i class="bi bi-people custom-icon"></i>
                    </div>
                    <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ $data['sumUsers'][0] }}</p>
                        <p class="stat-cards-info__title">Total Customers</p>
                    </div>
                </article>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a href="products" class="text-decoration-none">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon primary">
                        <i class="bi bi-cart custom-icon"></i>
                    </div>
                    <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ $data['sumProducts'][0] }}</p>
                        <p class="stat-cards-info__title">Total Products</p>
                    </div>
                </article>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a href="#Data_Checkout" class="text-decoration-none">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon primary">
                        <i class="bi bi-cart-check custom-icon"></i>
                    </div>
                    <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ $data['sumSoldOut'][0] }}</p>
                        <p class="stat-cards-info__title">Total Checkouts</p>
                    </div>
                </article>
            </a>
        </div>
    </div>

    <hr>

    <h2 id="Data_Checkout">Data Checkout</h2>
    <div class="table-responsive small me-5 ms-5 pe-2 ps-2">
        <table class="table table-striped table-sm">
            <thead class="table-light fs-6">
                <tr>
                    <th scope="col">No. </th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name Product</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date Checkout</th>
                </tr>
            </thead>
            <tbody class="fs-6">
                @foreach ($data['carts'] as $index => $cart)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cart['name'] }}</td>
                        <td>{{ $cart['phone'] }}</td>
                        <td>{{ $cart['address'] }}</td>
                        <td>{{ $cart['email'] }}</td>
                        <td>{{ $cart['name_product'] }}</td>
                        <td>{{ $cart['qty'] }}</td>
                        <td>{{ "Rp" . number_format($cart['price'], 2, ",", ".") }}</td>
                        <td>{{ $cart['checkout_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
