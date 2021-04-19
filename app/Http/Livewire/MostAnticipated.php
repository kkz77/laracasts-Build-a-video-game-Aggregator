<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];
    public function loadMostAnticipated()
    {
        $current = Carbon::now()->timestamp;
        $mostAnticipatedUnformatted = Cache::remember('most-anticipated', 3, function () use($current) {
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

            $this->mostAnticipated = $this->formatOnView($mostAnticipatedUnformatted);
            /* dd($this->mostAnticipated); */
    }

    /* route,cover,date */

    private function formatOnView($games)
    {
        return collect($games)->map(function ($game)
        {
            return collect($game)->merge([
                'slug' => route('game.show',$game['slug']),
                'cover' => Str::replaceFirst('thumb', '1080p', $game['cover']['url']),
                'first_release_date' =>isset($game['first_release_date'])? Carbon::parse($game['first_release_date'])->format('M,d, Y'):null,
            ]);
        })->toArray();
    }

    public function render()
    {

        return view('livewire.most-anticipated');
    }
}
