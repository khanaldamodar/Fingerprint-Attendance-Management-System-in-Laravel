<?php
namespace App\Http\Controllers;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('user')->latest()->paginate(20);
        return view('index', compact('attendances'));
    }
}
