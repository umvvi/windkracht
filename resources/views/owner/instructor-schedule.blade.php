@extends('layouts.app')

@section('title', $instructor->personalInformation?->full_name . ' Schema - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 1rem 0;">{{ $instructor->personalInformation?->full_name ?? $instructor->email }} - Schema</h1>
        
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('owner.instructor-schedule', ['id' => $instructor->id, 'view' => 'day']) }}" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: {{ request('view', 'week') === 'day' ? '#0369a1' : '#e5e7eb' }}; color: {{ request('view', 'week') === 'day' ? 'white' : '#3f4146' }}; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Dag</a>
            <a href="{{ route('owner.instructor-schedule', ['id' => $instructor->id, 'view' => 'week']) }}" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: {{ request('view', 'week') === 'week' ? '#0369a1' : '#e5e7eb' }}; color: {{ request('view', 'week') === 'week' ? 'white' : '#3f4146' }}; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Week</a>
            <a href="{{ route('owner.instructor-schedule', ['id' => $instructor->id, 'view' => 'month']) }}" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: {{ request('view', 'week') === 'month' ? '#0369a1' : '#e5e7eb' }}; color: {{ request('view', 'week') === 'month' ? 'white' : '#3f4146' }}; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Maand</a>
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
                        <p style="color: #666; margin: 0.25rem 0;">Klant: {{ $lesson->reservation->customer->personalInformation?->full_name ?? 'Onbekend' }}</p>
                        <p style="color: #666; margin: 0;">Pakket: {{ $lesson->reservation->package->name }}</p>
                    </div>
                    <div>
                        <span style="padding: 0.4rem 0.8rem; background: #f3f4f6; color: #4b5563; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600;">{{ $lesson->status === 'scheduled' ? 'Ingepland' : ($lesson->status === 'cancelled' ? 'Afgebroken' : ucfirst($lesson->status)) }}</span>
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
