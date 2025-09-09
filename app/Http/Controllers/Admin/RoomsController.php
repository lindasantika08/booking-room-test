<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomsModel;
use App\Models\BookingsModel;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = RoomsModel::all();
        return view('admin.rooms', compact('rooms'));
    }

    public function show($id)
    {
        $room = RoomsModel::findOrFail($id);
        $bookings = BookingsModel::where('room_id', $id)->get();
        return view('admin.room_detail', compact('room', 'bookings'));
    }
}
