@extends('layouts.main')

@section('title')
    <title>Order History - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Order History</h3>
                    <p class="text-subtitle text-muted">
                        Riwayat Pembelian.
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

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Data Historis Order
                    </h4>
                </div>
                <div class="card-body">

                    <div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Order</th>
                                    <th>Nama Kasir</th>
                                    <th>Nama Pembeli</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    {{-- <input type="text" name="orders_id[]" hidden value="{{ $order->id }}"> --}}
                                    {{-- @dd($order) --}}
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->cashiers->nama_kasir }}</td>
                                        <td>{{ $order->customers->nama_customer }}</td>
                                        <td>
                                            @if ($order->status == 0)
                                                Belum Selesai
                                            @else
                                                Sudah Selesai
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('order.show', ['id' => $order->id])}}" class="btn btn-outline-warning" >
                                                <dl class="dt w-100 mb-0 pa0">
                                                    <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                                    <dd class="mt-2 text-sm select-all word-wrap dtc v-top tl f2 icon-name">Detail
                                                    </dd>
                                                </dl>
                                            </a>
                                        </td>
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
