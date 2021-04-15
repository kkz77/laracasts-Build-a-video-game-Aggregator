<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];
    public function loadMostAnticipated()
    {
        $current = Carbon::now()->timestamp;
        $this->mostAnticipated = Cache::remember('most-anticipated', 1200, function () use($current) {
            return  Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date ,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug,summary,aggregated_rating;
                  where platforms = {6,48,130,49}
                  & first_release_date >= {$current};
                  sort aggregated_rating;
                  limit 4;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json();
        });
    }

    public function render()
    {

        return view('livewire.most-anticipated');
    }
}
