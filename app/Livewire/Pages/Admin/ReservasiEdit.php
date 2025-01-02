<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Kamar;
use App\Models\LayananHotel;

class ReservasiEdit extends Component
{
    public $reservasi;
    public $id_user;
    public $id_kamar;
    public $tgl_checkin;
    public $tgl_checkout;
    public $total_harga;
    public $status;
    public $id_layanan = [];

    public function mount($id)
    {
        $this->reservasi = Reservasi::findOrFail($id);
        $this->id_user = $this->reservasi->id_user;
        $this->id_kamar = $this->reservasi->id_kamar;
        $this->tgl_checkin = $this->reservasi->tgl_checkin;
        $this->tgl_checkout = $this->reservasi->tgl_checkout;
        $this->total_harga = $this->reservasi->total_harga;
        $this->status = $this->reservasi->status;
        $this->id_layanan = $this->reservasi->layanan->pluck('id')->toArray();
    }

    public function update()
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

        $this->reservasi->update([
            'id_user' => $this->id_user,
            'id_kamar' => $this->id_kamar,
            'tgl_checkin' => $this->tgl_checkin,
            'tgl_checkout' => $this->tgl_checkout,
            'total_harga' => $this->total_harga,
            'status' => $this->status,
        ]);

        $this->reservasi->layanan()->sync($this->id_layanan);

        session()->flash('success', 'Reservasi berhasil diperbarui');
        return redirect()->route('reservasi.index');
    }
    public function render()
    {
        $users = User::all();
        $kamar = Kamar::all();
        $layanan = LayananHotel::all();

        return view('livewire.pages.admin.reservasi-edit', compact('users', 'kamar', 'layanan'))->layout('layouts.admin');
    }
}
