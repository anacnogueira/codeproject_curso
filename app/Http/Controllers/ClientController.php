<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Http\Requests;

class ClientController extends Controller
{
    public function index()
    {
    	
    	return \CodeProject\Client::all();
    }

    public function store(Request $request)
    {
    	return \CodeProject\Client::create($request->all());
    }

    public function show($id)
    {
    	return \CodeProject\Client::find($id);
    }

    public function update(Request $request, $id)
    {
    	$client = \CodeProject\Client::find($id)->update($request->all());

    	if ($client) 
    		return response()->json(['msg'=>'OK'], 200);
    }

    public function destroy($id)
    {
    	$client = \CodeProject\Client::find($id)->delete();

    	if ($client) 
    		return response()->json(['msg'=>'OK'], 200);
    }
}
