@extends('layouts.front')

@section('content')

<form action="{{ route('index.store') }}" method="POST" enctype="multipart/form-data">
    @csrf    
    <p>
        <button class="btn btn-info" type="submit">Submit form</button>
        <button type="button" class="btn btn-dark" id="add-row">Add Row <i class="fa fa-plus"></i></button>        
    </p>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Fill Form</h6>                    
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th class="text-uppercase text-xs font-weight-bolder opacity-7">No</th> -->
                                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Invoice</th>
                                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Amount</th>                                    
                                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2"></th>
                                    <!-- <th class="text-uppercase text-xs font-weight-bolder text-center opacity-7 ps-2">Status</th> -->                                    

                                </tr>
                            </thead>
                            <tbody id="form-table-body">
                                <tr>
                                    <input type="hidden" class="form-control" name="no[]" value="1">
                                    <td><p class="text-sm font-weight-bold mb-0"><input type="text" class="form-control" name="invoice[]" value=""></p></td>
                                    <td><p class="text-sm font-weight-bold mb-0"><input type="text" class="form-control" name="amount[]" value=""></p></td>
                                    <td><p class="text-sm font-weight-bold mb-0"><a id="remove-row"><i class="fa fa-trash text-danger"></i></a></p></td>
                                    <td><input type="hidden" name="status[]" value=""></td>
                                    <td><input type="hidden" name="tanggal[]" value="{{ date('Y-m-d H:i:s') }}"></td>                                    
                                </tr>
                            </tbody>
                        </table>                        
                    </div>                    
                </div>                         
            </div>                         
            
            <div class="form-check check-xl">
                <input type="checkbox" id="myCheck1" onclick="myFunction1()" class="form-check-input" value="1" required>
                <label for="myCheck3" class="form-check-label text-danger">Faktur Pajak</label><br>
            </div>
            <div class="form-check check-xl">
                <input type="checkbox" id="myCheck2" onclick="myFunction2()" class="form-check-input" value="2">
                <label for="myCheck3" class="form-check-label">Dokumen Tambahan</label><br>
            </div>
            <div class="form-check check-xl">
                <input type="checkbox" id="myCheck3" onclick="myFunction3()" class="form-check-input" value="3">
                <label for="myCheck3" class="form-check-label">Lainnya</label><br>
            </div>
                                                
        </div>
    </div>
</form>

<script>    
    document.getElementById("add-row").addEventListener("click", function () {
        var tableBody = document.getElementById("form-table-body");
        var rows = tableBody.getElementsByTagName("tr");
        var lastRow = rows[rows.length - 1];
        var clonedRow = lastRow.cloneNode(true);
        
        // var newRowNumber = rows.length + 1;
        // clonedRow.querySelector('input[name="no[]"]').value = newRowNumber.toString();        
        // document.getElementsByTagName("no[]").value = newRowNumber.toString();                        
        // console.log(newRowNumber);

        // Remove added row
        clonedRow.querySelector("#remove-row").addEventListener("click", function () {
            clonedRow.remove();
        });        

        // Update the input field names to ensure unique names
        var inputs = clonedRow.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            var name = inputs[i].getAttribute("name");
            if (name) {
                inputs[i].setAttribute("name", name.replace(/\[\d+\]/, "[" + (rows.length) + "]"));
                if (inputs[i].type === 'text') {
                    inputs[i].value = ""; 
                }
            }           
            tableBody.appendChild(clonedRow);
        }                  
    });
</script>

@endsection
