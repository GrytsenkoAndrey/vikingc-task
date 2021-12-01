@extends('layouts.app')

@section('content')

    <ul>
    @forelse ($countries as $country)
    <li>{{ $country->capital }} / {{ $country->title  }}, {{ $country->created_at->format('Y-m-d') }} /</li>
    @empty
    </ul>
    <p>There is no data</p>
    @endforelse

@endsection
