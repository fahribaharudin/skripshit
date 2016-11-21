@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include ('app.partials.sidebar-user')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body" style="min-height: 400px">
                    <p class="lead">Selamat datang di halaman dashboard!</p>
                    <p class="text-info">Silahkan pilih menu pada sidebar di sebelah kiri halaman dashboard.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
