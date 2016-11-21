@extends('layouts.app')

@section('styles')
    <style>
        ol > li {
            padding-right: 250px;
        }
        ol > li {
            margin-bottom: 50px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include ('app.partials.sidebar-user')
            </div>
            <div class="col-md-9">
                <form action="{{ route('users.kuisioner.store', auth()->user()->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Kuisioner Anda
                        </div>
                        <div class="panel-body">

                            <ol>
                                @foreach ($user->kuisioner as $kuisioner)
                                    @if ($kuisioner->pertanyaan == 'jumlah_organisasi')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Berapakah jumlah organisasi yang anda ikuti di kampus?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="jumlah_organisasi" value="< 2" type="radio" {{ $kuisioner->jawaban != '> 2' ? 'checked' : '' }}> Kurang dari 2 organisasi</li>
                                                <li><input name="jumlah_organisasi" value="> 2" type="radio" {{ $kuisioner->jawaban == '> 2' ? 'checked' : '' }}> Lebih dari 2 organisasi</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'waktu_berorganisasi_dalam_sehari')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Waktu yang anda gunakan dalam kegiatan berorganisasi dalam sehari untuk kegiatan formal maupun non formal?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="waktu_berorganisasi_dalam_sehari" value="< dari 6 jam / hari" type="radio" {{ $kuisioner->jawaban == '< dari 6 jam / hari' ? 'checked' : '' }}> Kurang dari 6 jam dalam sehari</li>
                                                <li><input name="waktu_berorganisasi_dalam_sehari" value="> dari 6 jam / hari" type="radio" {{ $kuisioner->jawaban == '> dari 6 jam / hari' ? 'checked' : '' }}> Lebih dari 6 jam dalam sehari</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'sudah_kp_atau_kpm')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Apakah anda sudah mengikuti KP atau KPM?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="sudah_kp_atau_kpm" value="Sudah"  type="radio" {{ $kuisioner->jawaban == 'Sudah' ? 'checked' : '' }}> Sudah Mengikuti</li>
                                                <li><input name="sudah_kp_atau_kpm" value="Belum"  type="radio" {{ $kuisioner->jawaban != 'Sudah' ? 'checked' : '' }}> Belum</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'event_organisasi_tiap_semester')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Apakah setiap semester selalu ada sebuah kegiatan atau event yang relative besar yang di selenggarakan oleh salah satu organisasi yang anda ikuti?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="event_organisasi_tiap_semester" value="Selalu ada"  type="radio" {{ $kuisioner->jawaban == 'Selalu ada' ? 'checked' : '' }}> Selalu ada</li>
                                                <li><input name="event_organisasi_tiap_semester" value="Tidak selalu"  type="radio" {{ $kuisioner->jawaban != 'Selalu ada' ? 'checked' : '' }}> Tidak selalu</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'pernah_jadi_panitia')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Apakah anda pernah ikut menjadi panitia pada kegiatan atau event yang relative besar yang di selenggarakan oleh organisasi anda?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="pernah_jadi_panitia" value="Sudah pernah"  type="radio" {{ $kuisioner->jawaban == 'Sudah pernah' ? 'checked' : '' }}> Sudah pernah</li>
                                                <li><input name="pernah_jadi_panitia" value="Belum pernah"  type="radio" {{ $kuisioner->jawaban != 'Sudah pernah' ? 'checked' : '' }}> Belum pernah</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'mata_kuliah_belum_tuntas')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Apakah ada salah satu mata kuliah anda yang belum tuntas untuk saat ini?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="mata_kuliah_belum_tuntas" value="Ada"  type="radio" {{ $kuisioner->jawaban == 'Ada' ? 'checked' : '' }}> Ada</li>
                                                <li><input name="mata_kuliah_belum_tuntas" value="Tidak ada"  type="radio" {{ $kuisioner->jawaban != 'Ada' ? 'checked' : '' }}> Tidak ada</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'sks_cukup_untuk_kp_atau_kpm')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Apakah jumlah SKS tempuh anda untuk saat ini sudah memenuhi syarat untuk mengikuti program KP atau KPM di universitas?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="sks_cukup_untuk_kp_atau_kpm" value="Cukup"  type="radio" {{ $kuisioner->jawaban == 'Cukup' ? 'checked' : '' }}> Sudah memenuhi syarat</li>
                                                <li><input name="sks_cukup_untuk_kp_atau_kpm" value="Belum cukup"  type="radio" {{ $kuisioner->jawaban != 'Cukup' ? 'checked' : '' }}> Belum memenuhi syarat</li>
                                            </ul>
                                        </li>
                                    @elseif ($kuisioner->pertanyaan == 'ingin_lulus_tepat_waktu')
                                        <li>
                                            <p><span class="text-info">Pertanyaan: </span>Apakah anda ingin lulus tepat waktu, 8 semester tepat?</p>
                                            <span class="text-info">Jawaban:</span>
                                            <ul>
                                                <li><input name="ingin_lulus_tepat_waktu" value="Ya"  type="radio" {{ $kuisioner->jawaban == 'Ya' ? 'checked' : '' }}> Saya ingin lulus tepat waktu</li>
                                                <li><input name="ingin_lulus_tepat_waktu" value="Tidak"  type="radio" {{ $kuisioner->jawaban != 'Ya' ? 'checked' : '' }}> Saya tidak ingin lulus tepat waktu</li>
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>

                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary">Simpan Jawaban Kuisioner >></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection