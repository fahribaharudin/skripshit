<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mulai', function() { return view('app.mulai'); });
Route::post('/mulai', function() { $email =  request()->get('email'); return redirect()->to('/mulai/step-2')->with('email', $email); });

Route::get('/mulai/step-2', function() {
    if ( ! request()->session()->has('email')) return redirect()->to('/mulai');
    return view('app.mulai-step-2')->with('email', request()->session()->get('email'));
});

Route::post('/mulai/step-2', function() {
    if (App\User::where('email', request()->get('email'))->count() != 0) return redirect()->to('/mulai')->with('error', 'email sudah di pakai oleh user lain');

    $user = new App\User;
    $user->name = '';
    $user->email = request()->get('email');
    $user->password = bcrypt(request()->get('password'));
    $user->save();

    Auth::login($user);

    return redirect()->to('/isi-kuisioner');
});

Route::get('/isi-kuisioner', function() {
    return view('app.isi-kuisioner');
});

Route::post('/isi-kuisioner', function() {
    $validator = Validator::make(request()->all(), [
        'jumlah_organisasi' => 'required',
        'waktu_berorganisasi_dalam_sehari' => 'required',
        'sudah_kp_atau_kpm' => 'required',
        'event_organisasi_tiap_semester' => 'required',
        'pernah_jadi_panitia' => 'required',
        'mata_kuliah_belum_tuntas' => 'required',
        'sks_cukup_untuk_kp_atau_kpm' => 'required',
        'ingin_lulus_tepat_waktu' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    foreach (request()->except('_token') as $pertanyaan => $jawaban) {
        $kuisioner = new App\Kuisioner();
        $kuisioner->user()->associate(auth()->user());
        $kuisioner->pertanyaan = $pertanyaan;
        $kuisioner->jawaban = $jawaban;
        $kuisioner->save();
    }

    return redirect()->to('/hasil-kuisioner');
});

Route::get('/hasil-kuisioner', function() {
    $user = auth()->user();

    return view('app.hasil-kuisioner')->with('user', $user);
});

Route::get('/get-prediksi', function() {
   $user = auth()->user();

    return $user->makePrediksiKelulusan();
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', ['as' => 'home', 'uses' => 'UsersController@getUsersDashboard']);
    Route::get('/user/{user_id}/profil', ['as' => 'users.profile', 'uses' => 'UsersController@getProfil']);
    Route::get('/user/{user_id}/kuisioner', ['as' => 'users.kuisioner', 'uses' => 'UsersController@getKuisioner']);
    Route::post('/user/{user_id}/kuisioner', ['as' => 'users.kuisioner.store', 'uses' => 'UsersController@postKuisioner']);
    Route::get('/user/{user_id}/prediksi', ['as' => 'users.prediksi.create', 'uses' => 'UsersController@getPrediksiKelulusan']);
    Route::get('/user/{user_id}/get-hasil-prediksi', ['as' => 'users.prediksi.result', 'uses' => 'UsersController@getHasilPrediksi']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'AdminController@getAdminDashboard');
    Route::get('/dokumen-learning', 'AdminController@indexDokumenLearning');
    Route::get('/users', 'AdminController@indexUsers');
});

Route::get('/demo', function() {
    return view('demo');
});