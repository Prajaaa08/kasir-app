<div>

    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua produk
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Tambah produk
                </button>
                <button wire:loading class="btn btn-info">
                    Loading...
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu == 'lihat')
                    <div class="card border-primary">
                        <div class="card-header">
                            Semua produk
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Data</th>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk->kode }}</td>
                                            <td>{{ $produk->nama }}</td>
                                            <td>{{ $produk->harga }}</td>
                                            <td>{{ $produk->stok }}</td>
                                            <td>
                                                <button wire:click="pilihEdit({{ $produk->id }})"
                                                    class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-warning' }} ">
                                                    Edit
                                                </button>
                                                <button wire:click="pilihHapus({{ $produk->id }})"
                                                    class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-danger' }} ">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card border-primary">
                        <div class="card-header">
                            Tambah produk
                        </div>
                        <div class="card-body">
                            <form action="" wire:submit="simpan">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" wire:model="nama" />
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="" class="mt-2">Kode / Barcode</label>
                                <input type="string" class="form-control" wire:model="kode" />
                                @error('kode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="" class="mt-2">Harga</label>
                                <input type="number" class="form-control" wire:model="harga" />
                                @error('harga')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="" class="mt-2">Stok</label>
                                <input type="number" class="form-control" wire:model="stok" />
                                @error('stok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-outline-success mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit produk
                        </div>
                        <div class="card-body">
                            <form action="" wire:submit="simpanEdit">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" wire:model="nama" />
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="" class="mt-2">Email</label>
                                <input type="email" class="form-control" wire:model="email" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="" class="mt-2">Password</label>
                                <input type="password" class="form-control" wire:model="password" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="" class="mt-2">Peran</label>
                                <select name="" id="" class="form-control" wire:model='peran'>
                                    <option>Pilih Peran</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                                @error('peran')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-outline-success mt-4">Simpan</button>
                                <button type="button" wire:click='batal'
                                    class="btn btn-outline-secondary mt-4">Batal</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus produk
                        </div>
                        <div class="card-body">
                            Anda yakin ingin menghapus produk ini?
                            <br>
                            <p>Nama : {{ $produkTerpilih->nama }}</p>
                            <p>Kode : {{ $produkTerpilih->kode }}</p>
                            <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn-secondary" wire:click='batal'>Batal</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>
