<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\LayananHotel;

class LayananIndex extends Component
{
    public $cari = '', $sort = 'nama_layanan', $direction = 'asc';
    public $layananId, $layanan;

    protected $queryString = [
        'cari' => ['except' => ''],
        'sort' => ['except' => 'nama_layanan'],
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
        $layanan = LayananHotel::find($id);

        if ($layanan) {
            $layanan->delete();
            session()->flash('message', 'Data berhasil dihapus');
        } else {
            session()->flash('error', 'Layanan tidak ditemukan');
        }

        return redirect()->route('layanan');
    }
    public function render()
    {
        $layanan = LayananHotel::query()
            ->when($this->cari, function ($query) {
                $query->where('nama_layanan', 'like', "%{$this->cari}%")
                    ->orWhere('harga_layanan', 'like', "%{$this->cari}%");
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(5);

        return view('livewire.pages.admin.layanan-index', [
            'layanans' => $layanan,
        ])->layout('layouts.admin');
    }

}
