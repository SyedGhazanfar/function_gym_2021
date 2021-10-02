{{-- Extends layout --}}
@extends('layout.default')
<script src="{{ asset('./js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#daterange').daterangepicker({
            "showDropdowns": true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "startDate": "09/23/2021",
            "endDate": "09/29/2021"
        }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        }); 
        $('#fees_payable').on('change',()=>{
            let filter_fees = document.getElementById('fees_payable').value;
            var value = {
                filter_fees:filter_fees
            }
            // console.log(value);
            $.ajax({
                type: "get",
                url: "{{route('manage_invoice_data')}}",
                data: value,
                success: function (response) {
                    if(response){
                    if(response){
                    var output="";
                    for(var i = 0; i < response.length; i++){
                        output += '<tr><td>'+[i+1]+'</td>';
                        output += '<td>'+response[i]["customer_name"]+'</td>';
                        output += '<td>'+response[i]["customer_phone"]+'</td>';
                        output += '<td>'+response[i]["payment_method"]+'</td>';
                        output += '<td>'+response[i]["pay_date"]+'</td>';
                        if(response[i]["discount"]==null){
                            output += '<td class=""> No Discount </td>';
                        }
                        else{
                            output += '<td>'+response[i]["discount"]+'</td>';
                        }
                        if(response[i]["fees_payable"]=="All Clear"){
                            output += '<td class="text-success"> All Clear </td>';
                        }
                        else if(response[i]["fees_payable"]=="Unpaid"){
                            output += '<td class="text-success"> <a href="update_fees/'+response[i]["id"]+'" class="text-danger">Unpaid</a></td>'
                        }
                        output += '<td><b>'+response[i]["net_total"]+'.00</b></td>';
                        
                        
                            output+= '<td>\
                                                <div class="dropdown">\
                                                    <button type="button" class="btn btn-info light sharp"\
                                                        data-toggle="dropdown">\
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">\
                                                            <g stroke="none" stroke-width="1" fill="none"\
                                                                fill-rule="evenodd">\
                                                                <rect x="0" y="0" width="24" height="24" />\
                                                                <circle fill="#000000" cx="5" cy="12" r="2" />\
                                                                <circle fill="#000000" cx="12" cy="12" r="2" />\
                                                                <circle fill="#000000" cx="19" cy="12" r="2" />\
                                                            </g>\
                                                        </svg>\
                                                    </button>\
                                                    <div class="dropdown-menu">\
                                                        <a class="dropdown-item"\
                                                            href="invoice/'+response[i]["id"]+'">Check Invoice</a>\
                                                    <a class="dropdown-item"\
                                                            href="update_fees/'+response[i]["id"]+'">Edit</a>\
                                                             <a class="dropdown-item"\
                                                            data-toggle="modal" data-target="#delete_fees'+response[i]["id"]+'">Delete</a>\
                                                    </div>\
                                                    <div class="modal mt-5 fade" id="delete_fees'+response[i]["id"]+'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">\
                                            <div class="modal-dialog" role="document">\
                                                <div class="modal-content">\
                                                    <div class="modal-header">\
                                                        <h5 class="modal-title">Confirmation</h5>\
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                                                <span aria-hidden="true">&times;</span>\
                                                            </button>\
                                                    </div>\
                                                    <div class="modal-body text-center pt-5">\
                                                        <h2 class="mt-3">Are you sure to delete ?</h2>\
                                                    </div>\
                                                    <div class="modal-footer">\
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>\
                                                        <a href="delete_fees/'+response[i]["id"]+'" class="btn btn-danger"><i class="fa fa-check" aria-hidden="true"></i> Delete</a>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                                </div>\
                                            </td>'
                        
                        output += '</tr>';
                    }
                    $('#example3 tbody').html(output)

                    
                }
                }  
                }
            });
        })
    });

