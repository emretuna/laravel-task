
    @extends('layouts.app')

    @section('content')
<div class="d-flex">
    <div class="p-2 flex-grow-1">
        <form method="POST" action="{{ route('events.update', $event->id) }}">
            @method('PATCH')
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" value="{{old('title', $event->title ?? '')}}" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Description</label>
                <textarea name="content" id="content" class="form-control" rows="5">
                    {{old('content', $event->content ?? '')}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="start">Pick Starting Date</label>
                <input type="datetime-local" name="start" id="start_time" value="{{old('start', $event->start ?? '')}}" class="form-control date-picker">
            </div>
            <div class="form-group">
                <label for="end">Pick Ending Date</label>
                <input type="datetime-local" name="end" value ="{{old('end', $event->end ?? '')}}" id="finish_time" class="form-control date-picker">
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <div class="p-2 mt-md-4 text-center">
         <form action="{{ route('events.destroy', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger float-right display-block">Delete</button>
        </form>
    </div>
    </div>
    @endsection

