<?php

namespace ChurchIC\Http\Controllers;

use Illuminate\Http\Request;
use ChurchIC\Models\Group;

use ChurchIC\Http\Requests;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $groups = Group::paginate(15);

        return view('integrations.groups.index', compact('groups'));
    }
}