<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_learnings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class', 50);
            $table->string('jumlah_organisasi', 50);
            $table->string('waktu_berorganisasi', 50);
            $table->string('sudah_kp_atau_kpm', 50);
            $table->string('event_organisasi_tiap_semester', 50);
            $table->string('jadi_panitia', 50);
            $table->string('makul_belum_tuntas', 50);
            $table->string('sks_cukup', 50);
            $table->string('ingin_lulus_tepat_waktu', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_learnings');
    }
}
