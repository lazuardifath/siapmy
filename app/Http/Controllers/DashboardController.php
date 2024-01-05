<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Debugbar;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = $user->name;
        session(['profileComplete' => $user->profile_complete]);
        return view('suit.dashboard', compact('data'));
    }

}
