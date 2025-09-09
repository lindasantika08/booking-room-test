<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomsModel;

class RoomsController extends Controller
{
    public function dashboard()
    {
        $rooms = RoomsModel::all();
        return view('user.dashboard', compact('rooms'));
    }
    public function index()
    {
        $rooms = RoomsModel::all();
        return view('user.rooms', compact('rooms'));
    }

    public function show($id)
    {
        $room = RoomsModel::findOrFail($id);
        return view('user.show', compact('room'));
    }
}
