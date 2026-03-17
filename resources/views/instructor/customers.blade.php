@extends('layouts.app')

@section('title', 'Mijn Klanten - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Mijn Klanten</h1>
    </div>

    @if(count($customers) > 0)
        <div style="display: grid; gap: 1.5rem;">
            @foreach ($customers as $customer)
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #0369a1; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">{{ $customer->personalInformation?->full_name ?? $customer->email }}</p>
                    <p style="color: #666; margin: 0.25rem 0;">Email: {{ $customer->email }}</p>
                    <p style="color: #666; margin: 0;">Telefoon: {{ $customer->personalInformation?->phone_mobile ?? 'N/A' }}</p>
                </div>
                <a href="{{ route('instructor.manage-customer', $customer->id) }}" style="background: #0369a1; color: white; padding: 0.75rem 1.5rem; border-radius: 0.3rem; text-decoration: none; font-weight: 700;" onmouseover="this.style.background='#003d7a'" onmouseout="this.style.background='#0369a1'">
                    Details Bekijken
                </a>
            </div>
            @endforeach
        </div>
    @else
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Nog geen klanten</p>
        </div>
    @endif
</div>
@endsection
