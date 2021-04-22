<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = "";
    public $searchResults = [];
    public $searchResultsUnformatted = [];

    public function render()
    {
        if(strlen($this->search)>2){
        $this->searchResultsUnformatted = Http::withHeaders(config('services.igdb.headers'))
        ->withBody(
            "search \"{$this->search}\";
             fields name, cover.url,slug;
             limit 8;
            ","text/plain"
        )->post(config('services.igdb.endpoint'))->json();
        $this->searchResults = $this->formatForView($this->searchResultsUnformatted);
        }
        return view('livewire.search-dropdown');
    }

    public function formatForView($games)
    {
       return collect($games)->map(fn($game)=> collect($game)->merge([
            'cover' => array_key_exists('cover', $game)? Str::replaceFirst('thumb', '1080p', $game['cover']['url']):null,
       ]));
    }
}
