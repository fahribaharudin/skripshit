<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // read data from excel file
        $kuisioner = Excel::load(storage_path('Survey keorganisasian (Tanggapan).xlsx'), function($reader) {})->get();
        $dataKuisioner = [];

        foreach ($kuisioner as $jawaban) {
            if ($jawaban->alamat_email_anda == null) {
                continue;
            }

            $dataMahasiswa = new stdClass();
            $dataMahasiswa->email = $jawaban->alamat_email_anda;
            $dataMahasiswa->potensi_lulus_tepat_waktu = $jawaban->tingkat_semester_anda_saat_ini == 'Kurang dari semester 8' ? 'Ya' : 'Tidak';
            $dataMahasiswa->jumlah_organisasi = $jawaban->berapa_jumlah_organisasi_yang_pernah_anda_ikuti_di_kampus == 'Lebih dari 2 organisasi' ? '> 2' : '< 2';
            $dataMahasiswa->waktu_berorganisasi_dalam_sehari = $jawaban->perkiraan_waktu_yang_anda_gunakan_untuk_kegiatan_berorganisasi_di_kampus_dalam_sehari_kegiatan_formal_ataupun_non_formal == 'Lebih dari 6 jam dalam sehari' ? '> 6 jam / hari' : '< 6 jam / hari';
            $dataMahasiswa->sudah_kp_atau_kpm = $jawaban->apakah_organisasi_yang_anda_ikuti_mempengaruhi_anda_dalam_melaksanakan_program_kp_atau_kpm_di_kampus_apakah_anda_sudah_melaksanakan_program_kp_atau_kpm;
            $dataMahasiswa->event_organisasi_tiap_semester = $jawaban->apakah_setiap_semester_selalu_ada_kegiatan_event_yang_relatif_besar_yang_di_selenggarakan_oleh_organisasi_anda;
            $dataMahasiswa->pernah_jadi_panitia = $jawaban->apakah_anda_ikut_menjadi_panitia_dalam_event_yang_diselenggarakan_oleh_organisasi_anda_menjadi_panitia;
            $dataMahasiswa->mata_kuliah_belum_tuntas = $jawaban->apakah_ada_mata_kuliah_anda_yang_belum_tuntas_untuk_saat_ini;
            $dataMahasiswa->sks_cukup_untuk_kp_atau_kpm = $jawaban->apakah_jumlah_semester_tempuh_anda_saat_ini_sudah_memenuhi_untuk_mengikuti_kegiatan_kp_atau_kpm_di_kampus == 'SKS tempuh sudah memenuhi' ? 'Cukup' : 'Belum cukup';
            $dataMahasiswa->ingin_lulus_tepat_waktu = $jawaban->apakah_anda_ingin_lulus_tepat_waktu_8_semester_tepat == 'Saya ingin lulus tepat waktu' ? 'Ya' : 'Tidak';
            $dataMahasiswa->timestamp = $jawaban->timestamp;

            $dataKuisioner[] = $dataMahasiswa;
        }

        // save to db
        App\User::truncate();
        App\Role::truncate();
        App\Kuisioner::truncate();
        App\DokumenLearning::truncate();
        DB::table('user_role')->truncate();

        $role = new App\Role;
        $role->role_name = 'Standar User';
        $role->save();

        $role2 = new App\Role;
        $role2->role_name = 'Admin';
        $role2->save();

        foreach ($dataKuisioner as $data) {
            $user = new App\User();
            $user->name = '';
            $user->email = $data->email;
            $user->password = bcrypt('Password');
            $user->save();
            $user->roles()->attach($role->id);

            foreach (get_object_vars($data) as $key => $value) {
                if ($key == 'email' || $key == 'timestamp') {
                    continue;
                }

                $kuisioner = new App\Kuisioner();
                $kuisioner->user()->associate($user);
                $kuisioner->pertanyaan = $key;
                $kuisioner->jawaban = $value;
                $kuisioner->save();
            }
        }

        $fahri = App\User::where('email', 'fahrybaharudin@gmail.com')->first();
        $fahri->roles()->attach(2);
        $fahri->name = 'Fahri Baharudin';
        $fahri->save();

        foreach (App\User::all() as $user) {
            $dokumenLearning = new \App\DokumenLearning();
            foreach ($user->kuisioner as $kuisioner) {
                if ($kuisioner->pertanyaan == 'potensi_lulus_tepat_waktu')
                    $dokumenLearning->class = $kuisioner->jawaban == 'Tidak' ? 'Lulus tepat waktu' : 'Tidak tepat waktu';
                elseif ($kuisioner->pertanyaan == 'jumlah_organisasi')
                    $dokumenLearning->jumlah_organisasi = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'waktu_berorganisasi_dalam_sehari')
                    $dokumenLearning->waktu_berorganisasi = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'sudah_kp_atau_kpm')
                    $dokumenLearning->sudah_kp_atau_kpm = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'event_organisasi_tiap_semester')
                    $dokumenLearning->event_organisasi_tiap_semester = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'pernah_jadi_panitia')
                    $dokumenLearning->jadi_panitia = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'mata_kuliah_belum_tuntas')
                    $dokumenLearning->makul_belum_tuntas = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'sks_cukup_untuk_kp_atau_kpm')
                    $dokumenLearning->sks_cukup = $kuisioner->jawaban;
                elseif ($kuisioner->pertanyaan == 'ingin_lulus_tepat_waktu')
                    $dokumenLearning->ingin_lulus_tepat_waktu = $kuisioner->jawaban;
            }

            $dokumenLearning->save();
        }
    }
}
