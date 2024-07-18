<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $surat_tagihan }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css" media="screen">
            html {
                font-family: sans-serif;
                line-height: 1.15;
                margin: 0;
            }            

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: collapse;
            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
            }

            .table.table-items td {
                border-top: 1px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .mt-5 {
                margin-top: 3rem !important;
            }

            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }
            * {
                font-family: "DejaVu Sans";
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            .cool-gray {
                color: #6B7280;
            }
        </style>
</head>

<body>    
{{-- Header --}}            
    <table class="table table-items">
        <div class="col-3" width="30%">
            <img src="assets/img/company_logo.png" width="100px" height="100px" alt="Company Logo" class="mb-4">    
        </div>
        <tbody>
            <tr>                
                <td class="border-0 pl-0">
                    <h4 class="text-uppercase">
                        <strong>PT INDOPRIMA GEMILANG</strong>
                    </h4>
                    <p class="cool-gray">Jl. Margomulyo Komp. Gardu Induk PLN Margomulyo No.5, Tandes Kidul, Kec. Tandes, Surabaya, Jawa Timur 60187</p>
                    <p class="cool-gray">Telp. 031-749 8888</p>
                    <p class="cool-gray">Fax. 031-749 8888</p>    
                </td>                
            </tr>
            <tr>
                <td class="px-0" width="100%"></td>
            </tr>
        </div>
        </tbody>     
    </table>        

    <table class="table mt-5">
        <tbody>
            <tr>
                <td class="border-0 pl-0" width="70%">
                    <!-- <h4 class="text-uppercase">
                        <strong>{{ $surat_tagihan }}</strong>
                    </h4>
                    <p>{{ __('invoices::invoice.date') }}: <strong>{{ date_format(date_create($tanggal), 'd F Y') }}</strong></p> -->
                </td>
                <td class="border-0 pl-0">                    
                        <h4 class="text-uppercase cool-gray">                                                        
                            <strong>{{ $surat_tagihan }}</strong>
                            <!-- PAID -->
                        </h4>                
                        <!-- <p>{{ __('invoices::invoice.serial') }} <strong>{{ $surat_tagihan }}</strong></p> -->
                        <p>{{ __('invoices::invoice.date') }}: <strong>{{ date_format(date_create($tanggal), 'd F Y') }}</strong></p>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Seller - Buyer --}}
    <table class="table table-items">
        <thead>
                <tr>
                    <!-- <th class="border-0 pl-0 party-header" width="48.5%">
                        {{ __('invoices::invoice.buyer') }}
                    </th> -->
                    <!-- <th class="border-0" width="3%"></th> -->
                    <th class="border-0 pl-0 party-header">
                        Supplier
                    </th>
                </tr>
            </thead>
        <tbody>
            <tr>            
                <!-- <td class="px-0">                    
                        <p class="seller-name">
                            <strong>PT INDOPRIMA GEMILANG</strong>
                        </p>                                                                            
                        
                        <p class="seller-address">
                            {{ __('invoices::invoice.address') }}: Jl. Margomulyo Komp. Gardu Induk PLN Margomulyo No.5, Tandes Kidul, Kec. Tandes, Surabaya, Jawa Timur 60187
                        </p>                        
                                                
                        <p class="seller-phone">
                            {{ __('invoices::invoice.phone') }}: (031) 2977777
                        </p>                        
                </td>
                <td class="border-0"></td> -->
                <td class="px-0" width="100%">                        
                            <p class="buyer-name">
                                <strong>{{ $supplier }}</strong>
                            </p>                        
                        
                            <p class="buyer-address">
                                {{ __('invoices::invoice.address') }}: {{ $alamat }}
                            </p>                        
                                                    
                            <p class="buyer-phone">
                                {{ __('invoices::invoice.phone') }}: {{ $no_hp }}
                            </p>                                                
                    </td>
            </tr>
        </tbody>
    </table>

    {{-- Table --}}
    <table class="table table-items">
        <thead>
            <tr>
                <th scope="col" class="border-0 pl-0">No</th>
                <th scope="col" class="text-center border-0">Invoice</th>
                <th scope="col" class="text-right border-0 pr-0">Amount</th>                     
            </tr>
        </thead>
        {{-- Items --}}            
            @foreach($data->chunk(1) as $chunk)            
                @foreach($chunk as $item)
        <tbody>            
            <tr>
                <td class="pl-0">    
                    <p class="cool-gray">{{ $item->no }}</p>
                </td>                
                <td class="text-center">{{ $item->invoice }}</td>
                <td class="text-right pr-0">                    
                    Rp.{{ number_format($item->amount, 0, ',', '.') }}                    
                </td>                
            </tr>            
                @endforeach
            @endforeach            
            {{-- End of the Items --}}
            
            {{-- Summary --}}                                                    
                    <tr>
                        <td colspan="" class="text-right pl-0">                            
                        <td class="text-right pl-0">{{ __('invoices::invoice.total_amount') }} :</td>
                        <td class="text-right pr-0 total-amount">                            
                            Rp.{{ number_format($amount_total, 0, ',', '.') }}
                        </td>
                    </tr>
            </tbody>
        </table>
        
        <p>
            {{ trans('invoices::invoice.notes') }}: <b>Silahkan Berikan Ke Admin Untuk Diverifikasi</b>
        </p>        
        
        <p>
            {{ trans('invoices::invoice.pay_until') }}: 
        </p>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>    
</body>
</html>
