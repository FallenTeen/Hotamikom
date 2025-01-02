<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Kamar;
use App\Models\LayananHotel;

class ReservasiCreate extends Component
{
    public $id_user;
    public $id_kamar;
    public $tgl_checkin;
    public $tgl_checkout;
    public $total_harga;
    public $status;
    public $id_layanan = [];

    public function store()
    {
        $this->validate([
            'id_user' => 'required|exists:users,id',
            'id_kamar' => 'required|exists:kamar,id',
            'tgl_checkin' => 'required|date',
            'tgl_checkout' => 'required|date',
            'total_harga' => 'required|numeric',
            'status' => 'required|string',
            'id_layanan' => 'required|array',
            'id_layanan.*' => 'exists:layanan_hotel,id',
        ]);

        $reservasi = Reservasi::create([
            'id_user' => $this->id_user,
            'id_kamar' => $this->id_kamar,
            'tgl_checkin' => $this->tgl_checkin,
            'tgl_checkout' => $this->tgl_checkout,
            'total_harga' => $this->total_harga,
            'status' => $this->status,
        ]);

        $reservasi->layanan()->attach($this->id_layanan);

        session()->flash('success', 'Reservasi berhasil ditambahkan');
        return redirect()->route('reservasi');
    }
    public function render()
    {
        $users = User::all();
        $kamar = Kamar::all();
        $layanan = LayananHotel::all();

        return view('livewire.pages.admin.reservasi-create', compact('users', 'kamar', 'layanan'))->layout('layouts.admin');
    }
}
