@extends('layouts.apps')

@section('content')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Validation Detail</h6>                            
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Tagihan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Supplier</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor HP</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        </tr>
                                    </thead>                                    
                                    @foreach($data as $row)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$row->invoice}}</h6>                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Rp.{{ number_format($row->amount, 0, ',', '.') }}</h6>                                                        
                                                    </div>
                                                </div>
                                            </td>                                            
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$row->due_date}}</h6>                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$row->supplier}}</h6>                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$row->no_hp}}</h6>                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm">{{$row->status}}</span>
                                            </td>                                                                                        
                                        </tr>                                        
                                    </tbody>                                    
                                    @endforeach
                                </table>                                
                            </div>                            
                        </div>                        
                    </div>    
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Approve
                    </button>                     -->

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
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>                                        
    $(document).ready(function() {
        $('span.badge').each(function() {
            if ($(this).text() == 'Approve') {
                $(this).addClass('badge bg-gradient-success');
            } else if ($(this).text() == 'Demand') {
                $(this).addClass('badge bg-gradient-danger');
            } else if ($(this).text() == 'On-Process') {
                $(this).addClass('badge bg-gradient-info');
            }
        });
    });                                        
</script>
