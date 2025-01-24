@extends('layouts.app')

@section('meta_title', 'Elements Statistics | Calisthenics')
@section('meta_description', 'Check out the statistics for all the elements in calisthenics. See the top 3 results for each step of the element.')
@section('meta_keywords', 'calisthenics, elements, statistics, results, steps')

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Element Statistics Section -->
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 text-white">
                <h1 class="text-2xl sm:text-3xl font-semibold mb-4 sm:mb-6">
                    <i class="fa-solid fa-flask text-blue-400 mr-2"></i> Elements Statistics
                </h1>

                @foreach($elements as $element)
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
                        <div class="bg-gray-700 p-4 sm:p-6 rounded-lg shadow-md mb-6 sm:mb-8">
                            <h3 class="text-xl sm:text-2xl font-medium text-white mb-4">
                                <i class="fa-solid fa-cube text-purple-400 mr-2"></i> {{ $element->name }}
                            </h3>
                            <p class="text-gray-300 mb-4 sm:mb-6">{{ $element->description }}</p>

                            <h4 class="text-lg sm:text-xl font-semibold text-white mb-4">
                                <i class="fa-solid fa-star text-yellow-400 mr-2"></i> Top 3 Results:
                            </h4>

                            @foreach($topResults as $data)
                                <h5 class="text-md sm:text-lg font-medium text-white mb-4">
                                    <i class="fa-solid fa-arrow-right text-green-400 mr-2"></i> Step: {{ $data['step']->name }}
                                </h5>

                                <!-- Table for Top Results -->
                                <div class="overflow-x-auto mb-6">
                                    <table class="table-auto w-full text-sm sm:text-base text-left border-collapse border border-gray-600">
                                        <thead class="bg-gray-600">
                                            <tr>
                                                <th class="px-2 sm:px-4 py-2 border border-gray-500">Rank</th>
                                                <th class="px-2 sm:px-4 py-2 border border-gray-500">User</th>
                                                <th class="px-2 sm:px-4 py-2 border border-gray-500">Reps/Time (Result)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['results'] as $index => $result)
                                                <tr class="hover:bg-gray-600">
                                                    <td class="px-2 sm:px-4 py-2 border border-gray-500 text-center">
                                                        @if ($index == 0)
                                                            <i class="fa-solid fa-trophy text-yellow-400"></i> Gold
                                                        @elseif ($index == 1)
                                                            <i class="fa-solid fa-medal text-gray-400"></i> Silver
                                                        @elseif ($index == 2)
                                                            <i class="fa-solid fa-award text-orange-400"></i> Bronze
                                                        @else
                                                            {{ $index + 1 }}
                                                        @endif
                                                    </td>
                                                    <td class="px-2 sm:px-4 py-2 border border-gray-500">
                                                        <a href="/profile/{{ $result->user->id }}" class="text-blue-400 hover:underline">{{ $result->user->name }}</a>
                                                    </td>
                                                    <td class="px-2 sm:px-4 py-2 border border-gray-500">{{ $result->reps_time }}</td>
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
