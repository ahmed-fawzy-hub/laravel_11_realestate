<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function AgentDashboard(Request $request){
        return view('agent.index');
    }
}
