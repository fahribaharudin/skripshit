@extends('layouts.app')

@section('content')
    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="page-header text-center">
                        <h2>Masukan alamat email anda</h2>
                    </div>
                    <form action="{{ url('/mulai') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input name="email" required type="text" class="form-control input-lg text-center" placeholder="Alamat Email">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-success form-control input-lg">Next</button>
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