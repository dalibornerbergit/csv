@extends('layouts.layout')

@section('content')
    <div class="container text-center py-4">
        <h1>CSV pregled zapisa</h1>
        <a href="javascript:history.back()" class="btn btn-info">Natrag na spremanje podataka</a>

        {{-- @if ($data)
            <form action="{{ route('excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".csv">
                <button class="btn btn-success">Spremi podatke</button>
            </form>
        @endif --}}

        <br>
        <hr class="bg-light">

        @if (!$data)
            <p class="text-left">Datoteka ne sadrži niti jedan valjan unos.</p>
            <a class="text-light" href="/">Natrag</a>
        @else
            <p class="text-left">Podaci koji će biti spremljeni.</p>
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
        @endif


        @if ($bad_inputs)
            <br>
            <hr class="bg-danger">

            <p class="text-left">Podaci koji <span class="text-danger">neće</span> biti spremljeni (duplikati ili nevaljali
                unosi).</p>
            <p class="text-left">Polja označena <span class="text-danger">crvenom</span> bojom imaju grešku.</p>
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
                    @foreach ($bad_inputs as $contact)
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
        @endif
    </div>

@endsection
