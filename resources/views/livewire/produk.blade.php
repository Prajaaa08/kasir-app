<div>
    <div class="container">
        <!-- Menu Tombol -->
        <div class="row my-3">
            <div class="col-12 d-flex flex-wrap gap-3 justify-content-center">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }} px-4 py-2 d-flex align-items-center gap-2">
                    <i class="fas fa-box-open"></i> Semua Produk
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }} px-4 py-2 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Tambah Produk
                </button>
                <button wire:click="pilihMenu('excel')"
                    class="btn {{ $pilihanMenu == 'excel' ? 'btn-primary' : 'btn-outline-primary' }} px-4 py-2 d-flex align-items-center gap-2">
                    <i class="fas fa-file-import"></i> Import Produk
                </button>
                <button wire:loading class="btn btn-info px-4 py-2">
                    <i class="fas fa-spinner fa-spin"></i> Loading...
                </button>
            </div>
        </div>
        <!-- Konten Dinamis -->
        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu == 'lihat')
                    <div class="card border-primary shadow-sm rounded">
                        <div class="card-header fw-bold">📦 Semua Produk</div>
                        <div class="card-body">
                            {{-- <livewire:search-bar /> --}}
                            {{-- @livewire('search-bar') --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaProduk as $produk)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $produk->kode }}</td>
                                                <td>{{ $produk->nama }}</td>
                                                <td class="text-end">Rp.
                                                    {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                                <td class="text-center">{{ $produk->stok }}</td>
                                                <td>
                                                    <div class="d-flex gap-2 flex-wrap">
                                                        <button wire:click="pilihEdit({{ $produk->id }})"
                                                            class="btn btn-sm btn-outline-warning">
                                                            <i class="fas fa-pencil-alt"></i> Edit
                                                        </button>
                                                        <button wire:click="pilihHapus({{ $produk->id }})"
                                                            class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif(in_array($pilihanMenu, ['tambah', 'edit']))
                    <div class="card border-primary shadow-sm rounded">
                        <div class="card-header fw-bold">
                            {{ $pilihanMenu == 'tambah' ? '➕ Tambah Produk' : '✏️ Edit Produk' }}</div>
                        <div class="card-body">
                            <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}">
                                @foreach (['nama' => 'Nama', 'kode' => 'Kode / Barcode', 'harga' => 'Harga', 'stok' => 'Stok'] as $field => $label)
                                    <div class="mb-3">
                                        <label class="form-label">{{ $label }}</label>
                                        <input type="{{ $field === 'harga' || $field === 'stok' ? 'number' : 'text' }}"
                                            class="form-control" wire:model="{{ $field }}">
                                        @error($field)
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-outline-success mt-2">
                                    <i class="fa-regular fa-floppy-disk"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'hapus')
                    <div class="card border-danger shadow-sm rounded">
                        <div class="card-header bg-danger text-white fw-bold">⚠️ Konfirmasi Hapus</div>
                        <div class="card-body">
                            <p>Anda yakin ingin menghapus produk ini?</p>
                            <ul>
                                <li><strong>Nama:</strong> {{ $produkTerpilih->nama }}</li>
                                <li><strong>Kode:</strong> {{ $produkTerpilih->kode }}</li>
                            </ul>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-danger" wire:click='hapus'>
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                                <button class="btn btn-outline-secondary" wire:click='batal'>
                                    <i class="fas fa-times"></i> Batal
                                </button>
                            </div>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'excel')
                    <div class="card border-success shadow-sm rounded">
                        <div class="card-header bg-success text-white fw-bold">📥 Import Produk (Excel)</div>
                        <div class="card-body">
                            <form wire:submit.prevent='imporExcel'>
                                <input type="file" class="form-control" wire:model="fileExcel" />
                                @error('fileExcel')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <button class="btn btn-outline-success mt-3" type="submit">
                                    <i class="fas fa-upload"></i> Kirim
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('simpan-produk', (pesan) => {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: pesan,
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>

<script>
    Livewire.on('hapus-produk', (pesan) => {
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: pesan,
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
