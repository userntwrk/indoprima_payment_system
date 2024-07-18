@extends('layouts.apps')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Due Date Setting</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nomor Surat Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total Tagihan</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Perusahaan</th>
                                    <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Pilih Tanggal <i class="fas fa-calendar-alt"></i></th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$row->surat_tagihan}}</h6>
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
                                                <h6 class="mb-0 text-sm">{{$row->supplier}}</h6>
                                            </div>
                                        </div>
                                    </td>     
                                    <td>                                     
                                    <div class="px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">                                                                                                                                        
                                            <input type="text" class="form-control datepicker" data-row="{{ $row->surat_tagihan }}" placeholder="Select Due Date">
                                        <!-- <form action="" method="GET">
                                            <div class="input-group date">
                                                <input type="date" name="date" class="form-control" value="">                                                
                                            </div>
                                        </form>                          -->
                                        </div>             
                                    </div>
                                    </td>                                                                                                                 
                                    <!-- <td>
                                    <div class="px-3 py-1">
                                            <div class="flex-column justify-content-center">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal{{$row->surat_tagihan}}" data-whatever="@mdo">PILIH TANGGAL</button>
                                        </div>
                                        <div class="modal fade" id="exampleModal{{$row->surat_tagihan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal</h5>
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="dueDateForm{{$row->surat_tagihan}}" action="{{ route('due_date.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="surat_tagihan" value="{{$row->surat_tagihan}}">
                                                            
                                                            <div class="form-check check-xl">
                                                                <input type="checkbox" name="due_date[]" class="form-check-input" value="3">
                                                                <label class="form-check-label">Tanggal 3</label><br>

                                                                <input type="checkbox" name="due_date[]" class="form-check-input" value="17">
                                                                <label class="form-check-label">Tanggal 17</label><br>

                                                                <input type="checkbox" name="due_date[]" class="form-check-input" value="27">
                                                                <label class="form-check-label">Tanggal 27</label><br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" form="dueDateForm{{$row->surat_tagihan}}" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>                                     -->
                                </tr>                                        
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div> 

<!-- <script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: new Date(),
        });

        $('.datepicker').change(function () {
            var suratTagihan = $(this).data('row');
            var selectedDate = $(this).val(); // Date without time
            var selectedTime = '00:00:00'; // Default time if not provided
            
            var selectedDateTime = selectedDate + ' ' + selectedTime;

            $.ajax({
                url: "{{ route('due_date.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    surat_tagihan: suratTagihan,
                    selected_datetime: selectedDateTime
                },
                success: function (response) {
                    // Update the table cell with the new due date and time
                    $("tr[data-row='" + suratTagihan + "'] td.due-date").text(selectedDateTime);
                    alert('Due date has been updated successfully');                    
                },
                error: function (error) {
                    alert('An error occurred while updating the due date');                    
                }
            });
        });
    });
</script> -->

<!-- <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var recipient = button.data('whatever');
        var modal = $(this);
        modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient);
    });    
</script> -->



@endsection
