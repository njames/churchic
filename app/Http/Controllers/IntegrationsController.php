<?php

namespace ChurchIC\Http\Controllers;

use Illuminate\Http\Request;

use ChurchIC\Http\Requests;

class IntegrationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');
    }

    public function show()
    {
        return view('integrations.index');
    }


}
