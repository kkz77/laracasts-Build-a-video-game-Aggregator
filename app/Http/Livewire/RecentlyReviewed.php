<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];
    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonths(3)->timestamp;
        $current = Carbon::now()->timestamp;
        $recentyReviewedUnformatted = Cache::remember('recently-reviewed', 3, function () use ($before,$current) {
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

        $this->recentlyReviewed = $this->formatOnView($recentyReviewedUnformatted);
        /* dd($this->recentlyReviewed); */
    }

    private function formatOnView($games)
    {
        return collect($games)->map(function ($game){
           return collect($game)->merge([
               'route'=> route('game.show',$game['slug']),
               'cover'=> Str::replaceFirst('thumb', '1080p', $game['cover']['url']),
               'platforms'=> collect($game['platforms'])->implode('abbreviation',', '),
               'summary'=> isset($game['summary'])? $game['summary']: null,
               'rating' => isset($game['rating'])? round($game['rating']):'0',
           ]);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
