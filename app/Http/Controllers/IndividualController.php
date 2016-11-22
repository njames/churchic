<?php

namespace sc\cic\Http\Controllers;

use Illuminate\Http\Request;

use sc\cic\Http\Requests;
use sc\cic\Http\Controllers\Controller;
use sc\cic\Models\ClientConnection;
use sc\cic\ApiHelpers\CcbApi;

class IndividualController extends Controller
{
    protected $ccbApi;

    public function __construct()
    {
        $clientConnection = ClientConnection::where('client_id', '=', 'hopeuc')
                                          ->where('source_name', '=', 'CCB')->first();

        $this->ccbApi = new CcbApi($clientConnection->client_id, $clientConnection->username, $clientConnection->password);
    }

    public function updateType()
    {
        $individualId = 4655; 
        $type = 1;

        $returnValue = $this->ccbApi->individualUpdateType($individualId, $type);

        if ($returnValue->statusCode == 200 )
        {
            return 'Updated Successfully';
        }

        // dd($returnValue);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hello";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
