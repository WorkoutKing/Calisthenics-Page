@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Element Statistics Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-semibold mb-6">
                    <i class="fa-solid fa-flask text-blue-500"></i> Elements Statistics
                </h1>

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
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-8">
                            <h3 class="text-2xl font-medium text-gray-800 mb-4">
                                <i class="fa-solid fa-cube text-purple-500"></i> {{ $element->name }}
                            </h3>
                            <p class="text-gray-700 mb-6">{{ $element->description }}</p>

                            <h4 class="text-xl font-semibold text-gray-800 mb-4">
                                <i class="fa-solid fa-star text-yellow-500"></i> Top 3 Results:
                            </h4>

                            <!-- Loop over top results -->
                            @foreach($topResults as $data)
                                <h5 class="text-lg font-medium text-gray-800 mb-4">
                                    <i class="fa-solid fa-arrow-right text-green-500"></i> Step: {{ $data['step']->name }}
                                </h5>

                                <!-- Table for Top Results -->
                                <div class="overflow-x-auto mb-6">
                                    <table class="table-auto w-full text-sm text-left border-collapse border border-gray-200">
                                        <thead class="bg-gray-200">
                                            <tr>
                                                <th class="px-4 py-2 border border-gray-300">Rank</th>
                                                <th class="px-4 py-2 border border-gray-300">User</th>
                                                <th class="px-4 py-2 border border-gray-300">Reps/Time (Result)</th>
                                                {{--  <th class="px-4 py-2 border border-gray-300">Video</th>  --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['results'] as $index => $result)
                                                <tr class="hover:bg-gray-100">
                                                    <td class="px-4 py-2 border border-gray-300 text-center">
                                                        @if ($index == 0)
                                                            <i class="fa-solid fa-trophy text-yellow-500"></i> Gold
                                                        @elseif ($index == 1)
                                                            <i class="fa-solid fa-medal text-gray-500"></i> Silver
                                                        @elseif ($index == 2)
                                                            <i class="fa-solid fa-award text-orange-500"></i> Bronze
                                                        @else
                                                            {{ $index + 1 }}
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border border-gray-300"><a href="/profile/{{ $result->user->id }}">{{ $result->user->name }}</a></td>
                                                    <td class="px-4 py-2 border border-gray-300">{{ $result->reps_time }}</td>
                                                    {{--  <td class="px-4 py-2 border border-gray-300 text-center">
                                                        <a href="{{ $result->video_url }}" target="_blank" class="text-blue-500 hover:underline">
                                                            <i class="fa-solid fa-video"></i> Watch
                                                        </a>
                                                    </td>  --}}
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
