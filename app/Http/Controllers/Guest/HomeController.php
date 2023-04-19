<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recen_projects = Project::where('published', 1)->orderBy('updated_at', 'DESC')->limit(8)->get();
        return view('guest.home', compact('recen_projects'));
    }
}
