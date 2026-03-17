@extends('layouts.app')

@section('title', 'Locaties - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 0.5rem 0;">KITESURFLOCATIES</h1>
        <div style="height: 2px; width: 50px; background: #ff6b35;"></div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        @foreach ($locations as $location)
        <div style="
            background: white;
            border-radius: 0.3rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: all 0.3s;
        " onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <div style="
                height: 180px;
                background: linear-gradient(135deg, #668fb4 0%, #5a7fa3 100%);
                display: flex;
                align-items: flex-end;
                justify-content: center;
                color: white;
                padding: 2rem;
                text-align: center;
            ">
                <!-- IMAGE PLACEHOLDER -->
            </div>
            <div style="padding: 1.5rem;">
                <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">{{ $location->name }}</h2>
                <p style="color: #ff6b35; font-weight: 600; margin-bottom: 1rem; font-size: 0.9rem;">{{ $location->city }}</p>
                <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">{{ $location->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
