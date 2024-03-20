
    @extends('layouts.app')

    @section('content')
        <h2>{{ $event->title }}</h2>

        <p>{{ $event->content }}</p>
        <span>
           Start: {{$event->start}}
            <br />
           End: {{$event->end}}
        </span>
    @endsection

