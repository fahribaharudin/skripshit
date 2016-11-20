@extends('layouts.app')

@section('styles')
    <style>
        ol > li {
            margin-bottom: 25px;
        }
    </style>
@endsection

@section('content')
    <form action="{{ url('/isi-kuisioner') }}" method="POST">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="page-header" style="margin-top: 0; padding-left: 20px">
                    <h3 style="line-height: 1.4em">
                        Silahkan jawab pertanyaan - pertanyaan di bawah ini sebagai acuan sistem
                        untuk melakukan prediksi kelulusan anda.
                    </h3>
                </div>
                <ol>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Berapakah jumlah organisasi yang anda ikuti di kampus?
                        </p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="jumlah_organisasi" value="< 2" type="radio" }} {{ old('jumlah_organisasi') == '< 2' ? 'checked' : '' }}> Kurang dari 2 organisasi</li>
                            <li><input name="jumlah_organisasi" value="> 2" type="radio" }} {{ old('jumlah_organisasi') == '> 2' ? 'checked' : '' }}> Lebih dari 2 organisasi</li>
                        </ul>
                        @if ($errors->has('jumlah_organisasi'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('jumlah_organisasi') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Waktu yang anda gunakan dalam kegiatan berorganisasi
                            dalam sehari untuk kegiatan formal maupun non formal?</p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="waktu_berorganisasi_dalam_sehari" value="< dari 6 jam / hari" type="radio" {{ old('waktu_berorganisasi_dalam_sehari') == '< dari 6 jam / hari' ? 'checked' : '' }}> Kurang dari 6 jam dalam sehari</li>
                            <li><input name="waktu_berorganisasi_dalam_sehari" value="> dari 6 jam / hari" type="radio" {{ old('waktu_berorganisasi_dalam_sehari') == '> dari 6 jam / hari' ? 'checked' : '' }}> Lebih dari 6 jam dalam sehari</li>
                        </ul>
                        @if ($errors->has('waktu_berorganisasi_dalam_sehari'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('waktu_berorganisasi_dalam_sehari') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Apakah anda sudah mengikuti KP atau KPM?</p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="sudah_kp_atau_kpm" value="Sudah" type="radio" {{ old('sudah_kp_atau_kpm') == 'Sudah' ? 'checked' : '' }}> Sudah Mengikuti</li>
                            <li><input name="sudah_kp_atau_kpm" value="Belum" type="radio" {{ old('sudah_kp_atau_kpm') == 'Belum' ? 'checked' : '' }}> Belum</li>
                        </ul>
                        @if ($errors->has('sudah_kp_atau_kpm'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('sudah_kp_atau_kpm') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Apakah setiap semester selalu ada sebuah kegiatan atau
                            event yang relative besar yang di selenggarakan oleh salah satu organisasi yang anda ikuti?</p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="event_organisasi_tiap_semester" value="Selalu ada" type="radio" }} {{ old('event_organisasi_tiap_semester') == 'Selalu ada' ? 'checked' : '' }}> Selalu ada
                            </li>
                            <li><input name="event_organisasi_tiap_semester" value="Tidak selalu" type="radio" }} {{ old('event_organisasi_tiap_semester') == 'Tidak selalu' ? 'checked' : '' }}> Tidak
                                selalu
                            </li>
                        </ul>
                        @if ($errors->has('event_organisasi_tiap_semester'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('event_organisasi_tiap_semester') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Apakah anda pernah ikut menjadi panitia pada kegiatan
                            atau event yang relative besar yang di selenggarakan oleh organisasi anda?</p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="pernah_jadi_panitia" value="Sudah pernah" type="radio" }} {{ old('pernah_jadi_panitia') == 'Sudah pernah' ? 'checked' : '' }}> Sudah pernah</li>
                            <li><input name="pernah_jadi_panitia" value="Belum pernah" type="radio" }} {{ old('pernah_jadi_panitia') == 'Belum pernah' ? 'checked' : '' }}> Belum pernah</li>
                        </ul>
                        @if ($errors->has('pernah_jadi_panitia'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('pernah_jadi_panitia') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Apakah ada salah satu mata kuliah anda yang belum
                            tuntas untuk saat ini?</p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="mata_kuliah_belum_tuntas" value="Ada" type="radio" {{ old('mata_kuliah_belum_tuntas') == 'Ada' ? 'checked' : '' }}> Ada</li>
                            <li><input name="mata_kuliah_belum_tuntas" value="Tidak ada" type="radio" {{ old('mata_kuliah_belum_tuntas') == 'Tidak ada' ? 'checked' : '' }}> Tidak ada</li>
                        </ul>
                        @if ($errors->has('mata_kuliah_belum_tuntas'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('mata_kuliah_belum_tuntas') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Apakah jumlah SKS tempuh anda untuk saat ini sudah
                            memenuhi syarat untuk mengikuti program KP atau KPM di universitas?</p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="sks_cukup_untuk_kp_atau_kpm" value="Cukup" type="radio" {{ old('sks_cukup_untuk_kp_atau_kpm') == 'Cukup' ? 'checked' : '' }}> Sudah memenuhi syarat
                            </li>
                            <li><input name="sks_cukup_untuk_kp_atau_kpm" value="Belum cukup" type="radio" {{ old('sks_cukup_untuk_kp_atau_kpm') == 'Belum cukup' ? 'checked' : '' }}> Belum memenuhi
                                syarat
                            </li>
                        </ul>
                        @if ($errors->has('sks_cukup_untuk_kp_atau_kpm'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('sks_cukup_untuk_kp_atau_kpm') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                    <li>
                        <p><span class="text-info">Pertanyaan: </span>Apakah anda ingin lulus tepat waktu, 8 semester tepat?
                        </p>
                        <span class="text-info">Jawaban:</span>
                        <ul>
                            <li><input name="ingin_lulus_tepat_waktu" value="Ya" type="radio" {{ old('ingin_lulus_tepat_waktu') == 'Ya' ? 'checked' : '' }}> Saya ingin lulus tepat waktu
                            </li>
                            <li><input name="ingin_lulus_tepat_waktu" value="Tidak" type="radio" {{ old('ingin_lulus_tepat_waktu') == 'Tidak' ? 'checked' : '' }}> Saya tidak ingin lulus
                                tepat waktu
                            </li>
                        </ul>
                        @if ($errors->has('ingin_lulus_tepat_waktu'))
                            <br>
                            <span class="alert alert-danger">{{ $errors->first('ingin_lulus_tepat_waktu') }}</span>
                            <br>
                            <br>
                        @endif
                    </li>
                </ol>
            </div>
            <div class="panel-footer">
                <button class="btn btn-lg btn-success">Simpan Jawaban >></button>
            </div>
        </div>
    </form>
@endsection