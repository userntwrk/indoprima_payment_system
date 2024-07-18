@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Detail Tagihan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Nomor Tagihan</th>
                                <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Amount</th>
                                <th class="text-center text-uppercase font-weight-bolder text-xs font-weight-bolder opacity-7">Status</th>                                
                            </tr>
                        </thead>                        
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>
                                    <div class="d-flex px-3">                                        
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">{{$row->no}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$row->invoice}}</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">Rp.{{ number_format($row->amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="align-middle text-center">                                    
                                    <span class="badge badge-sm">{{$row->status}}</span>                                    
                                </td>                                
                            </tr>                                                    
                        @endforeach

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>                            
                            $(document).ready(function() {
                                $('span.badge').each(function() {
                                    if ($(this).text() == 'Approve') {
                                        $(this).addClass('badge bg-gradient-success');
                                    } else if ($(this).text() == 'On-Process') {
                                        $(this).addClass('badge bg-gradient-info');
                                    } else if ($(this).text() == 'Demand') {
                                        $(this).addClass('badge bg-gradient-danger');
                                    }
                                });
                            });
                        </script>

                        </tbody>                        
                    </table>
                </div>                
            </div>            
        </div>
                    
        @if($row->status == 'Approve')
        <a href="{{ route('index.cetak_pdf', $row->surat_tagihan) }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fa fa-print"></i>
                Print Pdf
        </a>
        @else
        <a href="{{ route('index.cetak_pdf', $row->surat_tagihan) }}" class="btn btn-primary btn-sm" target="_blank" hidden>
                <i class="fa fa-print"></i>
                Print Pdf
        </a>
        @endif
        
        
        
        <div class="form-check check-xl">
            <input type="checkbox" id="myCheck1" onclick="myFunction1()" class="form-check-input" value="1" checked disabled>
            <label for="myCheck3" class="form-check-label text-danger">Faktur Pajak</label><br>
        </div>
        <div class="form-check check-xl">
            <input type="checkbox" id="myCheck2" onclick="myFunction2()" class="form-check-input" value="2" checked disabled>
            <label for="myCheck3" class="form-check-label">Dokumen Tambahan</label><br>
        </div>
        <div class="form-check check-xl">
            <input type="checkbox" id="myCheck3" onclick="myFunction3()" class="form-check-input" value="3" checked disabled>
            <label for="myCheck3" class="form-check-label">Lainnya</label><br>
        </div>

    </div>
</div>
</div>

@endsection