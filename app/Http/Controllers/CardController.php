<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Exception;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Card list
        $cards = Card::orderBy('order')->get()->toArray();
        return response()->json(['cards' => json_encode($cards)]);
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
        //Store Card
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'column_id' => 'required',
            ]);

            Card::create($request->all());
            $card = new Card();
            $card->name = $request->name;
            $card->order = time();
            $card->save();
            $id = $card->id;

            return response()->json(['statuscode' => 200, 'id' => $id]);
        } catch (Exception $e) {
            return response()->json(['statuscode' => $e]);
        }
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
        //Update Card data
        try {
            $card = Card::find($id);
            $card->update($request->all());

            $cards = Card::all()->toArray();
            return response()->json(['statuscode' => 200, 'cards' => json_encode($cards)]);
        } catch (Exception $e) {
            return response()->json(['statuscode' => $e]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Destory Card table
        try {
            Card::destroy($id);

            return response()->json(['statuscode' => 200]);
        } catch (Exception $e) {
            return response()->json(['statuscode' => $e]);
        }
    }
}
