<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;

class Produk extends Component
{
    public $pilihanMenu = "lihat";
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;

    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = "edit";
    }
    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'kode', 'unique:produks,kode,' . $this->produkTerpilih->id],
            'harga' => 'required',
            'stok' => 'nullable|min:6'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'kode.required' => 'Email tidak boleh kosong',
            'kode.kode' => 'Format kode tidak valid',
            'kode.unique' => 'Email sudah terdaftar',
            'harga.required' => 'Peran tidak boleh kosong',
            'stok.min' => 'stok minimal 6 karakter'
        ]);
        $simpan = $this->produkTerpilih;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        if ($this->stok) {
            $simpan->stok = bcrypt($this->stok);
        }
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kode', 'stok', 'harga', 'produkTerpilih']);
        $this->pilihanMenu = "lihat";
        session()->flash('pesan', 'Data berhasil disimpan');
    }
    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = "hapus";
    }
    public function batal()
    {
        $this->reset();
    }
    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->pilihanMenu = "lihat";
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode'],
            'harga' => 'required',
            'stok' => 'required'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.unique' => 'Kode sudah terdaftar',
            'harga.required' => 'Harga tidak boleh kosong',
            'stok.required' => 'Stok tidak boleh kosong'
        ]);

        $simpan = new ModelProduk();
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kode', 'stok', 'harga']);
        $this->pilihanMenu = "lihat";
        session()->flash('pesan', 'Data berhasil disimpan');
    }
    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }
    public function render()
    {
        return view('livewire.produk')->with([
            'semuaProduk' => ModelProduk::all()
        ]);
    }
}
