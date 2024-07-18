<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Lang;
use DB;



class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Home";
        $data = DB::select('SELECT * FROM resume WHERE id_supplier = ?', [auth()->user()->id]);

        return view('supplier.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Supplier Form";

        return view('supplier.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $formData = $request->all();
        $rowCount = count($formData['no']);

        $dataToInsertMain = array();
        $totalAmount = 0;

        $lastNoInResume = DB::table('resume')->max('no');
        $suratTagihanPrefix = 'STR' . ($lastNoInResume + 1);

        for ($i = 0; $i < $rowCount; $i++) {
            $no = 0 + $i + 1;
            $invoice = $formData['invoice'][$i];
            $amount = $formData['amount'][$i];
            $status = $formData['status'][$i];
            $tanggal = $formData['tanggal'][$i];

            if (!empty($invoice) && !empty($amount)) {
                $data = array(
                    'no' => $no,
                    'invoice' => $invoice,
                    'amount' => $amount,
                    'status' => $status,
                    'tanggal' => $tanggal,
                    'surat_tagihan' => $suratTagihanPrefix,
                );

                $dataToInsertMain[] = $data;
                $totalAmount += $amount; // Calculate the total amount
            }
        }

        if (!empty($dataToInsertMain)) {
            DB::table('resume')->insert([
                'no' => $lastNoInResume + 1,
                'surat_tagihan' => $suratTagihanPrefix,
                'amount' => $totalAmount,
                'supplier' => '',
                // Set an empty value for 'supplier' as it will be updated later
                'no_hp' => '',
                // Set an empty value for 'no_hp' as it will be updated later
                'tanggal' => now(),
                // Set the current time for the 'tanggal' column
                'id_supplier' => '', // Set an empty value for 'id_supplier' as it will be updated later
            ]);

            DB::table('main')->insert($dataToInsertMain);

            // Now update the 'resume' table with the supplier information from the logged-in user
            $user = auth()->user();
            if ($user) {
                DB::table('resume')
                    ->where('surat_tagihan', $suratTagihanPrefix)
                    ->update([
                        'supplier' => $user->name,
                        'no_hp' => $user->no_hp,
                        'id_supplier' => $user->id,
                    ]);
            }
        }

        return redirect('/index')->with('success', 'Data Added successfully.');
    }

    public function cetakPdf($surat_tagihan, Request $request)
    {                
        // head digunakan untuk 2 fungsi pemanggilan,
        // 1. untuk data per satuan
        // 2. untuk perulangan pada invoice beserta amountnya (foreach pada invoice.blade.php)
        $head = DB::select("EXEC cetak '$surat_tagihan'"); 
        $data = DB::table('main')->where('surat_tagihan', $surat_tagihan)->get(); 

        $surat_tagihan = '';
        $supplier = '';
        $alamat = '';
        $no_hp = '';
        $amount_total = '';
        $amount_perinvoice = '';
        $tanggal = '';

        // hanya digunakan untuk definisi variabel diatas
        foreach ($head as $head) {
            $surat_tagihan = $head->surat_tagihan;
            $supplier = $head->supplier;
            $alamat = $head->alamat;
            $no_hp = $head->no_hp;
            $amount_total = $head->amount_total;
            $amount_perinvoice = $head->amount_perinvoice;
            $tanggal = $head->tanggal;
        }

        $head = array(
            'surat_tagihan' => $head->surat_tagihan,
            'supplier' => $head->supplier,
            'alamat' => $head->alamat,
            'no_hp' => $head->no_hp,
            'amount_total' => $head->amount_total,
            'amount_perinvoice' => $head->amount_perinvoice,
            'tanggal' => $head->tanggal,
        );        

        // dd($head, $data);
        // per item satuan dipanggil satu persatu
        $pdf = PDF::loadview('supplier.invoice', compact('head', 'data'), ["surat_tagihan"=>$surat_tagihan, "supplier"=>$supplier, "alamat"=>$alamat, "no_hp"=>$no_hp, "amount_total"=>$amount_total, "amount_perinvoice"=>$amount_perinvoice, "tanggal"=>$tanggal]);
        return $pdf->stream();
    }

    // public function printInvoice($surat_tagihan)
    // {
    //     // Fetch the main data from the 'main' table
    //     $main = DB::table('main')->where('surat_tagihan', $surat_tagihan)->first();

    //     if (!$main) {
    //         abort(404, 'Invoice not found.');
    //     }

    //     // Fetch the resume data from the 'resume' table based on the 'surat_tagihan'
    //     $resume = DB::table('resume')->where('surat_tagihan', $surat_tagihan)->first();

    //     // Fetch the user data from the 'users' table based on the 'id_supplier' (buyer details)
    //     $buyer = null;
    //     // Replace 'users' with the actual table name containing buyer details if needed
    //     if ($resume && $resume->id_supplier) {
    //         $buyer = DB::table('users')->where('id', $resume->id_supplier)->first();
    //     }

    //     // Fetch the invoice items data from the 'main' table
    //     $invoiceItems = DB::table('main')->where('surat_tagihan', $surat_tagihan)->get()->toArray();

    //     // Prepare the data for the PDF invoice
    //     $data = (object) [
    //         'invoice' => (object) [
    //             'name' => $main->invoice,
    //             'status' => $main->status,
    //             'seller' => null,
    //             'buyer' => $buyer ? (object) [
    //                 'name' => $buyer->name,
    //                 'address' => $buyer->alamat,
    //                 'phone' => $buyer->no_hp,
    //                 'custom_fields' => [], // Add custom fields here if needed
    //             ] : null,
    //             'items' => $invoiceItems,
    //             'table_columns' => 7,
    //             'hasItemUnits' => false,
    //             'hasItemDiscount' => false,
    //             'hasItemTax' => false,
    //             'total_discount' => 0,
    //             'taxable_amount' => 0,
    //             'tax_rate' => 0,
    //             'total_taxes' => 0,
    //             'shipping_amount' => 0,
    //             'total_amount' => $main->amount,
    //             'notes' => '',
    //             'getSerialNumber' => function () use ($main) {
    //                 return 'INV-' . $main->no;
    //             },
    //             'getDate' => function () use ($main) {
    //                 return date('Y-m-d', strtotime($main->created_at));
    //             },
    //             'formatCurrency' => function ($amount) {
    //                 return 'Rp ' . number_format($amount, 2, ',', '.');
    //             },
    //             'getTotalAmountInWords' => function () use ($main) {
    //                 return ucwords(Lang::get('invoices::invoice.amount_in_words', [
    //                     'number' => $main->amount,
    //                     'currency' => 'rupiah',
    //                 ]));
    //             },
    //             'getPayUntilDate' => function () use ($resume) {
    //                 return $resume ? date('Y-m-d', strtotime($resume->due_date)) : '';
    //             },
    //         ],
    //     ];

    //     // Generate the PDF invoice
    //     $pdf = PDF::loadView('supplier.invoice', ['data' => (array)$data]);

    //     // Display the PDF in the browser
    //     return $pdf->stream();
    // }


    // public function store(Request $request)
    // {
    //     $formData = $request->all();

    //     $rowCount = count($formData['no']);

    //     $dataToInsert = array();

    //     for ($i = 0; $i < $rowCount; $i++) {
    //         $no = $formData['no'][$i];
    //         $invoice = $formData['invoice'][$i];
    //         $amount = $formData['amount'][$i];
    //         $status = $formData['status'][$i];
    //         $tanggal = $formData['tanggal'][$i];

    //         if (!empty($invoice) && !empty($amount)) {
    //             $data = array(
    //                 'no' => $no,
    //                 'invoice' => $invoice,
    //                 'amount' => $amount,
    //                 'status' => $status,
    //                 'tanggal' => $tanggal
    //             );

    //             $dataToInsert[] = $data;
    //         }          
    //     }

    //     DB::table('main')->insert($dataToInsert);

    //     // dd($data);
    //     return redirect('/index')->with('success', 'Data Added successfully.');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($surat_tagihan)
    {
        $title = "Detail Tagihan";
        $data = DB::table('main')->where('surat_tagihan', $surat_tagihan)->get();

        // $data = DB::select('SELECT *, b.supplier, b.no_hp, b.status 
        // FROM main a LEFT JOIN resume b ON a.surat_tagihan = b.surat_tagihan WHERE a.surat_tagihan = ?', [$surat_tagihan]);

        return view('supplier.detail', compact('data', 'title'));
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