<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kamar;
use App\Models\LayananHotel;
use App\Models\Reservasi;
use App\Models\PivotReservasiLayanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ReservasiCreate extends Component
{
    public $id_kamar;
    public $tgl_checkin;
    public $tgl_checkout;
    public $layanan = [];
    public $total_harga = 0;

    public function mount()
    {
        // Ambil parameter 'id' dari URL
        $this->id_kamar = Request::get('id');

        // Ambil data kamar dari database
        $this->kamars = Kamar::all();
    }

    public function render()
    {
        $kamars = Kamar::all();
        $layanans = LayananHotel::all();

        return view('livewire.reservasi-create', compact('kamars', 'layanans'));
    }

    public function calculateTotal()
    {
        $this->total_harga = 0;

        // Hitung harga kamar berdasarkan tanggal
        $kamar = Kamar::find($this->id_kamar);
        if ($kamar) {
            $days = (strtotime($this->tgl_checkout) - strtotime($this->tgl_checkin)) / (60 * 60 * 24);
            $this->total_harga += $kamar->harga_per_malam * $days;
        }

        // Mengambil harga dari layanan yang dipilih
        if (!empty($this->layanan)) {
            foreach ($this->layanan as $layanan_id) {
                $layanan = LayananHotel::find($layanan_id);
                if ($layanan) {
                    $this->total_harga += $layanan->harga_layanan;
                }
            }
        }
    }


    public function store()
    {
        $this->validate([
            'id_kamar' => 'required|exists:tbl_kamar,id',
            'tgl_checkin' => 'required|date|after_or_equal:today',
            'tgl_checkout' => 'required|date|after:tgl_checkin',
            'layanan' => 'nullable|array',
            'layanan.*' => 'exists:tbl_layanan_hotel,id',
        ]);

        $kamar = Kamar::find($this->id_kamar);
        $days = (strtotime($this->tgl_checkout) - strtotime($this->tgl_checkin)) / (60 * 60 * 24);
        $total_harga = $kamar->harga_per_malam * $days;

        if (!empty($this->layanan)) {
            foreach ($this->layanan as $layanan_id) {
                $layanan = LayananHotel::find($layanan_id);
                $total_harga += $layanan->harga_layanan;
            }
        }

        $reservasi = Reservasi::create([
            'id_user' => Auth::id(),
            'id_kamar' => $this->id_kamar,
            'tgl_checkin' => $this->tgl_checkin,
            'tgl_checkout' => $this->tgl_checkout,
            'total_harga' => $total_harga,
            'status' => 'pending',
        ]);

        if (!empty($this->layanan)) {
            foreach ($this->layanan as $layanan_id) {
                PivotReservasiLayanan::create([
                    'reservasi_id' => $reservasi->id,
                    'layanan_hotel_id' => $layanan_id,
                    'jumlah' => 1,
                ]);
            }
        }

        session()->flash('success', 'Reservasi berhasil dibuat!');
        $this->reset();
    }
}
