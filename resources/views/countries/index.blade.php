@extends('layouts.app')

@section('title', 'Country List')

@section('content')
<div class="container">
    <h1 class="mb-4">Countries</h1>
    <form action="{{ route('countries.search') }}" method="GET" class="mb-3">
        <input type="text" name="name" placeholder="Search country..." required class="form-control w-50 d-inline">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Flag</th>
                <th>Name</th>
                <th>Region</th>
                <th>Population</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
            <tr>
                <td><img src="{{ $country['flags']['png'] }}" width="50"></td>
                <td><a href="{{ route('countries.show', $country['name']['common']) }}">{{ $country['name']['common'] }}</a></td>
                <td>{{ $country['region'] }}</td>
                <td>{{ number_format($country['population']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
