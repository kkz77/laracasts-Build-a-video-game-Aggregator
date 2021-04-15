@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4">
        <!-- popular games -->
        <h2 class="text-blue-500 tracking-wide font-semibold uppercase">
            Popular Games
        </h2>
        <livewire:popular-games>
        <!-- end popular games --> <div class="flex flex-col lg:flex-row my-10">
            <!-- recently reviewed games -->
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="font-semibold text-blue-500 uppercase tracking-wide">Recently Reviewed</h2>
                <livewire:recently-reviewed>
           </div>
           <!-- end recently reviewed games -->
           <div class="most-anticipated mt-12 lg:mt-0 lg:w-1/4 space-y-14">
            <!-- most-anticipated games -->
                <div>
                    <h2 class="font-semibold text-blue-500 uppercase tracking-wide">Most Aggregated</h2>
                    <livewire:most-anticipated>
                </div>
            <!-- end most-anticipated games -->
                <div>
                    <h2 class="font-semibold text-blue-500 uppercase tracking-wide">Coming Soon</h2>
                       <livewire:coming-soon>
                </div>
            </div>
            <!-- end coming soon games -->
        </div>
    </div>
    <!-- end container -->
@endsection
