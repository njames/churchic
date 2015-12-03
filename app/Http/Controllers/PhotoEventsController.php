<?php

namespace sc\cic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use sc\cic\Http\Requests;
use sc\cic\Http\Controllers\Controller;
use sc\cic\Models\PhotoEvent;
use sc\cic\Models\PhotoEventParticipants;
use sc\cic\Util\PhotoListImport;

class PhotoEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PhotoEvents = PhotoEvent::all();

        return view('photoevents.index')->with(['PhotoEvents' => $PhotoEvents ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photoevents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        // validate
        $this->validate($request, ['name' => 'required|max:40']);

        // persist
        $id = PhotoEvent::create([ 'client_id' => 'hopeuc',
                                   'name' =>$data['name']
                                 ]);

        // redirect to
        return redirect()->route('PhotoEvents.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $PhotoEvent = PhotoEvent::findOrFail($id);

        return view('photoevents.show', compact('PhotoEvent'));
    }

    /**
     * Handle the loading of the excel file
     *
     * @param $id
     * @param $file
     * @return string
     */
    public function loadExcel(PhotoListImport $import)
    {
        $results = $import->get();

        $results->each(function($row) {
            $data = $row->toArray();
            $data['client_id'] = \Auth::user()->client_id;
            $data['photo_event_id'] = 1; // to work out how to get // change route?
//          column names must be exact // handle if they are not
            PhotoEventParticipants::create($data);

        });
        // redirect
        return redirect()->back();

    }

    /**
     * Handle the loading of photos from dropzone
     *
     * @param $id
     * @param $photo
     * @return string
     */
    public function loadPhoto(Request $request)
    {
        $file = $request->file('file');
        // validate

        // find record by original file name
        $query =  PhotoEventParticipants::where('photo_original_name', $file->getClientOriginalName());
        $participant = $query->first();
//        dd($participant);
//        Image::

        // save file - flyer perhaps to s3 or to mailchimp if that is going to be quick

        $path = 'uploads/photos/' . $participant->photo_event_id;

        $name = time() . $file->getClientOriginalName();
        $tnName = 'tn' . $name;

        //$name2 = Hash::make($file->getClientOriginalName());

        $file->move($path, $name);

        // save smaller version
        Image::make($path . '/' . $name)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/' . $tnName);

        $fileUrl =  url('/') . '/' . $path . '/' . $name ;
        $tnFileUrl = url('/') . '/' . $path . '/' . $tnName ;

        // update record (or create if none created )
        $success = $query->update(['photo_path_large' => $fileUrl,
            'photo_path_small' => $tnFileUrl]);

        if ($success);
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
