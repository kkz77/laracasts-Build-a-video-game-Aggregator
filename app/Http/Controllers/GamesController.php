<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    public function index()
    {
        // $before = Carbon::now()->subMonths(3)->timestamp;
        // $after= Carbon::now()->addMonths(3)->timestamp;
        // $current = Carbon::now()->timestamp;
        // $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        /* $popularGames = Http::withHeaders(config('services.igdb.headers'))
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
            ->json(); */

        /* $recentlyReviewed = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date ,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug,summary;
                  where platforms = (6,48,130,49)
                  & (first_release_date >= {$before}
                  & first_release_date < {$current}
                  & total_rating_count > 5);limit 3;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json(); */

       /*  $mostAnticipated = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date ,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug,summary,aggregated_rating;
                  where platforms = {6,48,130,49}
                  & (first_release_date >= {$current}
                  & first_release_date < {$afterFourMonths});
                  sort aggregated_rating;
                  limit 4;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json(); */

           /*  // "fields name, first_release_date ,rating,cover.url,rating,platforms.abbreviation,total_rating_count,slug,summary;
            //   where platforms = {6,48,130,49}
            //   & first_release_date >= {$coming}
            //   & rating > 5;
            //   sort date asc;
            //   limit 4;" */
       /*  $comingSoon = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, first_release_date, cover.url ;
                where platforms = {6,48,130,49}
                & first_release_date >= {$afterFourMonths};
                sort first_release_date asc;
                limit 3;"
                ,"text/plain"
            )->post(config('services.igdb.endpoint'))
            ->json(); */
        return view('index',[
            // 'popularGames'=>$popularGames,
            // 'recentlyReviewed'=>$recentlyReviewed,
            // 'mostAnticipated' => $mostAnticipated,
            // 'comingSoon'=> $comingSoon
        ]);
    }

    public function show($slug)
    {
        $gameUnformatted = Http::withHeaders(config('services.igdb.headers'))
        ->withBody(
            "fields *,cover.url,genres.*,platforms.*,game_modes.*,involved_companies.company.name,
            platforms.abbreviation,videos.*,screenshots.*,similar_games.*,similar_games.cover.url,similar_games.platforms.abbreviation,websites.*;
            where slug = \"{$slug}\";"
            ,"text/plain"
        )->post(config('services.igdb.endpoint'))->json();

        $game = $this->formatOnView($gameUnformatted);
        abort_if(!$game,404);
       /*  dump($game); */

        return view('show',[
           'game'=>$game,
       ]);

    }

    private function formatOnView($game)
    {
         $temp = collect($game[0])->merge([
            'cover' => array_key_exists('cover',$game[0])?Str::replaceFirst('thumb', '1080p', $game[0]['cover']['url']):$game[0]['name'],
            'genres'=> isset($game[0]['genres'])? collect($game[0]['genres'])->implode('name', ', '):null,
            'involved_companies' => isset($game[0]['involved_companies'])?/* collect($game[0]['involved_companies'][0]['company']['name'])->implode('name',', '):null, */
             collect($game[0]['involved_companies'])->map(function ($invloved_company){
                 return collect($invloved_company['company']['name'])->implode('name',', ');
             })->implode(', '):null,
            'platforms'=> isset($game[0]['platforms'])? collect($game[0]['platforms'])->implode('abbreviation',', '):null,
            'rating' => (array_key_exists('rating',$game[0]))? round($game[0]['rating']):'0',
            'aggregated_rating' => (array_key_exists('aggregated_rating',$game[0]))? round($game[0]['aggregated_rating']):'0',
            'videos' => (isset($game[0]['videos']))?$video= collect($game[0]['videos'])->pluck('video_id')->last():null,
            'screenshots'=> isset($game[0]['screenshots'])? collect($game[0]['screenshots'])->take(9)->map(fn($screenshot)=>Str::replaceFirst('thumb', '1080p', $screenshot['url'])):null,
            /* similar_games slug,cover.url,rating,platform */
            'similar_games' => collect($game[0]['similar_games'])->take(6)->map(fn($game)=> collect($game)->merge([
                'slug' =>route('game.show',$game['slug']),
                'cover'=> isset($game['cover'])?Str::replaceFirst('thumb', '1080p', $game['cover']['url']):$game['name'],
                'rating'=> array_key_exists('rating', $game)? round($game['rating']):'0',
                'abbreviation'=> isset($game['platforms'])? collect($game['platforms'])->implode('abbreviation',', '):'null',
             ])->toArray()),
                'social'=>[
                'website'  => isset($game[0]['websites'])?collect($game[0]['websites'])->first():null,
             'facebook' =>isset($game[0]['websites'])? collect($game[0]['websites'])->filter(fn($website)=>Str::contains($website['url'], 'facebook'))->values()->toArray():null,
             'twitter' =>isset($game[0]['websites'])? collect($game[0]['websites'])->filter(fn($website)=> Str::contains($website['url'], 'twitter'))->values()->toArray():null,
             'instagram' =>isset($game[0]['websites'])? collect($game[0]['websites'])->filter(fn($website)=> Str::contains($website['url'], 'instagram'))->values()->toArray():null,
                ]
         ]);
         return $temp;
    }
}
