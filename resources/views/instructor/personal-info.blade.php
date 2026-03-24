@extends('layouts.app')

@section('title', 'Persoonlijke Gegevens - Windkracht-12')

@section('content')
<div style="max-width: 50rem; margin: 0 auto; margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Persoonlijke Gegevens</h1>
    </div>

    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
        <form action="{{ route('instructor.personal-info.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label for="first_name" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Voornaam</label>
                    <input type="text" id="first_name" name="first_name" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ old('first_name', $personalInfo?->first_name) }}" required>
                    @error('first_name') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="last_name" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Achternaam</label>
                    <input type="text" id="last_name" name="last_name" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ old('last_name', $personalInfo?->last_name) }}" required>
                    @error('last_name') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="street_address" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Straatnaam</label>
                <input type="text" id="street_address" name="street_address" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ old('street_address', $personalInfo?->street_address) }}" required>
                @error('street_address') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label for="city" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Plaats</label>
                    <input type="text" id="city" name="city" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ old('city', $personalInfo?->city) }}" required>
                    @error('city') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="postal_code" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Postcode</label>
                    <input type="text" id="postal_code" name="postal_code" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ old('postal_code', $personalInfo?->postal_code) }}">
                    @error('postal_code') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label for="date_of_birth" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Geboortedatum</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ $personalInfo?->date_of_birth }}">
                    @error('date_of_birth') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone_mobile" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Mobiel Telefoonnummer</label>
                    <input type="tel" id="phone_mobile" name="phone_mobile" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ $personalInfo?->phone_mobile }}" required>
                    @error('phone_mobile') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="bsn" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">BSN Nummer</label>
                <input type="text" id="bsn" name="bsn" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="{{ $personalInfo?->bsn }}">
                @error('bsn') <span style="color: #dc2626; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" style="background: #0369a1; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; font-weight: 700; cursor: pointer;" onmouseover="this.style.background='#003d7a'" onmouseout="this.style.background='#0369a1'">
                Gegevens Opslaan
            </button>
        </form>
    </div>
</div>
@endsection
