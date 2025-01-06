<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Reservasi;
use App\Models\LayananHotel;
use Illuminate\Support\Facades\Session;

class ReservasiIndex extends Component
{
    public $cari = '', $sort = 'tgl_checkin', $direction = 'asc';
    public $showCreateModal = false, $showEditModal = false;
    public $nama_layanan, $harga_layanan, $tgl_layanan, $selectedLayananId, $layanan;

    protected $queryString = [
        'cari' => ['except' => ''],
        'sort' => ['except' => 'tgl_checkin'],
        'direction' => ['except' => 'asc'],
    ];

    public function createRsv()
    {
        return redirect()->route('createreservasi');
    }
    public function editRsv($id)
    {
        return redirect()->route('editreservasi', $id);
    }
    public function delete($id)
    {

        $reservasi = Reservasi::find($id);

        if ($reservasi) {
            $reservasi->layanan()->detach();
            $reservasi->delete();
            session()->flash('message', 'Reservasi berhasil dihapus.');
            $this->dispatch('refreshReservasiTable');
        } else {
            session()->flash('error', 'Reservasi tidak ditemukan.');
        }
    }

    public function sortBy($field)
    {
        if ($this->sort == $field) {
            $this->direction = $this->direction == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $field;
            $this->direction = 'asc';
        }
    }

    public function render()
    {
        $reservasis = Reservasi::with(['user', 'kamar', 'layanan', 'pembayaran', 'review'])
            ->orderBy($this->sort, $this->direction)
            ->paginate(6);
        foreach ($reservasis as $rsv) {
            $checkin = \Carbon\Carbon::parse($rsv->tgl_checkin);
            $checkout = \Carbon\Carbon::parse($rsv->tgl_checkout);

            if ($checkin->gt($checkout)) {
                $jumlah_malam = 0;
            } else {
                $jumlah_malam = $checkin->diffInDays($checkout);
            }

            $harga_kamar = max($rsv->kamar->harga_per_malam * $jumlah_malam, 0);
            $total_layanan = $rsv->layanan->sum(function ($layanan) {
                return max($layanan->harga_layanan, 0);
            });

            $total_tagihan = $harga_kamar + $total_layanan;

            $rsv->total_tagihan = max($total_tagihan, 0);
        }

        $layanans = LayananHotel::all();

        return view('livewire.pages.admin.reservasi-index', compact('reservasis', 'layanans'))->layout('layouts.admin');
    }


}
