<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Pembayaran;
use Livewire\WithPagination;

class PembayaranIndex extends Component
{
    use WithPagination;

    public $showCreateModal = false, $showEditModal = false;
    public $pembayaran_id, $id_reservasi, $tgl_pembayaran, $jumlah_pembayaran, $metode_pembayaran, $status_pembayaran;
    public $cari = '', $sort = 'tgl_pembayaran', $direction = 'asc';

    protected $queryString = [
        'cari' => ['except' => ''],
        'sort' => ['except' => 'tgl_pembayaran'],
        'direction' => ['except' => 'asc'],
    ];

    protected $rules = [
        'id_reservasi' => 'required|integer|exists:tbl_reservasi,id',
        'tgl_pembayaran' => 'required|date',
        'jumlah_pembayaran' => 'required|numeric|min:0',
        'metode_pembayaran' => 'required|string|max:255',
        'status_pembayaran' => 'required|in:pending,completed,canceled',
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
        $pembayaran = Pembayaran::findOrFail($id);

        $this->pembayaran_id = $pembayaran->id;
        $this->id_reservasi = $pembayaran->id_reservasi;
        $this->tgl_pembayaran = $pembayaran->tgl_pembayaran;
        $this->jumlah_pembayaran = $pembayaran->jumlah_pembayaran;
        $this->metode_pembayaran = $pembayaran->metode_pembayaran;
        $this->status_pembayaran = $pembayaran->status_pembayaran;

        $this->showEditModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
    }

    public function createPembayaran()
    {
        $this->validate();

        Pembayaran::create([
            'id_reservasi' => $this->id_reservasi,
            'tgl_pembayaran' => $this->tgl_pembayaran,
            'jumlah_pembayaran' => $this->jumlah_pembayaran,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status_pembayaran' => $this->status_pembayaran,
        ]);

        session()->flash('message', 'Pembayaran berhasil dibuat!');
        $this->closeModal();
    }

    public function updatePembayaran()
    {
        $this->validate();

        $pembayaran = Pembayaran::find($this->pembayaran_id);
        $pembayaran->update([
            'id_reservasi' => $this->id_reservasi,
            'tgl_pembayaran' => $this->tgl_pembayaran,
            'jumlah_pembayaran' => $this->jumlah_pembayaran,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status_pembayaran' => $this->status_pembayaran,
        ]);

        session()->flash('message', 'Pembayaran berhasil diperbarui!');
        $this->closeModal();
    }
    public function updateStatus($status, $pembayaranId)
    {
        $pembayaran = Pembayaran::findOrFail($pembayaranId);

        if (!in_array($status, ['pending', 'approved', 'canceled'])) {
            return;
        }

        $pembayaran->update(['status_pembayaran' => $status]);

        sweetalert()->success('Status Pembayaran berhasil diubah');
    }

    public function delete($id)
    {
        $pembayaran = Pembayaran::find($id);

        if ($pembayaran) {
            $pembayaran->delete();
            session()->flash('message', 'Pembayaran berhasil dihapus!');
        } else {
            session()->flash('error', 'Pembayaran tidak ditemukan!');
        }
        sweetalert()->success('Data berhasil dihapus');
        return redirect()->route('pembayaran');
    }

    public function resetInputFields()
    {
        $this->id_reservasi = '';
        $this->tgl_pembayaran = '';
        $this->jumlah_pembayaran = '';
        $this->metode_pembayaran = '';
        $this->status_pembayaran = '';
    }

    public function render()
    {
        $pembayarans = Pembayaran::query()
            ->when($this->cari, function ($query) {
                $query->where('metode_pembayaran', 'like', "%{$this->cari}%")
                    ->orWhere('status_pembayaran', 'like', "%{$this->cari}%")
                    ->orWhere('jumlah_pembayaran', 'like', "%{$this->cari}%");
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(6);

        return view('livewire.pages.admin.pembayaran-index', [
            'pembayarans' => $pembayarans,
        ])->layout('layouts.admin');
    }
}