$(document).on('click', '#reset-btn', ()=>{
        location.reload()
        });
      $.ajax({
            type: "get",
            url: "{{route('manage_invoice_data')}}",
            dataType: 'json',
            success: function (response) {
                if(response){
                    if(response){
                    var output="";
                    for(var i = 0; i < response.length; i++){
                        output += '<tr><td>'+[i+1]+'</td>';
                        output += '<td>'+response[i]["customer_name"]+'</td>';
                        output += '<td>'+response[i]["customer_phone"]+'</td>';
                        output += '<td>'+response[i]["payment_method"]+'</td>';
                        output += '<td>'+response[i]["pay_date"]+'</td>';
                        if(response[i]["discount"]==null){
                            output += '<td class=""> No Discount </td>';
                        }
                        else{
                            output += '<td>'+response[i]["discount"]+'</td>';
                        }
                        if(response[i]["fees_payable"]=="All Clear"){
                            output += '<td class="text-success"> All Clear </td>';
                        }
                        else if(response[i]["fees_payable"]=="Unpaid"){
                            output += '<td class="text-success"> <a href="update_fees/'+response[i]["id"]+'" class="text-danger">Unpaid</a></td>'
                        }
                        output += '<td><b>'+response[i]["net_total"]+'.00</b></td>';
                        
                            output+= '<td>\
                                                <div class="dropdown">\
                                                    <button type="button" class="btn btn-info light sharp"\
                                                        data-toggle="dropdown">\
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">\
                                                            <g stroke="none" stroke-width="1" fill="none"\
                                                                fill-rule="evenodd">\
                                                                <rect x="0" y="0" width="24" height="24" />\
                                                                <circle fill="#000000" cx="5" cy="12" r="2" />\
                                                                <circle fill="#000000" cx="12" cy="12" r="2" />\
                                                                <circle fill="#000000" cx="19" cy="12" r="2" />\
                                                            </g>\
                                                        </svg>\
                                                    </button>\
                                                    <div class="dropdown-menu">\
                                                        <a class="dropdown-item"\
                                                            href="invoice/'+response[i]["id"]+'">Check Invoice</a>\
                                                    <a class="dropdown-item"\
                                                            href="update_fees/'+response[i]["id"]+'">Edit</a>\
                                                             <a class="dropdown-item"\
                                                            data-toggle="modal" data-target="#delete_fees'+response[i]["id"]+'">Delete</a>\
                                                    </div>\
                                                    <div class="modal mt-5 fade" id="delete_fees'+response[i]["id"]+'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">\
                                            <div class="modal-dialog" role="document">\
                                                <div class="modal-content">\
                                                    <div class="modal-header">\
                                                        <h5 class="modal-title">Confirmation</h5>\
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                                                <span aria-hidden="true">&times;</span>\
                                                            </button>\
                                                    </div>\
                                                    <div class="modal-body text-center pt-5">\
                                                        <h2 class="mt-3">Are you sure to delete ?</h2>\
                                                    </div>\
                                                    <div class="modal-footer">\
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>\
                                                        <a href="delete_fees/'+response[i]["id"]+'" class="btn btn-danger"><i class="fa fa-check" aria-hidden="true"></i> Delete</a>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                                </div>\
                                            </td>'
                        
                        output += '</tr>';
                    }
                    $('#example3 tbody').html(output)

                    
                }
                }
            }
        });
      
    $(document).on('submit', '#customer-form', (e)=>{
        e.preventDefault();
       let val = document.getElementById('daterange').value;
       var n = val.split(' - ');
       tin_0 = n[0].split('/')
       var tin = tin_0[2]+'-'+tin_0[0]+'-'+tin_0[1];
       tout_0 = n[1].split('/')
       var tout = tout_0[2]+'-'+tout_0[0]+'-'+tout_0[1];
       var value = {
           t_in : tin,
           t_out : tout,
       }
    //    console.log(tout);

       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
        $.ajax({
            type: "get",
            url: "{{route('manage_invoice_data')}}",
            data: value,
            success: function (response) {
                if(response){
                    var output="";
                    for(var i = 0; i < response.length; i++){
                        output += '<tr><td>'+[i+1]+'</td>';
                        output += '<td>'+response[i]["customer_name"]+'</td>';
                        output += '<td>'+response[i]["customer_phone"]+'</td>';
                        output += '<td>'+response[i]["payment_method"]+'</td>';
                        output += '<td>'+response[i]["pay_date"]+'</td>';
                        if(response[i]["discount"]==null){
                            output += '<td class=""> No Discount </td>';
                        }
                        else{
                            output += '<td>'+response[i]["discount"]+'</td>';
                        }
                        if(response[i]["fees_payable"]=="All Clear"){
                            output += '<td class="text-success"> All Clear </td>';
                        }
                        else if(response[i]["fees_payable"]=="Unpaid"){
                            output += '<td class="text-success"> <a href="update_fees/'+response[i]["id"]+'" class="text-danger">Unpaid</a></td>'
                        }
                        output += '<td><b>'+response[i]["net_total"]+'.00</b></td>';
                        
                            output+= '<td>\
                                                <div class="dropdown">\
                                                    <button type="button" class="btn btn-info light sharp"\
                                                        data-toggle="dropdown">\
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">\
                                                            <g stroke="none" stroke-width="1" fill="none"\
                                                                fill-rule="evenodd">\
                                                                <rect x="0" y="0" width="24" height="24" />\
                                                                <circle fill="#000000" cx="5" cy="12" r="2" />\
                                                                <circle fill="#000000" cx="12" cy="12" r="2" />\
                                                                <circle fill="#000000" cx="19" cy="12" r="2" />\
                                                            </g>\
                                                        </svg>\
                                                    </button>\
                                                    <div class="dropdown-menu">\
                                                        <a class="dropdown-item"\
                                                            href="invoice/'+response[i]["id"]+'">Check Invoice</a>\
                                                    <a class="dropdown-item"\
                                                            href="update_fees/'+response[i]["id"]+'">Edit</a>\
                                                             <a class="dropdown-item"\
                                                            data-toggle="modal" data-target="#delete_fees'+response[i]["id"]+'">Delete</a>\
                                                    </div>\
                                                    <div class="modal mt-5 fade" id="delete_fees'+response[i]["id"]+'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">\
                                            <div class="modal-dialog" role="document">\
                                                <div class="modal-content">\
                                                    <div class="modal-header">\
                                                        <h5 class="modal-title">Confirmation</h5>\
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                                                <span aria-hidden="true">&times;</span>\
                                                            </button>\
                                                    </div>\
                                                    <div class="modal-body text-center pt-5">\
                                                        <h2 class="mt-3">Are you sure to delete ?</h2>\
                                                    </div>\
                                                    <div class="modal-footer">\
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>\
                                                        <a href="delete_fees/'+response[i]["id"]+'" class="btn btn-danger"><i class="fa fa-check" aria-hidden="true"></i> Delete</a>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                                </div>\
                                            </td>'
                        
                        output += '</tr>';
                    }
                    $('#example3 tbody').html(output)

                    
                }
            }
        });
    })
