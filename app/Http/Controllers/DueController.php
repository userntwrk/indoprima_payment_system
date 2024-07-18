<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Due Date';
        $data = DB::select('SELECT * FROM resume');

        return view('finance.due', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function insertDueDate(Request $request)
    // {        
    //     $suratTagihan = $request->input('surat_tagihan');
    //     $dueDayValues = $request->input('due_date');

    //     foreach ($dueDayValues as $dueDay) {
    //         $dueDate = Carbon::now()->setDay($dueDay);
    //         $data = DB::select('SELECT * FROM resume');

    //         // Update records in the "resumes" table based on surat_tagihan
    //         DB::statement("UPDATE resume SET due_date = ? WHERE surat_tagihan = ?", [
    //             $dueDate,
    //             $suratTagihan,
    //         ]);
    //     }

    //     return view('finance.due', compact('data'));
    // }


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
    // public function store(Request $request)
    // {        
    //     $suratTagihan = $request->input('surat_tagihan');
    //     $dueDayValues = $request->input('due_date');

    //     foreach ($dueDayValues as $dueDay) {
    //         $dueDate = Carbon::now()->setDay($dueDay);            

    //         // Update records in the "resumes" table based on surat_tagihan
    //         DB::statement("UPDATE resume SET due_date = ? WHERE surat_tagihan = ?", [
    //             $dueDate,
    //             $suratTagihan,
    //         ]);
    //     }

    //     return back()->with('success', 'Due Date has been set successfully.');
    // }

    public function store(Request $request)
    {
        $suratTagihan = $request->input('surat_tagihan');
        $selectedDateTime = $request->input('selected_datetime');

        // Convert the selected datetime to a Carbon instance
        $dueDateTime = Carbon::parse($selectedDateTime);

        // Update records in the "resumes" table based on surat_tagihan
        DB::table('resume')->where('surat_tagihan', $suratTagihan)->update(['due_date' => $dueDateTime]);

        return response()->json(['message' => 'Due Date and Time have been updated successfully.']);
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