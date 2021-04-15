<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingSoon extends Component
{
    public $comingSoon=[];
    public function loadComingSoon()
    {
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $this->comingSoon = Cache::remember('coming-soon', 3 , function () use ($afterFourMonths) {
            return  Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date, cover.url ;
                where platforms = {6,48,130,49}
                & first_release_date >= {$afterFourMonths};
                sort first_release_date asc;
                limit 4;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json();
        });
    }
    public function render()
    {
        return view('livewire.coming-soon');
    }
}
