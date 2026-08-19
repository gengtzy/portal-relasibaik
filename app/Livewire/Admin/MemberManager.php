<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Member;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class MemberManager extends Component
{
    use WithFileUploads;

    public $members, $nama, $nidn, $kampus, $foto, $member_id;
    public $jurnals = []; // Array untuk menyimpan daftar jurnal secara dinamis
    public $isEdit = false;
    public $showModal = false;

    public function render()
    {
        $this->members = Member::latest()->get();
        return view('livewire.admin.member-manager');
    }

    public function create()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function addJurnal()
    {
        $this->jurnals[] = ['judul' => '', 'deskripsi' => '', 'link_jurnal' => ''];
    }

    public function removeJurnal($index)
    {
        unset($this->jurnals[$index]);
        $this->jurnals = array_values($this->jurnals); // reindex array
    }

    public function resetFields()
    {
        $this->nama = '';
        $this->nidn = '';
        $this->kampus = '';
        $this->foto = '';
        $this->jurnals = [];
        $this->member_id = null;
        $this->isEdit = false;
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'kampus' => 'required',
            'foto' => 'nullable|image|max:2048', // max 2MB
            'jurnals.*.judul' => 'required', // validasi jika jurnal diisi
            'jurnals.*.link_jurnal' => 'required',
        ]);

        $fotoName = null;
        if ($this->foto) {
            $fotoName = $this->foto->store('members', 'public');
        }

        Member::create([
            'nama' => $this->nama,
            'nidn' => $this->nidn,
            'kampus' => $this->kampus,
            'foto' => $fotoName,
            'jurnals' => $this->jurnals,
        ]);

        session()->flash('message', 'Data Member berhasil ditambahkan!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $this->member_id = $member->id;
        $this->nama = $member->nama;
        $this->nidn = $member->nidn;
        $this->kampus = $member->kampus;
        $this->jurnals = is_array($member->jurnals) ? $member->jurnals : [];
        $this->foto = null; // Reset foto file input
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'kampus' => 'required',
            'foto' => 'nullable|image|max:2048',
            'jurnals.*.judul' => 'required',
            'jurnals.*.link_jurnal' => 'required',
        ]);

        if ($this->member_id) {
            $member = Member::find($this->member_id);
            
            $fotoName = $member->foto;
            if ($this->foto) {
                // Hapus foto lama jika ada
                $fotoName = $this->foto->store('members', 'public');
            }

            $member->update([
                'nama' => $this->nama,
                'nidn' => $this->nidn,
                'kampus' => $this->kampus,
                'foto' => $fotoName,
                'jurnals' => $this->jurnals,
            ]);
            
            session()->flash('message', 'Data Member berhasil diubah!');
            $this->resetFields();
        }
    }

    public function delete($id)
    {
        Member::find($id)->delete();
        session()->flash('message', 'Data Member berhasil dihapus!');
    }
}


