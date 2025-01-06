<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class KamarDisplay extends Component
{
    public $jumlah_display, $rekomendasi, $displayKamars = [];

    public function redirectToReservation($id)
    {
        return Redirect::route('res', ['id' => $id]);
    }
    public function mount($jumlah_display = 1, $rekomendasi = 'random')
    {
        $this->jumlah_display = $jumlah_display;
        $this->rekomendasi = $rekomendasi;

        $this->prepareDisplay();
    }

    private function prepareDisplay()
    {
        $tipeKamar = ['vip', 'reguler', 'suite'];
        $todaySeed = Carbon::now()->format('Ymd'); // Seed berdasarkan tanggal
        srand($todaySeed); // Acak dengan seed stabil per hari

        foreach ($tipeKamar as $tipe) {
            $query = Kamar::query()->where('tipe_kamar', $tipe);

            // Filter berdasarkan rekomendasi
            if ($this->rekomendasi === 'aktif') {
                $query->where('rekomendasi', true);
            } elseif ($this->rekomendasi === 'tidak aktif') {
                $query->where('rekomendasi', false);
            }

            $kamars = $query->inRandomOrder()->get();

            if ($kamars->isEmpty()) {
                // Jika tidak ada rekomendasi aktif, ambil sembarang data
                $kamars = Kamar::where('tipe_kamar', $tipe)->inRandomOrder()->get();
            }

            // Pilih `jumlah_display` dari tipe kamar
            $this->displayKamars = array_merge(
                $this->displayKamars,
                $kamars->take($this->jumlah_display)->toArray()
            );
        }
    }
    public function render()
    {
        return view('livewire.kamar-display', [
            'kamars' => $this->displayKamars,
        ]);
    }
}
