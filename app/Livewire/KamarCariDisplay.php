<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kamar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KamarCariDisplay extends Component
{
    public $tgl_checkin, $tgl_checkout, $tipe_kamar, $kapasitas, $kamars = [];

    public function mount($tgl_checkin = null, $tgl_checkout = null, $tipe_kamar = null, $kapasitas = null)
    {
        $this->tgl_checkin = $tgl_checkin;
        $this->tgl_checkout = $tgl_checkout;
        $this->tipe_kamar = $tipe_kamar;
        $this->kapasitas = $kapasitas;

        $this->searchKamars();
    }
    public function redirectToReservation($id)
    {
        return Redirect::route('res', ['id' => $id]);
    }
    private function searchKamars()
    {
        $query = Kamar::query();

        if ($this->tipe_kamar) {
            $query->where('tipe_kamar', $this->tipe_kamar);
        }

        if ($this->kapasitas) {
            $query->where('kapasitas', '>=', $this->kapasitas);
        }

        if ($this->tgl_checkin && $this->tgl_checkout) {

            $query->whereDoesntHave('reservasi', function ($subQuery) {
                $subQuery->where(function ($overlapQuery) {
                    $overlapQuery->whereBetween('tgl_checkin', [$this->tgl_checkin, $this->tgl_checkout])
                        ->orWhereBetween('tgl_checkout', [$this->tgl_checkin, $this->tgl_checkout])
                        ->orWhere(function ($overlapQuery2) {
                            $overlapQuery2->where('tgl_checkin', '<=', $this->tgl_checkin)
                                ->where('tgl_checkout', '>=', $this->tgl_checkout);
                        });
                });
            });
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            $this->kamars = $this->applyFallbackFilters();
        } else {
            $this->kamars = $results;
        }
    }

    private function applyFallbackFilters()
    {
        $query = Kamar::query();

        $filtersApplied = false;

        if ($this->tipe_kamar) {
            $query->where('tipe_kamar', $this->tipe_kamar);
            $filtersApplied = true;
        }

        if ($this->kapasitas) {
            $query->where('kapasitas', '>=', $this->kapasitas);
            $filtersApplied = true;
        }

        if (!$filtersApplied) {
            return $query->inRandomOrder()->limit(10)->get();
        } else {
            return $query->limit(10)->get();
        }
    }
    public function render()
    {
        return view('livewire.kamar-cari-display', [
            'kamars' => $this->kamars,
        ]);
    }
}
