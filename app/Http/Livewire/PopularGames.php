<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class PopularGames extends Component
{
    public $popularGames = [];
    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(3)->timestamp;
        $after= Carbon::now()->addMonths(3)->timestamp;
        $popularGamesUnformatted= Cache::remember('popular-games',3, function () use ($before,$after) {
            return  Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug;
                  where (first_release_date >= {$before}
                  & first_release_date < {$after}
                  & rating > 7);
                  sort rating desc;
                  limit 18;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json();
        });

        $this->popularGames = $this->formatForView($popularGamesUnformatted);
        /* dd($this->popularGames); */
    }
    private function formatForView($games)
    {
       return collect($games)->map(function ($game){
           return collect($game)->merge([
                'coverImageUrl' => array_key_exists('cover',$game)?Str::replaceFirst('thumb', '1080p', $game['cover']['url']):null,
                'rating' => isset($game['rating'])? round($game['rating']):null,
                'slug' => route('game.show', $game['slug']),
                'platforms'=> collect($game['platforms'])->implode('abbreviation',', '),
           ]);
       })->toArray();
    }
    public function render()
    {
        return view('livewire.popular-games');
    }
}
