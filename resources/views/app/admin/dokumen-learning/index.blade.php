@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include ('app.partials.sidebar-admin')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 200px">Class</th>
                                    <th>Jumlah Organisasi</th>
                                    <th>Waktu Berorganisasi</th>
                                    <th>Sudah KP atau KPM</th>
                                    <th>Event Organisasi Tiap Semester</th>
                                    <th>Jadi Panitia</th>
                                    <th>Makul Belum Tuntas</th>
                                    <th>SKS Cukup</th>
                                    <th>Ingin Lulus Tepat Waktu</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($dokumenLearning as $dokumen)
                                    <tr>
                                        <td>{{ $dokumen->id }}</td>
                                        <td><div class="label {{ $dokumen->class == 'Lulus tepat waktu' ? 'label-success' : 'label-danger' }}">{{ $dokumen->class }}</div></td>
                                        <td>{{ $dokumen->jumlah_organisasi }}</td>
                                        <td>{{ $dokumen->waktu_berorganisasi }}</td>
                                        <td>{{ $dokumen->sudah_kp_atau_kpm }}</td>
                                        <td>{{ $dokumen->event_organisasi_tiap_semester }}</td>
                                        <td>{{ $dokumen->jadi_panitia }}</td>
                                        <td>{{ $dokumen->makul_belum_tuntas }}</td>
                                        <td>{{ $dokumen->sks_cukup }}</td>
                                        <td>{{ $dokumen->ingin_lulus_tepat_waktu }}</td>
                                        <td><a href="#" class="btn btn-danger btn-xs">Hapus</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection