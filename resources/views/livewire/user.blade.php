<div>
    <div class="container">
        <div class="row my-4">
            <div class="col-12 d-flex flex-wrap gap-3 justify-content-center">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }} px-4 py-2  align-items-center gap-2">
                    <i class="fa-solid fa-users"></i> Semua Pengguna
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }} px-4 py-2  align-items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Tambah Pengguna
                </button>
                <button wire:loading class="btn btn-info mx-2 py-2 px-4">
                    <i class="fas fa-spinner fa-spin"></i> Loading...
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu == 'lihat')
                    <div class="card border-primary shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fa-solid fa-users-line"></i> Semua Pengguna
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Peran</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaPengguna as $pengguna)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengguna->name }}</td>
                                                <td>{{ $pengguna->email }}</td>
                                                <td>{{ $pengguna->peran }}</td>
                                                <td>
                                                    <button wire:click="pilihEdit({{ $pengguna->id }})"
                                                        class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-warning' }} btn-sm">
                                                        <i class="fa-solid fa-users-gear"></i> Edit
                                                    </button>
                                                    <button wire:click="pilihHapus({{ $pengguna->id }})"
                                                        class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-danger' }} btn-sm">
                                                        <i class="fa-solid fa-user-minus"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card border-primary shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fa-solid fa-plus"></i> Tambah Pengguna
                        </div>
                        <div class="card-body">
                            <form action="" wire:submit="simpan">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" class="form-control" wire:model="nama" />
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model="email" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" wire:model="password" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Peran</label>
                                    <select name="" id="" class="form-control" wire:model='peran'>
                                        <option>Pilih Peran</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-outline-success mt-3"><i
                                        class="fa-regular fa-floppy-disk"></i> Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'edit')
                    <div class="card border-primary shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            Edit Pengguna
                        </div>
                        <div class="card-body">
                            <form action="" wire:submit="simpanEdit">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" class="form-control" wire:model="nama" />
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model="email" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" wire:model="password" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Peran</label>
                                    <select name="" id="" class="form-control" wire:model='peran'>
                                        <option>Pilih Peran</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-outline-success mt-3"><i
                                        class="fa-regular fa-floppy-disk"></i> Simpan</button>
                                <button type="button" wire:click='batal' class="btn btn-outline-secondary mt-3"><i
                                        class="fas fa-times"></i>Batal</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-danger shadow-sm mb-4">
                        <div class="card-header bg-danger text-white">
                            Hapus Pengguna
                        </div>
                        <div class="card-body">
                            <p>Anda yakin ingin menghapus pengguna ini?</p>
                            <p><strong>Nama:</strong> {{ $penggunaTerpilih->name }}</p>
                            <button class="btn btn-outline-danger" wire:click='hapus'><i
                                    class="fa-solid fa-user-minus"></i> Hapus</button>
                            <button class="btn btn-outline-secondary" wire:click='batal'><i class="fas fa-times"></i>
                                Batal</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
