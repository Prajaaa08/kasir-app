<div>
    <div class="container">
        <!-- Tombol Transaksi Baru / Batalkan Transaksi -->
        <div class="row my-3">
            <div class="col-12 d-flex flex-wrap gap-2 justify-content-center">
                @if (!$transaksiAktif)
                    <button class="btn btn-primary shadow-sm py-2 px-4 rounded-3" wire:click='transaksiBaru'>
                        <i class="fa-solid fa-cart-plus"></i> Transaksi Baru
                    </button>
                @else
                    <button class="btn btn-danger shadow-sm py-2 px-4 rounded-3" wire:click='batalTransaksi'>
                        <i class="bi bi-x-circle me-2"></i> Batalkan Transaksi
                    </button>
                @endif
                <button class="btn btn-info shadow-sm py-2 px-4 rounded-3" wire:loading>
                    <i class="fas fa-spinner fa-spin"></i> Loading...
                </button>
            </div>
        </div>

        @if (!$transaksiAktif)
            <div class="text-center mt-5">
                <img src="https://cdn-icons-png.flaticon.com/512/891/891419.png" width="120" alt="Waiting Icon"
                    class="mb-3 opacity-75">
                <h4 class="text-muted fw-semibold">Belum ada transaksi aktif</h4>
                <p class="text-secondary fs-6">Silakan klik tombol <strong>"Transaksi Baru"</strong> di atas untuk memulai proses transaksi.</p>
            </div>
        @endif

        @if ($transaksiAktif)
            <div class="row mt-4">
                <!-- Bagian Kiri (Daftar Produk) -->
                <div class="col-12 col-lg-8 mb-4">
                    <div class="card border-primary shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="card-title mb-3"><i class="fa-solid fa-file-invoice"></i> No Invoice: <strong>{{ $transaksiAktif->kode }}</strong></h4>
                            <input type="text" class="form-control mb-3 rounded-3 shadow-sm"
                                placeholder="Masukkan kode invoice" wire:model.live='kode'>

                            <div class="table-responsive rounded-3 shadow-sm border">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-primary text-center align-middle">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaProduk as $produk)
                                            <tr>
                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $produk->produk->nama }}</td>
                                                <td class="text-end align-middle">Rp. {{ number_format($produk->produk->harga, 2, '.', ',') }}</td>
                                                <td class="text-center align-middle">{{ $produk->jumlah }}</td>
                                                <td class="text-end align-middle">Rp. {{ number_format($produk->produk->harga * $produk->jumlah, 2, '.', ',') }}</td>
                                                <td class="text-center align-middle">
                                                    <button wire:click="hapusProduk({{ $produk->id }})"
                                                        class="btn btn-danger btn-sm shadow-sm "
                                                        title="Hapus Produk">
                                                        <i class="bi bi-trash"></i>Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan (Total, Bayar, Kembalian) -->
                <div class="col-12 col-lg-4">
                    <!-- Total Biaya -->
                    <div class="card border-primary shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold mb-3">Total Biaya</h5>
                            <div class="d-flex justify-content-between fs-5 fw-semibold text-secondary">
                                <span>Rp.</span>
                                <span>{{ number_format($totalSemuaBelanja, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bayar -->
                    <div class="card border-primary shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold mb-3">Bayar</h5>
                            <input type="number" class="form-control rounded-3 shadow-sm fs-6"
                                placeholder="Masukkan jumlah bayar" wire:model.live='bayar' min="0" step="any">
                        </div>
                    </div>

                    <!-- Kembalian -->
                    <div class="card border-primary shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold mb-3">Kembalian</h5>
                            <div class="d-flex justify-content-between fs-5 fw-semibold text-secondary">
                                <span>Rp.</span>
                                <span>{{ number_format($kembalian, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Bayar atau Pesan Error -->
                    <div class="mt-3">
                        @if ($bayar)
                            @if ($kembalian < 0)
                                <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 shadow-sm border-0 rounded-3" role="alert">
                                    <i class="bi bi-exclamation-circle-fill fs-5"></i>
                                    <span class="fw-semibold">Jumlah bayar kurang. Mohon isi dengan benar.</span>
                                </div>
                            @elseif ($kembalian >= 0)
                                <button wire:click='transaksiSelesai'
                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2 py-3 fw-semibold shadow-sm rounded-3"
                                    style="transition: all 0.25s ease-in-out;">
                                    <i class="bi bi-cash-coin fs-5"></i>
                                     Bayar Sekarang
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('transaksi-selesai', (pesan) => {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: pesan,
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>