@extends('layouts.app')

@section('content')
<div class="register-form">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="form-register-close" style="display:flex;justify-content:flex-end;">&times;</div>
                <div class="card-header">Добро пожаловать!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Вы вошли как {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
