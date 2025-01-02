<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Kamar;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KamarEdit extends Component
{
    use WithFileUploads;

    public $kamarId, $nomor_kamar, $tipe_kamar, $harga_per_malam, $kapasitas, $status, $deskripsi;
    public $gambar, $gambarPreview, $existingGambar, $gambarPath;

    public function mount($id)
    {
        $kamar = Kamar::findOrFail($id);
        $this->kamarId = $kamar->id;
        $this->nomor_kamar = $kamar->nomor_kamar;
        $this->tipe_kamar = $kamar->tipe_kamar;
        $this->harga_per_malam = $kamar->harga_per_malam;
        $this->kapasitas = $kamar->kapasitas;
        $this->status = $kamar->status;
        $this->gambar = $kamar->gambar;
        $this->existingGambar = $this->gambar;
        $this->deskripsi = $kamar->deskripsi;
    }



    public function save()
    {
        $this->validate([
            'nomor_kamar' => 'required|string',
            'tipe_kamar' => 'required|in:vip,reguler',
            'harga_per_malam' => 'required|integer',
            'kapasitas' => 'required|integer',
            'status' => 'required|in:tersedia,terisi',
            'deskripsi' => 'nullable|string',
        ]);
        $validatedData = [
            'nomor_kamar' => $this->nomor_kamar,
            'tipe_kamar' => $this->tipe_kamar,
            'harga_per_malam' => $this->harga_per_malam,
            'kapasitas' => $this->kapasitas,
            'status' => $this->status,
            'deskripsi' => $this->deskripsi,
        ];
        if ($this->gambar instanceof \Illuminate\Http\UploadedFile) {
            $this->validate([
                'gambar' => 'image|max:2048',
            ]);

            if ($this->existingGambar && file_exists(storage_path('app/public/' . $this->existingGambar))) {
                unlink(storage_path('app/public/' . $this->existingGambar));
            }

            $gambarPath = $this->gambar->store('kamar-images', 'public');
            $validatedData['gambar'] = $gambarPath;
        } elseif (!empty($this->existingGambar)) {
            $validatedData['gambar'] = $this->existingGambar;
        }

        Kamar::where('id', $this->kamarId)->update($validatedData);
        sweetalert()->success('Data Berhasil Diubah');
        return redirect()->route('managekamar');
    }




    public function render()
    {
        return view('livewire.pages.admin.kamar-edit')->layout('layouts.admin');
    }
}
