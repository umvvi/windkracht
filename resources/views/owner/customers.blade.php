@extends('layouts.app')

@section('title', 'Klanten Beheren - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Klanten Beheren</h1>
    </div>

    @if($customers->count() > 0)
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Naam</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Email</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Telefoon</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Status</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 1rem; color: #1f2937;">{{ $customer->personalInformation?->full_name ?? 'N/A' }}</td>
                        <td style="padding: 1rem; color: #1f2937;">{{ $customer->email }}</td>
                        <td style="padding: 1rem; color: #1f2937;">{{ $customer->personalInformation?->phone_mobile ?? 'N/A' }}</td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: {{ $customer->is_active ? '#d1fae5' : '#fee2e2' }}; color: {{ $customer->is_active ? '#065f46' : '#7f1d1d' }};">{{ $customer->is_active ? 'Actief' : 'Geblokkeerd' }}</span>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="{{ route('owner.manage-customer', $customer->id) }}" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-right: 1rem;">Bekijken</a>
                            <form action="{{ route('owner.toggle-status', $customer->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="color: #ff6b35; background: none; border: none; cursor: pointer; text-decoration: none; font-weight: 600; font-size: 0.9rem;">{{ $customer->is_active ? 'Blokkeren' : 'Activeren' }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Geen klanten gevonden</p>
        </div>
    @endif
</div>
@endsection
