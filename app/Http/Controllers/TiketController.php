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
        $tikets = Tiket::with('ticketReplies')->paginate(10);

        $tikets->each(function ($tiket) {
            $tiket->ticket_IKC = null; // Initialize to null
    
            $tiket->ticketReplies->each(function ($reply) use ($tiket) {
                if (strpos($reply->body, 'IKC') !== false) {
                    preg_match('/\b\d{6}\b/', $reply->body, $matches);
    
                    // Check if a 6-digit number is found
                    $sixDigitNumber = isset($matches[0]) ? $matches[0] : null;
                    if (!($sixDigitNumber === null)) $tiket->ticket_IKC = $sixDigitNumber;
                }
            });
        });
    
        return $tikets;
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
        $tiketWithReplies->ticket_IKC = null;
        
        $tiketWithReplies->ticketReplies->each(function ($reply) use ($tiketWithReplies) {
            if (strpos($reply->body, 'IKC') !== false) {
                preg_match('/\b\d{6}\b/', $reply->body, $matches);

                // Check if a 6-digit number is found
                $sixDigitNumber = isset($matches[0]) ? $matches[0] : null;

                $tiketWithReplies->ticket_IKC = $sixDigitNumber;
            }
        });
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
