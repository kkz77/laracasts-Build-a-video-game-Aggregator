<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PopularGames extends Component
{
    public $popularGames = [];
    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(3)->timestamp;
        $after= Carbon::now()->addMonths(3)->timestamp;
        $this->popularGames= Cache::remember('popular-games',3, function () use ($before,$after) {
            return  Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug;
                  where platforms = (6,48,130,49)
                  & (first_release_date >= {$before}
                  & first_release_date < {$after}
                  & rating > 7);
                  sort rating desc;
                  limit 18;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json();
        });
    }
    public function render()
    {
        return view('livewire.popular-games');
    }
}
