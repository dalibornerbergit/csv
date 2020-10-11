@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        @if (session('mssg'))
            <div class="alert alert-success" role="alert">
                <span>{{ session('mssg') }}</span>
            </div>
            <a class="text-white" href="/contacts">Pregled spremljenih podataka</a>
        @endif

        @if (session('badreq'))
            <div class="alert alert-danger" role="alert">
                <span>{{ session('badreq') }}</span>
            </div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-lg-5">
                <div class="card text-white bg-secondary mt-5">
                    <div class="card-header text-center">
                        <img src="images/csv.png" width="100" height="100" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Odaberite CSV datoteku</h5>

                        <form method="POST" action="{{ route('load') }}" enctype="multipart/form-data">
                            @csrf
                            <input required type="file" name="file" accept=".csv">
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-warning" name="action" value="1" type="submit">Učitaj
                                    podatke</button>
                                <button class="btn btn-success" name="action" value="2" type="submit">Spremi
                                    podatke</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <p>{{ $data ?? '' }}</p>
    </div>
@endsection
