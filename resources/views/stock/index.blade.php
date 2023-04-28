@extends('layouts.main')

@section('title')
    <title>Item & Stok - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Item & Stok</h3>
                    <p class="text-subtitle text-muted">Halaman ini memuat data stok</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Item & Stok</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Tambah Item Baru
                    </h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('items.store') }}" method="POST" id="items">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Kode Barang</label>
                                </div>
                                <div class="col-md-9 form-group">
                                    <input type="text" id="barcode" class="form-control" name="barcode"
                                        placeholder="Kode Barang" minlength="10" maxlength="10"
                                        value="{{ old('barcode') }}" required>
                                    @error('barcode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>Nama Barang</label>
                                </div>
                                <div class="col-md-9 form-group">
                                    <input type="text" id="nama_barang" class="form-control" name="nama_barang"
                                        placeholder="Nama Barang" value="{{ old('nama_barang') }}" required>
                                    @error('nama_barang')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>Harga</label>
                                </div>
                                <div class="col-md-9 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" id="harga" class="form-control separator" name="harga"
                                            placeholder="0" value="{{ old('harga') }}" oninput="formatNumber(this)"
                                            required>
                                    </div>
                                    @error('harga')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-outline-primary me-1 mb-1"><i class="fas fa-plus-circle"></i> Tambah Item</button>
                                    <button type="reset" class="btn btn-outline-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </section>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            Tambah Data Stok
                        </h4>
                        <div class="align-self-center">
                            <!-- Button trigger for scrolling content modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalScrollable"><i class="fas fa-plus-circle"></i>
                                Tambah Stock
                            </button>

                            <!--scrolling content Modal -->
                            <form action="{{ route('stock.store') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content" style="height: 600px; width: 800px">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Form Penambahan
                                                    Item</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body pilih">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <h6>Kode - Nama Barang</h6>
                                                        <div class="form-group">
                                                            <select class="choices form-select" name="items_id[]">
                                                                @foreach ($stock as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->barcode }} -
                                                                        {{ $item->nama_barang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('items_id[]')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <h6>Jumlah</h6>
                                                        <div class="form-group">
                                                            <input class="form-control" type="number" name="jumlah[]"
                                                                id="jumlah" min="0"
                                                                value="{{ old('jumlah') }}">
                                                            @error('jumlah[]')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <h6>Aksi</h6>
                                                        <!-- Button to add new item -->
                                                        <button type="button" class="btn btn-outline-success"
                                                            id="btnAddItem">
                                                            <i class="fas fa-plus-circle"></i> Tambah Item
                                                        </button>
                                                    </div>
                                                </div>

                                                <div id="dynamicFormItemContainer"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Tutup</span>
                                                </button>
                                                <button type="submit" class="btn btn-outline-primary ml-1"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Simpan</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Category</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stock as $key => $item)
                                {{-- @dd($item->item) --}}
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->barcode }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->category->nama_kategori }}</td>
                                    <td class="text-end">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ $item->stocks->jumlah }}</td>
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
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js "></script>


    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data anda berhasil disimpan',
            })
        </script>
    @endif
    {{-- <script>
        $(document).ready(function() {
            // Fungsi format ribuan
            function formatRibuan(angka) {
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }

            // Mengatur input dengan class "separator"
            $('.separator').on('keyup', function() {
                // Menghilangkan karakter selain angka
                var angka = $(this).val().replace(/[^0-9]/g, '');
                // Mengonversi angka menjadi format ribuan
                var ribuan = formatRibuan(angka);
                // Memasukkan angka yang telah diformat kembali ke input
                $(this).val(ribuan);
            });
        });
    </script> --}}
    <script>
        const inputHarga = document.getElementById('harga');

        inputHarga.addEventListener('input', function(e) {
            // Menghapus karakter selain angka
            let nilaiInput = this.value.replace(/[^0-9]/g, '');

            // Menambahkan pemisah ribuan setiap 3 digit
            nilaiInput = formatNumber(nilaiInput);

            // Mengembalikan nilai input yang sudah diolah
            this.value = nilaiInput;
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        const form = document.getElementById('items');

        form.addEventListener('submit', function(e) {
            const inputHarga = document.getElementById('harga');

            // Menghapus tanda koma sebelum submit
            inputHarga.value = inputHarga.value.replace(/\D/g, '');
        });
    </script>


    <script>
        $(document).ready(function() {
            var addButton = $("#btnAddItem");
            var wrapper = $("#dynamicFormItemContainer");
            var fieldHTML =
                '<div class="row dynamic-form-item"><div class="col-md-6 mb-4"><div class="form-group"><select class="choices form-select" name="items_id[]">@foreach ($stock as $item)<option value="{{ $item->id }}">{{ $item->barcode }} - {{ $item->nama_barang }}</option>@endforeach</select></div></div><div class="col-md-3 mb-4"><div class="form-group"><input class="form-control" type="number" name="jumlah[]" id="jumlah" min="0" ></div></div><div class="col-md-3 mb-4"><button type="button" class="btn btn-outline-danger btnRemoveItem"><i class="fas fa-trash"></i> Hapus Item</button></div></div>';

            // Add button dynamically
            $(addButton).click(function() {
                $(wrapper).append(fieldHTML);
            });

            // Remove button dynamically
            $(wrapper).on("click", ".btnRemoveItem", function(e) {
                e.preventDefault();
                $(this).parents(".dynamic-form-item").remove();

                // Show add button when there are no items left
                if ($(".dynamic-form-item").length == 0) {
                    $(addButton).show();
                }
            });

            // Hide add button when a new item is added
            $(wrapper).on("click", ".btnAddItem", function() {
                $(addButton).hide();
            });
        });
    </script>
@endpush
