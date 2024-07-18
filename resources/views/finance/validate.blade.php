@extends('layouts.apps')

@section('content')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Validation Data & Due Date Setting</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nomor Tagihan</th>                                            
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Amount</th>                                       
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Perusahaan</th>                                            
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>                                            
                                            <!-- <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Select</th> -->
                                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Pilih Tanggal <i class="fas fa-calendar-alt"></i></th>
                                        </tr>
                                    </thead>
                                    @foreach($data as $row)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><a href="/validate/{{$row->surat_tagihan}}">{{$row->surat_tagihan}}</a></h6>
                                                    </div>
                                                </div>
                                            </td>                                            
                                            <td class="align-middle text-center text-sm">                                                
                                                <h6 class="mb-0 text-sm">Rp.{{ number_format($row->amount, 0, ',', '.')}}</h6>
                                            </td>                             
                                            <td class="align-middle text-center text-sm">                                                
                                                <h6 class="mb-0 text-sm">{{$row->supplier}}</h6>                                                                                            
                                            </td>                                           
                                            <td class="align-middle text-center text-sm" data-row="{{ $row->surat_tagihan }}">                                                
                                                <span class="badge badge-sm" id="stat_{{$row->surat_tagihan}}">{{$row->status ?? 'Not Set'}}</span>                                                                                            
                                            </td>                                           
                                            <!-- <td class="align-middle text-center text-sm">
                                                <select class="form-control" id="status_{{$row->surat_tagihan}}">
                                                    <option value="">Select Status</option>
                                                    <option value="Approve">Approve</option>
                                                    <option value="Reject">Reject</option>
                                                    <option value="Paid">Paid</option>
                                                </select>                                                                                                    
                                            </td> -->
                                            <td>                                     
                                                <div class="px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">                                                                                                                                        
                                                        <input type="text" class="form-control datepicker" data-row="{{ $row->surat_tagihan }}" value="{{$row->due_date}}">
                                                    </div>
                                                </div>
                                            </td>                                                                                          
                                        </tr>                                        
                                    </tbody>
                                    @endforeach                                    
                                                                        
                                    
                                    <!-- <script>
                                        $(document).ready(function() {
                                            $('select[id^="status_"]').on('change', function() {
                                                var suratTagihan = $(this).attr('id').replace('status_', '');
                                                var newStatus = $(this).val();

                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{route("validate.store")}}', 
                                                    data: {
                                                        suratTagihan: suratTagihan,
                                                        newStatus: newStatus,
                                                        _token: '{{ csrf_token() }}'
                                                    },
                                                    success: function(response) {
                                                        alert('Status updated successfully');
                                                        console.log(response);                                                        
                                                        location.reload();                                                                                               
                                                    },
                                                    error: function(error) {
                                                        alert('Status update failed');
                                                        console.log(error);                                                        
                                                    }
                                                });
                                            });
                                        });
                                    </script> -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>                                        
                                        $(document).ready(function() {
                                            $('span.badge').each(function() {
                                                if ($(this).text() == 'Approve') {
                                                    $(this).addClass('badge bg-gradient-success');
                                                } else if ($(this).text() == 'Reject') {
                                                    $(this).addClass('badge bg-gradient-danger');
                                                } else if ($(this).text() == 'Paid') {
                                                    $(this).addClass('badge bg-gradient-primary');
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
@endsection