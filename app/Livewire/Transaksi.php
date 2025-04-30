<?php

namespace App\Livewire;
use App\Models\DetilTransaksi;
use App\Models\Produk;
use App\Models\Transaksi as ModelTransaksi;
use Livewire\Component;

class Transaksi extends Component
{
    public $kode, $total, $status, $bayar, $kembalian, $totalSemuaBelanja;
    public $transaksiAktif;

    public function transaksiBaru()
    {
        $this->reset();
        $this->transaksiAktif = new ModelTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }

    public function batalTransaksi()
    {
        if ($this->transaksiAktif) {
            $detilTransaksi = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil) {
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset();
    }

    public function updatedKode()
    {
        $produk = Produk::where('kode', $this->kode)->first();
        if ($produk && $produk->stok > 0) {
            $detil = DetilTransaksi::firstOrNew(
                ['transaksi_id' => $this->transaksiAktif->id, 'produk_id' => $produk->id],
                ['jumlah' => 0]
            );
            $detil->jumlah += 1;
            $detil->save();
            $this->reset('kode');
        }
    }
    public function render()
    {
        if ($this->transaksiAktif) {
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
        } else {
            $semuaProduk = [];
        }

        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }
}
