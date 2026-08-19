<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Publication;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] // Menggunakan layout bawaan Breeze
class PublicationManager extends Component
{
    public $publications, $judul, $penulis, $deskripsi, $link_jurnal, $pub_id;
    public $isEdit = false;
    public $showModal = false; // New property for modal state

    public function render()
    {
        // Mengambil semua data publikasi terbaru
        $this->publications = Publication::latest()->get();
        return view('livewire.admin.publication-manager');
    }

    public function create()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function resetFields()
    {
        $this->judul = '';
        $this->penulis = '';
        $this->deskripsi = '';
        $this->link_jurnal = '';
        $this->pub_id = null;
        $this->isEdit = false;
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'deskripsi' => 'required',
            'link_jurnal' => 'required|url',
        ]);

        Publication::create([
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'deskripsi' => $this->deskripsi,
            'link_jurnal' => $this->link_jurnal,
        ]);

        session()->flash('message', 'Data Publikasi berhasil ditambahkan!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $pub = Publication::findOrFail($id);
        $this->pub_id = $pub->id;
        $this->judul = $pub->judul;
        $this->penulis = $pub->penulis;
        $this->deskripsi = $pub->deskripsi;
        $this->link_jurnal = $pub->link_jurnal;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'deskripsi' => 'required',
            'link_jurnal' => 'required|url',
        ]);

        if ($this->pub_id) {
            $pub = Publication::find($this->pub_id);
            $pub->update([
                'judul' => $this->judul,
                'penulis' => $this->penulis,
                'deskripsi' => $this->deskripsi,
                'link_jurnal' => $this->link_jurnal,
            ]);
            session()->flash('message', 'Data Publikasi berhasil diubah!');
            $this->resetFields();
        }
    }

    public function delete($id)
    {
        Publication::find($id)->delete();
        session()->flash('message', 'Data Publikasi berhasil dihapus!');
    }
}