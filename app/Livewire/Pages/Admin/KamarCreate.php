<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Kamar;
use Livewire\Component;
use Livewire\WithFileUploads;

class KamarCreate extends Component
{
    use WithFileUploads;

    public $nomor_kamar, $tipe_kamar, $harga_per_malam, $kapasitas, $status, $deskripsi;
    public $gambar;

    public function save()
    {
        $this->validate([
            'nomor_kamar' => 'required|string|unique:tbl_kamar,nomor_kamar',
            'tipe_kamar' => 'required|in:vip,reguler',
            'harga_per_malam' => 'required|integer',
            'kapasitas' => 'required|integer',
            'status' => 'required|in:tersedia,terisi',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|max:2048',
        ]);
        $gambarPath = $this->gambar->store('kamar-images', 'public');

        Kamar::create([
            'nomor_kamar' => $this->nomor_kamar,
            'tipe_kamar' => $this->tipe_kamar,
            'harga_per_malam' => $this->harga_per_malam,
            'kapasitas' => $this->kapasitas,
            'status' => $this->status,
            'deskripsi' => $this->deskripsi,
            'gambar' => $gambarPath,
        ]);

        sweetalert()->success('Data Kamar Berhasil Ditambahkan');
        return redirect()->route('managekamar');
    }

    public function render()
    {
        return view('livewire.pages.admin.kamar-create')->layout('layouts.admin');
    }
}
