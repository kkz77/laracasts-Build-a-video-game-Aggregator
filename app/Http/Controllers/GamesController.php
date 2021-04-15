<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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
}
