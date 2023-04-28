<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Mazer</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
    <style>
        .value {
            font-size: 100px;
            display: block;
            font-weight: bold;
            color: #25396f;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            {{-- <a href="index.html"><i class="bi bi-chevron-left"></i></a> --}}
            <a class="navbar-brand ms-4" href="index.html">
                <img src="{{ asset('assets/images/logo/logo.svg') }}">
            </a>
        </div>
    </nav>

    <div class="container">
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><a href="/laravel">Laravel 10.x</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex align-items-center justify-content-around">
                                    <img src="{{ asset('assets/images/samples/1.png') }}"
                                        class="col-lg-6 col-md-6 col-6"></img>
                                    <div class="col-lg-4 col-md-4 col-4 text-center">
                                        <div class="value" akhi="10">0</div>
                                        <h5>Laravel</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Features</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex align-items-center justify-content-around">
                                    <img src="{{ asset('assets/images/samples/2.png') }}"
                                        class="col-lg-6 col-md-6 col-6"></img>
                                    <div class="col-lg-4 col-md-4 col-4 text-center">
                                        <div class="value" akhi="4">0</div>
                                        <h5>Features</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deskripsi</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                Sistem ini merupakan sistem untuk melakukan proses data mining dengan algoritma
                                <code>K-Nearest Neighbor</code>.
                            </p>
                            <p>
                                Sistem ini dapat mengklasifikasikan pelanggan ke dalam kelompok-kelompok berdasarkan
                                karakteristik pembelian yang ada, seperti frekuensi, jumlah, atau jenis produk yang
                                dibeli.
                            </p>
                            <p>
                                Sistem ini juga dapat memprediksi penjualan masa depan berdasarkan pola-pola historis
                                dari data transaksi penjualan. Sistem ini dapat membantu meningkatkan strategi pemasaran
                                atau penjualan dengan mengetahui preferensi dan kebutuhan pelanggan.
                            </p>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <h4>Fitur :</h4>
                            <ul class="list-group">
                                <li class="list-group-item">Laravel 10.x</li>
                                <li class="list-group-item">Bootstrap 5</li>
                                <li class="list-group-item">Create, Read, Update, Delete (CRUD)</li>
                                <li class="list-group-item">Algoritma <code>K-Nearest Neighbor</code></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Menu :</h4>
                            <div class="list-group">
                                <a href="{{route('dashboard.index')}}" class="list-group-item list-group-item-action">Dashboard</a>
                                <a href="" class="list-group-item list-group-item-action">Cashier</a>
                                <a href="{{route('items.index')}}" class="list-group-item list-group-item-action">Item</a>
                                <a href="{{route('stock.index')}}" class="list-group-item list-group-item-action">Stok</a>
                                <a href="{{route('order.index')}}" class="list-group-item list-group-item-action">Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const counters = document.querySelectorAll('.value');
        const speed = 2000;

        counters.forEach(counter => {
            const animate = () => {
                const value = +counter.getAttribute('akhi');
                const data = +counter.innerText;

                const time = value / speed;
                if (data < value) {
                    counter.innerText = Math.ceil(data + time);
                    setTimeout(animate, 1);
                } else {
                    counter.innerText = value;
                }

            }

            animate();
        });
    </script>

</body>

</html>
