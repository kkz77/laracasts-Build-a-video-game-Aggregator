<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class ComingSoon extends Component
{
    public $comingSoon=[];
    public function loadComingSoon()
    {
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $comingSoonUnformatted = Cache::remember('coming-soon', 3 , function () use ($afterFourMonths) {
            return  Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date, cover.url, slug;
                where platforms = {6,48,130,49}
                & first_release_date >= {$afterFourMonths};
                sort first_release_date asc;
                limit 4;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json();
        });

        $this->comingSoon = $this->formatOnView($comingSoonUnformatted);
        /* dd($this->comingSoon); */
    }

    private function formatOnView($games)
    {
       return collect($games)->map(function ($game){
           return collect($game)->merge([
                'slug'=> route('game.show',$game['slug']),
                'cover'=> isset($game['cover']['url'])? Str::replaceFirst('thumb', '1080p', $game['cover']['url']):null,
                'first_release_date'=> Carbon::parse($game['first_release_date'])->format('M,d, Y'),
           ]);
       })->toArray();
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
