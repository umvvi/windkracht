@extends('layouts.app')

@section('title', 'Klant Beheren - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">{{ $customer->personalInformation?->full_name ?? $customer->email }}</h1>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #0369a1;">
            <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;">Persoonlijke Informatie</h2>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Naam:</strong> {{ $customer->personalInformation?->full_name ?? 'N/A' }}</p>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Email:</strong> {{ $customer->email }}</p>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Telefoon:</strong> {{ $customer->personalInformation?->phone_mobile ?? 'N/A' }}</p>
            <p style="margin: 0; color: #4b5563;"><strong>Plaats:</strong> {{ $customer->personalInformation?->city ?? 'N/A' }}</p>
        </div>

        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #ff6b35; grid-column: span 2;">
            <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;">Lessen</h2>
            @if ($lessons->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Datum & Tijd</th>
                                <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Locatie</th>
                                <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; color: #1f2937;">{{ $lesson->start_time->format('d-m-Y H:i') }}</td>
                                <td style="padding: 1rem; color: #1f2937;">{{ $lesson->location->name }}</td>
                                <td style="padding: 1rem; color: #1f2937;"><span style="padding: 0.4rem 0.8rem; background: #d1fae5; color: #065f46; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600;">{{ ucfirst($lesson->status) }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p style="color: #666;">Geen lessen gevonden</p>
            @endif
        </div>
    </div>
</div>
@endsection
