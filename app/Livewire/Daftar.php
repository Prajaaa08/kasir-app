<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;


class Daftar extends Component
{
    public $nama, $email, $password, $peran;

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'peran' => 'required',
            'password' => 'required|min:6'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'peran.required' => 'Peran tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $simpan = new ModelUser();
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        $simpan->password = bcrypt($this->password);
        $simpan->peran = $this->peran;
        $simpan->save();

        $this->reset(['nama', 'email', 'password', 'peran']);
        $this->pilihanMenu = "lihat";
        session()->flash('pesan', 'Data berhasil disimpan');
        $this->reset(); // reset field form
        // $this->emit('toggleToLogin');
        return redirect()->to('/login');

    }

    public function render()
    {
        return view('livewire.daftar');
    }
}
