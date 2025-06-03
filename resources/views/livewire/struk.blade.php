<div class="container mt-4" style="max-width: 400px; font-family: 'Courier New', Courier, monospace;">
    <div class="border rounded-3 shadow-sm p-3">
        <h5 class="text-center fw-bold">TOKO KASIRKU</h5>
        <p class="text-center mb-0">Jl. Contoh No.123, Indonesia</p>
        <p class="text-center mb-3">Telp: 0812-3456-7890</p>

        <hr class="my-2">

        <div class="d-flex justify-content-between">
            <span><strong>Invoice:</strong> {{ $transaksi->kode }}</span>
            <span>{{ $transaksi->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <hr class="my-2">

        <table class="table table-borderless table-sm mb-2">
            <thead>
                <tr class="border-bottom">
                    <th>Barang</th>
                    <th class="text-end">Harga</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detailTransaksi as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td class="text-end">{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-end">{{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="my-2">

        <div class="d-flex justify-content-between">
            <span>Total</span>
            <span><strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></span>
        </div>
        <div class="d-flex justify-content-between">
            <span>Bayar</span>
            <span>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Kembalian</span>
            <span>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
        </div>

        <hr class="my-2">

        <p class="text-center fst-italic mb-0">Terima kasih sudah berbelanja!</p>
        <p class="text-center">- TokoKasirku -</p>
    </div>
</div>
