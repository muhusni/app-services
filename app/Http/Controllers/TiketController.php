<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tiket::all();
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
    public function show(Tiket $tiket)
    {
        $tiketWithReplies = Tiket::with('ticketReplies')->find($tiket->ID);
        return response()->json($tiketWithReplies);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tiket $tiket)
    {
        //
    }
}
