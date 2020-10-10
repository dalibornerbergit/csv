@extends('layouts.layout')

@section('content')
    <div class="container text-center py-4">

        <form action="{{ route('excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" value="{{ asset('uploads/podaci - Copy.csv') }}">
            <button class="btn btn-success">Spremi podatke</button>
        </form>

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
