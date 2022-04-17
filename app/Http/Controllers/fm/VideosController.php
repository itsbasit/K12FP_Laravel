<?php

namespace App\Http\Controllers\fm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\VideosModel;

class VideosController extends Controller
{
    public function index()
    {
        $data = VideosModel::get();
        return view('dashboard.pages.fm.videos.index', compact('data'));
    }
}
