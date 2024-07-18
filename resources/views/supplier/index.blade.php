@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Report Table</h6>
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
                        @foreach($data as $row)
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-3">                                        
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">{{$row->no}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0"><a href="/index/{{$row->surat_tagihan}}">{{$row->surat_tagihan}}</a></p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">Rp.{{ number_format($row->amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="align-middle text-center">                                                                           
                                    <span class="badge badge-sm">{{$row->status}}</span>                                    
                                </td>                                
                            </tr>                                                    
                        </tbody>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

