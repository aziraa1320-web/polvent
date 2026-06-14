<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function index()
    {
        $histories = LoginHistory::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.login-history.index', compact('histories'));
    }
}
