<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Exception;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //All Data
        $columns = Column::orderBy('order')->get()->toArray();
        return response()->json(['columns' => json_encode($columns)]);
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
        //Store Column
        try {
            $request->validate([
                'name' => 'required',
            ]);

            // $column = Column::create($request->all());
            $column = new Column();
            $column->name = $request->name;
            $column->order = time();
            $column->save();
            $id = $column->id;
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
        //Update Column data

        try {
            $column = Column::find($id);
            $column->update($request->all());

            $columns = Column::all()->toArray();
            return response()->json(['statuscode' => 200, 'columns' => json_encode($columns)]);

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
        //Destory Column table
        try {
            Column::destroy($id);

            return response()->json(['statuscode' => 200]);
        } catch (Exception $e) {
            return response()->json(['statuscode' => $e]);
        }
    }

    // OrderChange
    public function orderchange(Request $request)
    {
        try{
            $firstId = $request->firstId;
            $firstOrder = Column::where('id', $firstId)->get('order')[0];
            $targetId = $request->targetId;
            $targetOrder = Column::where('id', $targetId)->get('order')[0];
            Column::where('id', $firstId)->update();
            return response()->json(['statuscode' => 200, 'firstOrder' => $firstOrder]);
        } catch (Exception $e) {
            return response()->json(['statuscode' => $e]);
        }
    }
}