</script>



{{-- Content --}}
@section('content')

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Invoices</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Invoices</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoices</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3 ie-section">
                            <div class="col-md-3">
                                <form action="" method="get" id="customer-form">
                                 <div class="input-group example mb-3">
                                     @csrf
                                     <input type="text" class="form-control input-daterange-datepicker border-light" required id="daterange" >
                                     <div class="input-group-append">
                                         <button class="btn btn-outline-light btn-sm" id="reset-btn">Reset</button>
                                       <button class="btn btn-outline-light btn-sm" id="submit-btn" type="submit">Submit</button>
                                     </div>
                                   </div>
                                </form>
                             </div>
                             <div class="col-md-3">
                                 
                             </div>
                             <div class="col-md-3"></div>
                            <div class="col-md-3 ">
                               <div class="mr-md-3 text-right">
                                <button class="btn btn-outline-light btn-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                    Export <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="{{url('invoice-export/invoice_xlsx')}}">Export to Excel (.xlsx) </a>
                                    <a class="dropdown-item" href="{{url('invoice-export/invoice_csv')}}">Export to CSV (.csv)</a>
                                </div>
                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#trainer_import">
                                        Import <i class="fa fa-sign-in" aria-hidden="true"></i>
                                    </button>    
                                   
                               </div>
                            </div>  
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="trainer_import" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Import CSV</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('invoice-imp')}}" enctype="multipart/form-data" method="POST" class="dropzone">
                                            @csrf
                                            <div class="fallback">
                                                <input name="file_invoice" type="file"/>
                                            </div>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example3" class="table table-sm-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="width80"><strong>#</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Phone</strong></th>
                                        <th><strong>Payment Type</strong></th>
                                        <th><strong>Payment Date</strong></th>
                                        <th><strong>Discount</strong></th>
                                        <th><strong>Dues</strong></th>
                                        <th><strong>Total Amount</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
