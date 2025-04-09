@extends('layouts.app')

@section('title', $country['name']['common'])

@section('content')
<div class="container">
    <h1>{{ $country['name']['common'] }}</h1>
    <img src="{{ $country['flags']['png'] }}" width="150">
    <p><strong>Capital:</strong> {{ $country['capital'][0] ?? 'N/A' }}</p>
    <p><strong>Region:</strong> {{ $country['region'] }}</p>
    <p><strong>Population:</strong> {{ number_format($country['population']) }}</p>
    <p><strong>Languages:</strong> {{ implode(', ', array_values($country['languages'] ?? [])) }}</p>
    <p><strong>Currency:</strong> {{ implode(', ', array_keys($country['currencies'] ?? [])) }}</p>
</div>
@endsection
