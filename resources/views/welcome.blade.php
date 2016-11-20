@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>Selamat Datang</h1>
        <p style="font-family: sans-serif">Aplikasi '{{ config('app.name', 'NBC Classifier') }}' ini dapat membantu anda untuk memprediksi kelulusan berdasarkan kegiatan berorganisasi anda di kampus, silahkan mulai aplikasi untuk mencobanya.</p>
        <p style="font-family: sans-serif">Semoga Bermanfaat, Terimakasih</p>
        <p><a class="btn btn-lg btn-success" href="{{ url('/mulai') }}" role="button">Mulai Aplikasi</a></p>
    </div>
@endsection