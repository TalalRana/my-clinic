<?php

namespace App\Http\Controllers;

use App\Models\BodyParts;
use Illuminate\Http\Request;

class BodyPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("Hello");
        $draw   = $request->get('draw');
        $start  = $request->get('start');
        $length = $request->get('length');
        $search = (isset($request->search['value']))? $request->search['value'] : false;           

        $limit = " LIMIT ".$length." OFFSET ".$start;
        $raw_qry = "";


        if($search)
        {
            $wh = " AND (body_parts.name LIKE \"%" . $search. "%\" ) ";
            $raw_qry = "SELECT body_parts.id,body_parts.name
                        FROM body_parts
                        ".$wh." Order BY menu_category.name asc";

            // total records
            $raw_qry_count = "SELECT count(*) as total_category FROM body_parts";
            $records_total = DB::select( DB::raw($raw_qry_count) );
            $recordsTotal = $records_total[0]->total_category;

            // filtered or search records
            $categories = DB::select( DB::raw($raw_qry) );
            $recordsFiltered  = count($categories);

            // actual records return to client
            $bodypart = DB::select( DB::raw($raw_qry.$limit) );

        }
        else
        {
            $raw_qry = "SELECT body_parts.id,body_parts.name
            FROM body_parts
            Order BY body_parts.name asc";
            $bodypart = DB::select( DB::raw($raw_qry) );
            $recordsTotal = $recordsFiltered = count($bodypart);
            $bodypart = DB::select( DB::raw($raw_qry. $limit) );

        }

        $resp = array();
        $i = 0;
        foreach($bodypart as $item)
        {

            $resp[$i][0] = $item->name;
           
            $edit_column    = "<a class='btn btn-success mr-2' data-toggle='tooltip' data-placement='bottom'  data-original-title='Tooltip on bottom' href='".url('/edit-body-part')."/".$item->id."'><i title='Edit' class='nav-icon mr-2 i-Pen-2'></i>Edit</a>";
            $view_column    = "<a class='btn btn-warning mr-2' href='".url('/view-body-part')."/".$item->id."'><i title='View' class='nav-icon mr-2 i-Full-View-Window'></i>View</a>" ;
            $action_column =    $edit_column.$view_column;


            $resp[$i][1] = $action_column;
            $i +=1;
        }

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' =>  $recordsFiltered,
            'data' =>  $resp
        );

        return json_encode($data,true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $body_parts = BodyParts::all()->toArray();
        return array_reverse($body_parts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body_part = new BodyParts([
            'name' => $request->input('name')
        ]);
        $body_part->save();

        return response()->json('Body Part Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $body_part = BodyParts::find($id);
        return response()->json($body_part);
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
        $body_part = BodyParts::find($id);
        $body_part->update($request->all());

        return response()->json('Body Part updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $body_part = BodyParts::find($id);
        $body_part->delete();

        return response()->json('Body Part deleted!');
    }
}
