<?php

namespace App\Http\Controllers;

use App\Kuisioner;
use App\User;

class UsersController extends Controller
{
    public function getUsersDashboard()
    {
        return view('app.user.dashboard');
    }

    public function getProfil($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('app.user.profile')
            ->with('user', $user);
    }

    public function getKuisioner($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('app.user.kuisioner')
            ->with('user', $user);
    }

    public function postKuisioner($user_id)
    {
        $user = User::findOrFail($user_id);
        foreach ($user->kuisioner as $kuisioner) {
            if ($kuisioner->pertanyaan == 'potensi_lulus_tepat_waktu') continue;
            $kuisioner->jawaban = request()->get($kuisioner->pertanyaan);
            $kuisioner->save();
        }

        return redirect()->route('users.prediksi.create', $user_id);
    }

    public function getPrediksiKelulusan($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('app.user.prediksi.create')
            ->with('user', $user);
    }

    public function getHasilPrediksi($user_id)
    {
        $user = User::with('kuisioner')->where('id', $user_id)->first();
        $hasilPrediksi = $user->makePrediksiKelulusan();

        return view('app.user.prediksi.hasil-prediksi')->with('user', $user)->with('hasilPrediksi', $hasilPrediksi);
    }
}