@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include ('app.partials.sidebar-user')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Prediksi Kelulusan
                    </div>
                    <div class="panel-body">
                        <div class="page-header" style="margin-top: 0">
                            <h4 class="text-info">Data Kuisioner Anda:</h4>
                        </div>
                        <ol>
                            @foreach ($user->kuisioner as $kuisioner)
                                <li>
                                    @if ($kuisioner->pertanyaan == 'potensi_lulus_tepat_waktu')
                                        Anda adalah mahasiswa dengan status semester {{ $kuisioner->jawaban == 'Tidak' ? 'Lebih dari semester 8' : 'Kurang dari semester 8' }}.
                                    @elseif ($kuisioner->pertanyaan == 'jumlah_organisasi')
                                        Jumlah organisasi yang anda ikuti {{ $kuisioner->jawaban == '> 2' ? 'Lebih dari 2 organisasi sekaligus' : 'Kurang dari 2 organisasi' }}.
                                    @elseif ($kuisioner->pertanyaan == 'waktu_berorganisasi_dalam_sehari')
                                        Waktu yang anda gunakan untuk kegiatan berorganisasi adalah {{ $kuisioner->jawaban == '> dari 6 jam / hari' ? 'Lebih dari 6 jam dalam sehari untuk kegiatan formal, maupun non formal' : 'Kurang dari 6 jam dalam sehari untuk kegiatan formal, maupun non formal' }}.
                                    @elseif ($kuisioner->pertanyaan == 'sudah_kp_atau_kpm')
                                        {{ $kuisioner->jawaban == 'Sudah' ? 'Anda sudah melakukan kegiatan KP ataupun KPM' : 'Anda belum melakukan kegiatan KP ataupun KPM' }}.
                                    @elseif ($kuisioner->pertanyaan == 'event_organisasi_tiap_semester')
                                        Salah satu organisasi yang anda ikuti {{ $kuisioner->jawaban == 'Selalu ada' ? ' selalu ' : ' tidak selalu ' }} menyelenggarakan event yang relative besar tiap semesternya.
                                    @elseif ($kuisioner->pertanyaan == 'pernah_jadi_panitia')
                                        Salah satu organisasi yang anda ikuti {{ $kuisioner->jawaban == 'Sudah pernah' ? ' selalu ' : ' tidak selalu ' }} menyelenggarakan event yang relative besar tiap semesternya.
                                    @elseif ($kuisioner->pertanyaan == 'mata_kuliah_belum_tuntas')
                                        Anda {{ $kuisioner->jawaban == 'Ada' ? ' masih punya ' : ' tidak punya ' }} mata kuliah yang belum tuntas untuk saat ini.
                                    @elseif ($kuisioner->pertanyaan == 'sks_cukup_untuk_kp_atau_kpm')
                                        SKS Anda saat ini {{ $kuisioner->jawaban == 'Cukup' ? ' sudah cukup ' : ' belum cukup ' }} untuk melakukan kegiatan KP atau KPM di universitas.
                                    @elseif ($kuisioner->pertanyaan == 'ingin_lulus_tepat_waktu')
                                        Anda telah menyatakan bahwa anda {{ $kuisioner->jawaban == 'Ya' ? ' ingin ' : ' tidak ingin ' }} lulus tepat waktu.
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('users.prediksi.result', auth()->user()->id) }}" class="btn btn-primary">Lakukan Prediksi Kelulusan Anda >></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection