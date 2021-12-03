@extends('layouts.app')

@section('content')

    <ul>
    @forelse ($countries as $country)
    <li>{{ $country->capital }} / {{ $country->title  }}, {{ $country->created_at->format('Y-m-d') }} /</li>
    @empty
    </ul>
    <p>There is no data</p>
    @endforelse

    <h2>Filters</h2>
    <form method="GET">
        <div class="form-group">
            <label for="country">Select country</label>
            <select name="country" id="country">
                <option value="">--Select country--</option>
            @forelse ($countries as $country)
                <option value="{{ $country->title }}">{{ $country->title }}</option>
            @empty
            @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="capital">Select capital</label>
            <select name="capital" id="capital">
                <option value="">--Select country--</option>
            @forelse ($countries as $country)
                <option value="{{ $country->capital }}">{{ $country->capital }}</option>
            @empty
            @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="date">Select date</label>
            <input type="date" name="date" id="date">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    @if ($statistic->count() > 0)
    <h2>Result</h2>
        @forelse ($statistic as $country)
            <p>{{ $country->capital }}, {{ $country->title }}, {{ $country->created_at->format('Y-m-d') }}</p>
            <p>
                {{ $country->statistic->hotels }}<br>
                {{ $country->statistic->weather }}<br>
                {{ $country->statistic->covid }}
            </p>
        @empty
        @endforelse
        <a href="{{ route('export.stat', request()->all()) }}" target="_blank" title="Export statistic">Export Statistic</a>
    @endif
@endsection
