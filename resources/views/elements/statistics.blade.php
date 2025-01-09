@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Element Statistics Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-semibold mb-6">Elements Statistics</h1>

                @foreach($elements as $element)
                    <!-- Check if the element has steps with results -->
                    @php
                        $hasResults = false;
                        $topResults = [];
                        foreach ($element->steps as $step) {
                            $stepResults = $step->results->sortByDesc('reps_time')->take(3);
                            if ($stepResults->isNotEmpty()) {
                                $hasResults = true;
                                $topResults[] = ['step' => $step, 'results' => $stepResults];
                            }
                        }
                    @endphp

                    @if($hasResults)
                        <!-- Element Card -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-6">
                            <h3 class="text-2xl font-medium text-gray-800 mb-2">{{ $element->name }}</h3>
                            <p class="text-gray-700 mb-4">{{ $element->description }}</p>

                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Top 3 Results:</h4>

                            <!-- Loop over top results -->
                            @foreach($topResults as $data)
                                <h5 class="text-lg font-medium text-gray-800 mb-2">Step: {{ $data['step']->name }}</h5>

                                <!-- Table for Top Results -->
                                <div class="overflow-x-auto mb-4">
                                    <table class="table-auto w-full text-sm text-left">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 border-b">Rank</th>
                                                <th class="px-4 py-2 border-b">User</th>
                                                <th class="px-4 py-2 border-b">Reps/Time (Score)</th>
                                                <th class="px-4 py-2 border-b">Video</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['results'] as $index => $result)
                                                <tr class="border-b">
                                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                                    <td class="px-4 py-2">{{ $result->user->name }}</td>
                                                    <td class="px-4 py-2">{{ $result->reps_time }}</td>
                                                    <td class="px-4 py-2">
                                                        <a href="{{ $result->video_url }}" target="_blank" class="text-blue-500 hover:underline">Watch</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
