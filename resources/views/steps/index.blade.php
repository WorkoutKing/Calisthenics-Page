
<h1>Steps for {{ $element->name }}</h1>

@foreach ($element->steps as $step)
    <h2>{{ $step->name }} ({{ $step->points }} points)</h2>

    @if ($step->results->isEmpty())
        <p>No results uploaded yet.</p>
    @else
        <ul>
            @foreach ($step->results as $result)
                <li>{{ $result->user->name }}:
                    Video: {{ $result->video_url ?? 'N/A' }},
                    Reps: {{ $result->reps ?? 'N/A' }},
                    Time: {{ $result->time ?? 'N/A' }} seconds
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('steps.uploadResult', $step->id) }}">Upload your result</a>
@endforeach