@extends('layouts.app')

@section('content')
<!-- resources/views/units/index.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Daftar Unit</h1>
            <div class="card">
                <div class="card-body">
                    @if ($units->isEmpty())
                        <p>Tidak ada unit yang tersedia.</p>
                    @else
                        <ul>
                            @foreach ($units as $unit)
                                <li>
                                    <a href="{{ route('units.show', $unit->id) }}" style="text-decoration: none;">
                                        {{ $unit->nama }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection

