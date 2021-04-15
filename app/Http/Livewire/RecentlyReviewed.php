<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];
    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonths(3)->timestamp;
        $current = Carbon::now()->timestamp;
        $this->recentlyReviewed = Cache::remember('recently-reviewed', 3, function () use ($before,$current) {
            return  Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date ,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug,summary;
                  where platforms = (6,48,130,49)
                  & (first_release_date >= {$before}
                  & first_release_date < {$current}
                  & total_rating_count > 5);limit 3;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json();
        });
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
