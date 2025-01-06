<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\LayananHotel;

class LayananIndex extends Component
{
    public $showCreateModal = false, $showEditModal = false, $layanan_id, $nama_layanan, $harga_layanan, $tgl_layanan, $kategori, $deskripsi;
    public $cari = '', $sort = 'nama_layanan', $direction = 'asc';
    protected $queryString = [
        'cari' => ['except' => ''],
        'sort' => ['except' => 'nama_layanan'],
        'direction' => ['except' => 'asc'],
    ];
    protected $rules = [
        'nama_layanan' => 'required|string|max:255',
        'harga_layanan' => 'required|numeric',
        'kategori' => 'required|string|max:255',
        'deskripsi' => 'string|max:255',
        'tgl_layanan' => 'required|date',
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
    public function showCreate()
    {
        $this->resetInputFields();
        $this->showCreateModal = true;
    }

    public function showEdit($id)
    {
        $layanan = LayananHotel::findOrFail($id);
        $this->layanan_id = $layanan->id;
        $this->nama_layanan = $layanan->nama_layanan;
        $this->harga_layanan = $layanan->harga_layanan;
        $this->kategori = $layanan->kategori;
        $this->deskripsi = $layanan->deskripsi;
        $this->tgl_layanan = $layanan->tgl_layanan;

        $this->showEditModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
    }

    public function createLayanan()
    {
        $this->validate();

        LayananHotel::create([
            'nama_layanan' => $this->nama_layanan,
            'harga_layanan' => $this->harga_layanan,
            'kategori' => $this->kategori,
            'deskripsi' => $this->deskripsi,
            'tgl_layanan' => $this->tgl_layanan,
        ]);

        session()->flash('message', 'Layanan created successfully!');
        $this->closeModal();
    }

    public function updateLayanan()
    {
        $this->validate();

        $layanan = LayananHotel::find($this->layanan_id);
        $layanan->update([
            'nama_layanan' => $this->nama_layanan,
            'harga_layanan' => $this->harga_layanan,
            'kategori' => $this->kategori,
            'deskripsi' => $this->deskripsi,
            'tgl_layanan' => $this->tgl_layanan,
        ]);

        session()->flash('message', 'Layanan updated successfully!');
        $this->closeModal();
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
    public function resetInputFields()
    {
        $this->nama_layanan = '';
        $this->harga_layanan = '';
        $this->tgl_layanan = '';
        $this->deskripsi = '';
        $this->kategori = '';
    }

    public function render()
    {
        $layanans = LayananHotel::query()
            ->when($this->cari, function ($query) {
                $query->where('nama_layanan', 'like', "%{$this->cari}%")
                    ->orWhere('kategori', 'like', "%{$this->cari}%")
                    ->orWhere('harga_layanan', 'like', "%{$this->cari}%");
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(6);

        return view('livewire.pages.admin.layanan-index', [
            'layanans' => $layanans,
        ])->layout('layouts.admin');
    }

}
