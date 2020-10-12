@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <h3>Pregled podataka</h3>
        @if ($data)
            <a href="javascript:history.back()" class="btn btn-warning mb-4">Natrag na spremanje</a>
        @endif

        <hr class="bg-light">

        @if (!$data)
            <p class="text-left">Datoteka ne sadrži niti jedan valjan unos.</p>
            <a class="text-light" href="/">Natrag</a>
        @else
            <p class="text-left">Podaci koji će biti spremljeni.</p>
            <div>
                <span>Broj zapisa koji će biti spremljeni: <b class="text-success">{{ $counter }}</b></span>
            </div>
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
                            <td>{{ $contact[2] }}</td>
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
                            @if (preg_match('/[0-9]/', $contact[0]))
                                <td class="text-danger">
                                    {{ $contact[0] }}</td>
                            @else
                                <td>{{ $contact[0] }}</td>
                            @endif
                            @if (preg_match('/[0-9]/', $contact[1]))
                                <td class="text-danger">
                                    {{ $contact[1] }}</td>
                            @else
                                <td>{{ $contact[1] }}</td>
                            @endif
                            @if (!preg_match('/^\d+$/', $contact[2]))
                                <td class="text-danger">
                                    {{ $contact[2] }}</td>
                            @else
                                <td>{{ $contact[2] }}</td>
                            @endif
                            @if (preg_match('/[0-9]/', $contact[3]))
                                <td class="text-danger">
                                    {{ $contact[3] }}</td>
                            @else
                                <td>{{ $contact[3] }}</td>
                            @endif
                            @if (preg_match('/[a-zA-Z]/', $contact[4]))
                                <td class="text-danger">
                                    {{ $contact[4] }}</td>
                            @else
                                <td>{{ $contact[4] }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
