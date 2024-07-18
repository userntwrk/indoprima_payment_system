<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Validation";
        $data = DB::select('select no, surat_tagihan, amount, status, convert(varchar(10), due_date, 120) as due_date, supplier, no_hp, tanggal, id_supplier from resume');

        return view('finance.validate', compact('data', 'title'));
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
        try {
            $suratTagihan = $request->input('surat_tagihan');
            $selectedDateTime = $request->input('selected_datetime');
            $newStatus = $request->input('new_status');

            // Update status in "main" table
            DB::table('main')->where('surat_tagihan', $suratTagihan)->update([
                'status' => $newStatus
            ]);                        

            // Update status and due date in "resume" table
            DB::table('resume')->where('surat_tagihan', $suratTagihan)->update([
                'status' => $newStatus,
                'due_date' => $selectedDateTime
            ]);

            return response()->json(['message' => 'Due date and status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the due date and status'], 500);
        }
    }



    public function show($surat_tagihan)
    {
        $title = "Validation Detail";
        $data = DB::select('SELECT *, a.amount, b.supplier, b.no_hp, b.status 
        FROM main a LEFT JOIN resume b ON a.surat_tagihan = b.surat_tagihan WHERE a.surat_tagihan = ?', [$surat_tagihan]);

        return view('finance.detail', compact('data', 'title'));
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