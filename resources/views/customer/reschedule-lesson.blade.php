@extends('layouts.app')

@section('title', 'Nieuwe Lesdatum Kiezen - Windkracht-12')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 800; color: #003d7a; margin: 0;">Kies een Nieuwe Lesdatum</h1>
    </div>

    <!-- Info Bar -->
    <div style="background: #f0f8ff; border-radius: 0.3rem; padding: 1rem; margin-bottom: 2rem; border-left: 4px solid #0369a1;">
        <p style="color: #1f2937; margin: 0; font-size: 0.95rem;">
            <span style="font-weight: 600;">{{ $reservation->package->name }}</span> 
            <span style="color: #999; margin: 0 0.5rem;">—</span>
            <span style="color: #666;">{{ $reservation->location->name }}</span>
        </p>
        <p style="color: #666; margin: 0.5rem 0 0 0; font-size: 0.9rem;">Geannuleerde les: <strong>{{ $lesson->start_time->format('d-m-Y H:i') }}</strong></p>
    </div>

    <!-- Main Form -->
    <form action="{{ route('customer.reschedule-lesson.store', $lesson->id) }}" method="POST" id="rescheduleForm">
        @csrf

        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
            <div style="margin-bottom: 1.5rem;">
                <label for="new_date" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.95rem;">Nieuwe Datum & Tijd</label>
                <input 
                    type="datetime-local" 
                    id="new_date" 
                    name="new_date" 
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-size: 0.95rem; box-sizing: border-box;"
                    required
                    autofocus
                >
                @error('new_date')
                    <span style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                <a href="{{ route('customer.reservations') }}" style="padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.3rem; background: white; color: #1f2937; font-weight: 600; text-decoration: none; cursor: pointer; display: inline-block; transition: all 0.3s;" onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#9ca3af'" onmouseout="this.style.background='white'; this.style.borderColor='#d1d5db'">
                    Terug
                </a>
                <button 
                    type="submit" 
                    style="padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; background: #0369a1; color: white; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                    onmouseover="this.style.background='#0261a1'"
                    onmouseout="this.style.background='#0369a1'"
                >
                    Bevestigen
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
