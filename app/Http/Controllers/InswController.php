<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class InswController extends Controller
{
    use ApiTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPibData(string $aju) 
    {
        return response()->json($this->getPib($aju));
    }

    public function getPebData(string $aju) 
    {
        return response()->json($this->getPeb($aju));
    }


}
