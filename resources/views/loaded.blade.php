@extends('layouts.layout')

@section('content')
    <div class="container text-center py-4">
        <h1>CSV pregled zapisa</h1>

        <form action="{{ route('excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv">
            <button class="btn btn-success">Spremi podatke</button>
        </form>

        <hr class="bg-light">

        <p class="text-left"><span class="text-danger">Crvena</span> polja neće biti spremljena</p>
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
                        <td>{{ $contact[0] }}</td>
                        <td>{{ $contact[1] }}</td>
                        @if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $contact[2]))
                            <td class="text-danger">
                                {{ $contact[2] }}</td>
                        @else
                            <td>{{ $contact[2] }}</td>
                        @endif
                        <td>{{ $contact[3] }}</td>
                        <td>{{ $contact[4] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
