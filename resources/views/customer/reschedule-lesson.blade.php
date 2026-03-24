@extends('layouts.app')

@section('title', 'Nieuwe Lesdatum Kiezen - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 0.5rem 0;">Kies een Nieuwe Lesdatum</h1>
        <p style="color: #666; font-size: 1.05rem; margin: 0;">Je kunt nog {{ $remainingSessions }} les(sen) plannen uit je pakket.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #0369a1;">
            <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">PAKKET</p>
            <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $reservation->package->name }}</p>
        </div>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #ff6b35;">
            <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">LOCATIE</p>
            <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $reservation->location->name }}</p>
        </div>

    <form action="{{ route('customer.reschedule-lesson.store', $lesson->id) }}" method="POST" id="rescheduleForm">
        @csrf

        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
            <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Selecteer Nieuwe Lesdatum</h2>

            <div style="margin-bottom: 2rem;">
                <label for="new_date" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Nieuwe Datum en Tijd</label>
                <input 
                    type="datetime-local" 
                    id="new_date" 
                    name="new_date" 
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-size: 0.95rem;"
                    required
                >
                @error('new_date')
                    <span style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="{{ route('customer.reservations') }}" style="padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.3rem; background: white; color: #1f2937; font-weight: 600; text-decoration: none; cursor: pointer; display: inline-block;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                    Annuleren
                </a>
                <button 
                    type="submit" 
                    style="padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; background: #0369a1; color: white; font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.background='#0261a1'"
                    onmouseout="this.style.background='#0369a1'"
                >
                    Nieuwe Datum Bevestigen
                </button>
            </div>
        </div>
    </form>

    <!-- Info Box -->
    <div style="margin-top: 2rem; background: #f0f8ff; border-radius: 0.3rem; padding: 1.5rem; border-left: 4px solid #0369a1;">
        <h3 style="font-size: 1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.75rem 0;">💡 Tips voor Rescheduling</h3>
        <ul style="margin: 0; padding-left: 1.5rem; color: #666; line-height: 1.6;">
            <li>Kies een datum minstens 24 uur in de toekomst</li>
            <li>Pies je voorkeursdatum en -tijd</li>
            <li>Beschikbare instructeurs worden automatisch toegewezen</li>
            <li>Controleer je e-mail voor bevestiging</li>
        </ul>
    </div>
</div>
@endsection
