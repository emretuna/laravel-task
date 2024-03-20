@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function(){
            const calendarEl = document.getElementById('calendar')
            const calendar = new Calendar(calendarEl, {
                plugins: [timeGridPlugin,dayGridPlugin,bootstrap5Plugin],
                events: @json($events),
                eventClick: function(info) {
                info.jsEvent.preventDefault(); // don't let the browser navigate

                if (info.event.id) {
                window.location.href = "{{URL::to('events')}}" + "/" + info.event.id + "/edit";
                    }
                },
                themeSystem: 'bootstrap5',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
            })
            calendar.render()
        });
        </script>
@endpush
