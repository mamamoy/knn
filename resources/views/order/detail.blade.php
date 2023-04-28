@extends('layouts.main')

@section('title')
    <title>Order Detail - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><a href="{{route('order.history')}}"><span class="fa-fw select-all fas"></span></a> Order Detail</h3>
                    <p class="text-subtitle text-muted">
                        Data order.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('order.history') }}">Order History</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Order Detail
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <img style="width: 90px; height: 90px"
                                        src="{{ asset('/assets/images/logo/favicon.svg') }}" alt="">
                                </div>
                                <div class="col-md-6 text-end">
                                    <h4 class="card-title">Nama PT</h4>
                                    <p class="mt-0 mb-0">Alamat</p>
                                    <p class="mt-0 mb-0">Telpon</p>
                                    <p class="mt-0 mb-0">Fax</p>
                                    <a class="mt-0 mb-0" href="">www.web.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <hr style="border-top: 2px solid; margin:1px">
                            <hr style="margin: 1px">
                            <div class="card-body">
                                <div class="text-center mt-0">
                                    <h4>Data Pemesan</h4>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Pemesan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ $order->customers->nama_customer }}" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="email" class="form-control"
                                                    value="{{ $order->customers->email }}" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nomor Telepon</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ $order->customers->telpon }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Kasir</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ $order->cashiers->nama_kasir }}" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Order ID</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="email" class="form-control" value="{{ $orderId }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tanggal Order</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control" value="{{ $order->created_at }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center mt-0">
                                    <h4>Item Pesanan</h4>
                                </div>
                                <hr>
                                <div style="max-height: 500px; overflow-y: scroll;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_items as $key => $item)
                                                {{-- @dd($item) --}}
                                                {{-- <input type="text" name="items_id[]" hidden value="{{ $item->id }}"> --}}
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item['nama_barang'] }}</td>
                                                    <td>{{ $item['category'] }}</td>
                                                    <td class="text-end">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                                    <td class="text-end">{{$item['jumlah']}} item</td>
                                                    <td class="text-end">Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-end"><b>Total :</b></td>
                                                <td class="text-end">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    @endif
@endpush
