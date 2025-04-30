<div>
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button class="btn btn-primary">Transaksi Baru</button>
                <button class="btn btn-danger">Batalkan Transaksi</button>
                <button class="btn btn-info" wire:loading>Loading ...</button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-8">
                <div class="card border-primary">
                    <div class="card-body">
                        <h4 class="card-title">No Invoice :</h4>
                        <table class="table table-bordered" >
                            <thead>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h4 class="card-title">Total Biaya</h4>
                        <div class="flex justify-content-betweeen">
                            <span>Rp.</span>
                            <span>{{ number_format('9999999',2,'.',',') }}</span>
                        </div>
                    </div>
                </div>
                <div class="card border-primary mt-2">
                    <div class="card-body">
                        <h4 class="card-title">Bayar</h4>
                        <input type="number" class="form-control" placeholder="Masukkan jumlah bayar">
                    </div>
                </div>
                <div class="card border-primary mt-2">
                    <div class="card-body">
                        <h4 class="card-title">Kembalian</h4>
                        <div class="flex justify-content-betweeen">
                            <span>Rp.</span>
                            <span>{{ number_format('9999999',2,'.',',') }}</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success w-100 mt-2">Bayar</button>
            </div>
        </div>
    </div>
</div>
