@extends('layouts.main')

@section('title')
    <title>Analitic Result - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Analitic Result</h3>
                    <p class="text-subtitle text-muted">
                        Berikut merupakan hasil analisa.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                Analitic Result
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            Input Data Analisa
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Nilai K</h6>
                            <fieldset class="form-group">
                                <input type="text" class="form-control" value="{{ $k }}" disabled>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <h6>Nama Kasir</h6>
                            <fieldset class="form-group">
                                <input type="text" class="form-control" value="{{ $cashier->nama_kasir }}" disabled>
                            </fieldset>
                        </div>
                    </div>
                    <div style="max-height: 500px; overflow-y: scroll;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah (pcs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $category => $items)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category }}</td>
                                        <td>{{ $items[0] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js "></script>
@endpush
