<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use DataTables;
class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscriber::latest()->get();
            return DataTables::of($data)
                ->addColumn('source', function($row){
                    switch($row->source){
                        case 'Facebook':
                            return '<h5><i class="fa fa-facebook"></i></h5>';
                            break;
                        case 'Google':
                            return '<h5><i class="fa fa-google"></i></h5>';
                            break;
                        case 'Instagram':
                            return '<h5><i class="fa fa-instagram"></i></h5>';
                            break;
                        case 'Youtube':
                            return '<h5><i class="fa fa-youtube"></i></h5>';
                            break;
                        case 'LinkedIn':
                            return '<h5><i class="fa fa-linkedin"></i></h5>';
                            break;

                    }
                })
                ->addColumn('is_newsletter', function($row){
                    return ($row->is_newsletter) ? '<h4><i class="fa fa-check"></i></h4>' : '<h4><i class="fa fa-times"></i></h4>';
                })
                ->addColumn('action', function($row){
                    $confirm = "return confirm('Are your sure to delete?')";
                    $btn = '
                    <a href="'.route('subscribers.edit', $row->id).'" class="edit btn btn-secondary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

                    <a href="'.route('subscribers.destroy', $row->id).'" onClick="'.$confirm.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>  Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'source', 'is_newsletter'])
                ->make(true);
        }
        return view('subscribers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'email' => 'required|unique:subscribers|max:255',
            'name' => 'required',
            'source' => 'required'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->name = $request->name;
        $subscriber->source = $request->source;
        $subscriber->is_newsletter = ($request->is_newsletter) ? 1 : 0;

        $subscriber->save();
        return redirect('subscribers')->with('success', 'Successfully Added!');

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
    public function edit(Subscriber $subscriber)
    {
        return view('subscribers.edit')->with('subscriber', $subscriber);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        $request->validate([
            'email' => 'required|unique:subscribers|max:255',
            'email' => 'unique:subscribers,email,'.$subscriber->id,
            'name' => 'required',
            'source' => 'required'
        ]);
        $subscriber->email = $request->email;
        $subscriber->name = $request->name;
        $subscriber->source = $request->source;
        $subscriber->is_newsletter = ($request->is_newsletter) ? 1 : 0;
        $subscriber->save();
        return redirect('subscribers')->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        if($subscriber)
        {
            $subscriber->delete();
            return redirect('subscribers')->with('success', 'Deleted Successfully!');
        }
    }
}
