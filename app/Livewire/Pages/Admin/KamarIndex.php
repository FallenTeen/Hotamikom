<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Kamar;
use Livewire\Component;
use Livewire\WithPagination;

class KamarIndex extends Component
{
    use WithPagination;

    public $cari = '', $sort = 'nomor_kamar', $direction = 'asc';

    protected $queryString = [
        'cari' => ['except' => ''],
        'sort' => ['except' => 'nomor_kamar'],
        'direction' => ['except' => 'asc'],
    ];

    public function updatePencarian()
    {
        $this->resetPage();
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

    public function delete($id)
    {
        $kamar = Kamar::find($id);

        if ($kamar) {
            $kamar->delete();
            session()->flash('message', 'Data berhasil dihapus');
        } else {
            session()->flash('error', 'Kamar tidak ditemukan');
        }

        return redirect()->route('managekamar');
    }

    public function editKamar($id)
    {
        // $kamar = Kamar::find($id);
        // dd($kamar);
        return redirect()->route('editkamar', $id);
    }

    public function render()
    {
        $kamar = Kamar::query()
            ->when($this->cari, function ($query) {
                $query->where('nomor_kamar', 'like', "%{$this->cari}%")
                    ->orWhere('tipe_kamar', 'like', "%{$this->cari}%");
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(6);

        return view('livewire.pages.admin.kamar-index', [
            'kamar' => $kamar,
            'tipeKamars' => Kamar::select('tipe_kamar')->distinct()->pluck('tipe_kamar'),
        ])->layout('layouts.admin');
    }
}
