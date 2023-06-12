<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.subscribers', ['subscribers' => Subscriber::where('deleted', false)->get()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'firstname' => 'string|required',
        //     'middlename' => 'string|required',
        //     'lastname' => 'string|required',
        //     'address' => 'string|required',
        //     'gender' => 'string|required',
        // ]);

        // if(Subscriber::create($request->all())){
        //     return response()->json(['message' => 'Added successfully']);
        // }
        // return response()->json(['message' => 'Failed to add']);

        if($request->ajax()){
            $person = new Subscriber();
            $person->firstname = $request->input('firstname');
            $person->middlename = $request->input('middlename');
            $person->lastname = $request->input('lastname');
            $person->address = $request->input('address');
            $person->gender = $request->input('gender');
            $person->save();

            return response($person);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $id)
    {
        // $providers = DB::table('details')
        //     ->join('subscribers', 'details.subscriber_id', "=", 'subscribers.id')
        //     ->select('details.*')
        //     ->where('details.subscriber_id', $id['id'])->get();

        $results = Detail::where('subscriber_id', $id['id'])->get();

        return view('pages.subscriber-detail', ['providers' => $results, 'subscriber' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $id)
    {
        return view('pages.edit-form', $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $id)
    {
        $id->update($request->all());
        return back()->with('message', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('subscriber_id');
            Subscriber::find($id)->update(['deleted' => true]);
            $message = "Deleted successfully";
            return response(['message' => $message]);
        }
    }
}
