@extends('layouts.main')

@section('title')
    <title>Order - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Order</h3>
                    <p class="text-subtitle text-muted">
                        Silahkan masukkan data yang akan dibeli.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                Order
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <form action="{{ route('order.create') }}" method="POST">
            @csrf
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">
                                Input Data Order
                            </h4>
                            <div class="col-md-3 align-self-center">
                                <h6>Nama Kasir</h6>
                                <fieldset class="form-group">
                                    <select class="form-select" name="cashier_id" id="basicSelect">
                                        @foreach ($cashier as $kasir)
                                            <option value="{{ $kasir->id }}">{{ $kasir->nama_kasir }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="roundText">Nama</label>
                                    <input type="text" id="roundText" class="form-control round"
                                        placeholder="Nama Pembeli" name="nama_customer" value="{{ old('nama_customer') }}"
                                        required>
                                    @error('nama_customer')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="roundText">Email</label>
                                    <input type="email" id="roundText" class="form-control round"
                                        placeholder="Email Pembeli" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="roundText">Nomor Telepon</label>
                                    <input type="text" id="roundText" class="form-control round"
                                        placeholder="Nomor Telepon Pembeli" name="telpon" value="{{ old('telpon') }}"
                                        required>
                                    @error('telpon')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="height: 500px; overflow-y: scroll;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th style="width:150px">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        {{-- <input type="text" name="items_id[]" hidden value="{{ $item->id }}"> --}}
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->category->nama_kategori }}</td>
                                            <td class="text-end">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->stocks->jumlah }}</td>
                                            <td style="width:150px"><input type="number"
                                                    class="form-control jumlah-item-{{ $item->id }}"
                                                    name="jumlah[{{ $item->id }}]" value="{{ old('jumlah', 0) }}"
                                                    min="0">
                                            </td>
                                            <input type="hidden" name="items_id[]" value="{{ $item->id }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-outline-primary">Buat Order</button>
                        </div>

                    </div>
            </section>
        </form>
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

    <script>
        $(document).ready(function() {
            $('input[name^="jumlah"]').on('input', function() {
                var input = $(this);
                var tr = input.parents('tr');
                if (input.val() > 0) {
                    tr.addClass('table-active');
                } else {
                    tr.removeClass('table-active');
                }
            });
        });
    </script>


    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data anda berhasil disimpan',
            })
        </script>
    @elseif(session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data anda gagal disimpan',
            })
        </script>
    @endif
@endpush
