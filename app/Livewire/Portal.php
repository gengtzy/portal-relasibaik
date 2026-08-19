<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Publication; // Sesuaikan dengan model Publikasi-mu
use App\Models\Member;      // Sesuaikan dengan model Member-mu

class Portal extends Component
{
    public function render()
    {
        // Menarik data publikasi terbaru dari database
        $publikasiData = Publication::latest()->get();

        // Menarik data member
        $memberData = Member::all();

        return view('livewire.portal', [
            'publikasiData' => $publikasiData,
            'memberData'    => $memberData
        ]);
    }
}