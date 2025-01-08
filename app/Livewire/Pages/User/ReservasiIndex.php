<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use App\Models\Reservasi;
use App\Models\Review;
use Carbon\Carbon;

class ReservasiIndex extends Component
{
    public $reservasi;
    public $selectedReservasiId;
    public $rating;
    public $komentar;

    public function mount()
    {
        $this->reservasi = Reservasi::where('id_user', auth()->id())
            ->with('kamar', 'layanan', 'pembayaran')
            ->get();
    }

    public function openReviewModal($reservasiId)
    {
        $this->selectedReservasiId = $reservasiId;
    }

    public function closeReviewModal()
    {
        $this->selectedReservasiId = null;
        $this->rating = null;
        $this->komentar = null;
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255',
        ]);

        Review::create([
            'id_user' => auth()->id(),
            'id_reservasi' => $this->selectedReservasiId,
            'rating' => $this->rating,
            'komentar' => $this->komentar,
            'tgl_review' => Carbon::now(),
        ]);

        session()->flash('message', 'Review berhasil ditambahkan.');
        $this->closeReviewModal();
        $this->mount(); // Reload data
    }

    public function endReservasi($reservasiId)
    {
        $reservasi = Reservasi::findOrFail($reservasiId);
        if ($reservasi->tgl_checkout) {
            $reservasi->status = 'completed';
            $reservasi->save();
        } else {
            $reservasi->tgl_checkout = Carbon::now();
            $reservasi->save();
            session()->flash('message', 'Reservasi berhasil diakhiri.');
        }
        $this->mount();
    }

    public function render()
    {
        return view('livewire.pages.user.reservasi-index')->layout('layouts.user');
    }
}
