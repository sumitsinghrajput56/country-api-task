@extends('layouts.app')

@section('title', 'Country List')

@section('content')
    <div class="container">
        <h1 class="mb-4">Countries</h1>

        <!-- Filters -->
        <div class="row mb-3">
            <div class="col-md-5">
                <input type="text" id="name" name="name" placeholder="Search country..." required
                    class="form-control">
            </div>
            <div class="col-md-5">
                <select id="regionFilter" class="form-control">
                    <option value="">All Regions</option>
                    <option value="Africa">Africa</option>
                    <option value="Americas">Americas</option>
                    <option value="Asia">Asia</option>
                    <option value="Europe">Europe</option>
                    <option value="Oceania">Oceania</option>
                    <option value="Antarctic">Antarctic</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5">
                <select id="sortBy" class="form-control">
                    <option value="name">Sort by Name</option>
                    <option value="population">Sort by Population</option>
                </select>
            </div>
            <div class="col-md-5">
                <select id="order" class="form-control">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <button id="applyFilters" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>

        <!-- Table for Countries -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Flag</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody id="countryTableBody"></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function fetchCountries() {
                let name = $('#name').val();
                let region = $('#regionFilter').val();
                let sortBy = $('#sortBy').val();
                let order = $('#order').val();

                $.get(`/countries?name=${name}&region=${region}&sortBy=${sortBy}&order=${order}`, function(data) {
                    let html = "";
                    data.forEach(country => {
                        html += `
                        <tr>
                            <td><a href="/country/${country.name.common}"><img src="${country.flags.svg}" width="50"></a></td>
                            <td><a href="/country/${country.name.common}">${country.name.common}</a></td>
                            <td>${country.region}</td>
                            <td>${country.population.toLocaleString()}</td>
                        </tr>`;
                    });
                    $('#countryTableBody').html(html);
                });
            }

            $('#applyFilters').click(fetchCountries);
            fetchCountries();
        });
    </script>
@endsection
