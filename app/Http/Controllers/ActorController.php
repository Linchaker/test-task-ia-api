<?php

namespace App\Http\Controllers;

use App\Models\Managers\ActorManager;

class ActorController extends Controller
{
    public function index()
    {
        $actors = ActorManager::getAll(10);
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }
}
