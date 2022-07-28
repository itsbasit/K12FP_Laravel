<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FmModel;
class ProfileController extends Controller
{
    public function index()
    {
        $data = FmModel::where('user_id',\Auth::user()->id)->first();
        return view('dashboard.pages.profile.index', compact('data'));
    }
}
