<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()) {
            $transactions = Transaction::with('user', 'room', 'customer')
                ->where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()]])
                ->orderBy('check_out', 'ASC')
                ->orderBy('id', 'DESC')->get();
            return view('dashboard.index', compact('transactions'));
        }
        return view('auth.login');
    }
}
