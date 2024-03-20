
    @extends('layouts.app')

    @section('content')

        @foreach ($events as $event)
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{ route('events.edit', $event->id) }}" class="text-decoration-none">
                    <h3 class="card-title">{{ $event->title }}</h3>
                    </a>
                    <p class="card-text">{{ $event->content }}</p>
                    <p class="card-text"><strong>Start:</strong> {{ $event->start }}</p>
                    <p class="card-text"><strong>End:</strong> {{ $event->end }}</p>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

    @endsection

