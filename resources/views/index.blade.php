@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <h3>Podaci</h3>

        <hr class="bg-light">

        <p class="text-left">Podaci iz baze podataka</p>
        <table class="table table-dark my-4">
            <thead>
                <tr>
                    <th scope="col">Ime</th>
                    <th scope="col">Prezime</th>
                    <th scope="col">Poštanski broj</th>
                    <th scope="col">Grad</th>
                    <th scope="col">Telefon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $contact)
                    <tr>
                        <td>{{ $contact->ime }}</td>
                        <td>{{ $contact->prezime }}</td>
                        <td>{{ $contact->postanski_br }}</td>
                        <td>{{ $contact->grad }}</td>
                        <td>{{ $contact->telefon }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>

@endsection
