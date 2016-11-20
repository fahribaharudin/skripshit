@extends('layouts.app')

@section('content')
    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="page-header text-center">
                        <h2>
                            Buat password baru untuk akun anda <br>
                            <small class="text-info">{{ $email }}</small>
                        </h2>
                    </div>
                    <form action="{{ url('/mulai/step-2') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="name" value="">
                        <div class="form-group">
                            <input name="password" required type="password" class="form-control input-lg text-center" placeholder="Password Anda">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-success form-control input-lg">Simpan</button>
                        </div>
                    </form>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection