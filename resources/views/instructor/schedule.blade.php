@extends('layouts.app')

@section('title', 'Schema - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 1rem 0;">Mijn Schema</h1>
        
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('instructor.schedule', ['view' => 'day']) }}" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: {{ request('view', 'week') === 'day' ? '#0369a1' : '#e5e7eb' }}; color: {{ request('view', 'week') === 'day' ? 'white' : '#3f4146' }}; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Dag</a>
            <a href="{{ route('instructor.schedule', ['view' => 'week']) }}" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: {{ request('view', 'week') === 'week' ? '#0369a1' : '#e5e7eb' }}; color: {{ request('view', 'week') === 'week' ? 'white' : '#3f4146' }}; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Week</a>
            <a href="{{ route('instructor.schedule', ['view' => 'month']) }}" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: {{ request('view', 'week') === 'month' ? '#0369a1' : '#e5e7eb' }}; color: {{ request('view', 'week') === 'month' ? 'white' : '#3f4146' }}; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Maand</a>
        </div>
    </div>

    @if ($lessons->count() > 0)
        <div style="display: grid; gap: 1rem;">
            @foreach ($lessons as $lesson)
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #0369a1;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">{{ $lesson->start_time->format('d-m-Y H:i') }} - {{ $lesson->end_time->format('H:i') }}</p>
                        <p style="color: #666; margin: 0.25rem 0;">Locatie: {{ $lesson->location->name }}</p>
                        <p style="color: #666; margin: 0.25rem 0;">Klant: {{ $lesson->reservation->customer->personalInformation?->full_name ?? 'Unknown' }}</p>
                        <p style="color: #666; margin: 0;">Pakket: {{ $lesson->reservation->package->name }}</p>
                    </div>
                    <div>
                        @if ($lesson->status === 'scheduled')
                        <div style="display: flex; gap: 0.5rem;">
                            <form action="{{ route('instructor.cancel-lesson', $lesson->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="type" value="instructor_illness">
                                <input type="hidden" name="reason" value="Ziekte instructeur">
                                <button type="submit" style="background: #f97316; color: white; border: none; padding: 0.4rem 0.75rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ea580c'" onmouseout="this.style.background='#f97316'" onclick="return confirm('Les afzeggen wegens ziekte?')">
                                    Ziekte
                                </button>
                            </form>
                            <form action="{{ route('instructor.cancel-lesson', $lesson->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="type" value="bad_weather">
                                <input type="hidden" name="reason" value="Slechte weersomstandigheden">
                                <button type="submit" style="background: #06b6d4; color: white; border: none; padding: 0.4rem 0.75rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#0891b2'" onmouseout="this.style.background='#06b6d4'" onclick="return confirm('Les afzeggen wegens slechte weer?')">
                                    Weer
                                </button>
                            </form>
                        </div>
                        @else
                        <span style="padding: 0.4rem 0.8rem; background: #f3f4f6; color: #4b5563; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600;">{{ $lesson->status === 'scheduled' ? 'Ingepland' : ($lesson->status === 'cancelled' ? 'Afgebroken' : ucfirst($lesson->status)) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Geen lessen ingepland voor deze periode</p>
        </div>
    @endif
</div>
@endsection
