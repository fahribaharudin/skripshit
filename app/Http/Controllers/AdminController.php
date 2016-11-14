<?php

namespace App\Http\Controllers;

use App\DokumenLearning;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdminDashboard()
    {
        return view('app.admin.dashboard');
    }

    public function indexDokumenLearning()
    {
        $dokumenLearning = DokumenLearning::all();

        return view('app.admin.dokumen-learning.index')
            ->with('dokumenLearning', $dokumenLearning);
    }

    public function indexUsers()
    {
        $users = User::all();

        return view('app.admin.users.index')
            ->with('users', $users);
    }
}
