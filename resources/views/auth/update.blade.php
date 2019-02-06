
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        Profil
                    </div>
                    <div class="card-body">
                        {!! form($form) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
