@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control">
        @if($errors->has('title'))
        <p class="text-danger">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="content">Description</label>
        <textarea name="content" id="content" class="form-control" rows="5"></textarea>
        @if($errors->has('content'))
        <p class="text-danger">{{ $errors->first('content') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="start">Pick Starting Date</label>
        <input type="datetime-local" name="start" id="start_time" class="form-control date-picker">
        @if($errors->has('start'))
        <p class="text-danger">{{ $errors->first('start') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="end">Pick Ending Date</label>
        <input type="datetime-local" name="end" id="finish_time" class="form-control date-picker">
        @if($errors->has('end'))
        <p class="text-danger">{{ $errors->first('end') }}</p>
        @endif
    </div>
    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>
@endsection
