@extends('layouts.layout')

@section('content')
    <div class="container text-center py-4">
        <h1>CSV</h1>
        <h4>{{ session('mssg') }}</h4>

        <form method="POST" action="{{ route('load') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv">
            <button class="btn btn-warning" type="submit">Učitaj podatke</button>
        </form>

        <hr class="bg-light">

        <p class="text-left">Podaci spremljeni u bazu podataka</p>
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
    </div>

@endsection
