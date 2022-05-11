
<title>Request Order Form</title>
@include('layouts.app')
@if(session()->has('message'))
    <div class="alert alert-success">
        <?php
            $message = session()->get('message');
            echo "<script> alert('$message'); </script>";
            session(['message' => '']);
        ?>
    </div>
@endif

<?php
$inputStyling = "column_filter mt-1 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full";
?>

<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
<link href=" {{ URL::asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<style>
label{block font-medium text-sm text-gray-700}

input:disabled {
  border: 0;
}

td, th {
    padding: 10px;
    border:none;
}
</style>

<head>
    @if (auth()->user()->user_type == "User")
        <script>
            var user = "User";
        </script>
    @elseif (auth()->user()->user_type == "Contractor")
        <script>
            var user = "Contractor";
        </script>
    @else
        <script>
            var user = "HOD";
        </script>
    @endif
</head>

<html>
<body>
@include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Order Form') }}
        </h2>
    </x-slot>

    <div class="mb-4" style="width:95%; margin: auto;">
        <h2>Request Order Form</h2>
    </div><br><br>

    <div class="row" style="width:90%; margin: auto;">
        <div class="col-sm-2" {{ auth()->user()->user_type == 'User' ? 'hidden' : '' }}>
            <div class="form-group">
                <label>
                    Requested By
                </label>
                <select id="requested_by_filter" :value="old('filter_name')" class="column_filter mt-1 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                    <option selected value=""> 
                    </option>  
                    @foreach($users as $user)
                        <option value="{{ $user['name'] }}"> 
                        {{ $user['name'] }}
                        </option>  
                    @endforeach 
                </select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>
                    Approval Status
                </label>
                <select id="status_filter" name="status_filter" class="column_filter {{ $inputStyling }}">
                    <option selected value=""></option>  
                    <option value="Approved">Approved</option>
                    <option value="Pending">Pending</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>
                    Request Order Type
                </label>
                <input type="text" placeholder="Others" list="order_type" id="order_type_filter" name="order_type_filter" class="column_filter  {{ $inputStyling }}" required/></input>
                <datalist id="order_type">
                    <option selected value=""></option>  
                    <option value="New Project">New Project</option>
                    <option value="Desktop Survey">Desktop Survey</option>
                    <option value="Site Survey">Site Survey</option>
                </datalist>  
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>
                    Order Content
                </label>
                <select id="order_content_filter" name="order_content_filter" class="column_filter {{ $inputStyling }}">
                    <option selected value="blank"> 
                    </option>  
                    @foreach($categories as $category)

                        @if ($category['category'] == "High Loss" || $category['category'] == "ISP" || $category['category'] == "BHP")
                            <optgroup label="{{ $category['type'] }}"> 
                        @endif

                        <option value="{{ $category['category'] }}"> 
                        {{ $category['category'] }}
                        </option>  

                        @if ($category['category'] == "Others (Network Improvement)" || $category['category'] == "Others (New Link)" || $category['category'] == "Others (Relocation)")
                            </optgroup> 
                        @endif
                        
                    @endforeach 
                </select>  
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>
                    From
                </label>
                <input autocomplete="off" class="datepicker {{ $inputStyling }}" type="text" id="from_filter" name="from_filter"></input>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>
                    To
                </label>
                <input autocomplete="off" class="datepicker  {{ $inputStyling }}" type="text" id="to_filter" name="to_filter"></input>
            </div>
        </div>
                <button type="button" class="btn btn-dark mb-3" style="width:8%; margin: auto;" onclick="clearFilter()" aria-label="Clear Filter" data-toggle="tooltip" data-placement="bottom" title="Clear Filter">Clear Filter</button>
    </div>

    {{-- ROF Datatable --}}
    <div class="card" style="width:95%; margin: auto;">
        <div class="card-body">
            <table id="rof-table" class="table display zero-configuration" >
                <thead>
                    <tr>
                        <th>Requested by</th>
                        <th>Form Ref. No.</th>
                        <th>Department </th>
                        <th>Request Order Type</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="m-4 pr-3"  {{ auth()->user()->user_type == 'HOD' ? 'hidden' : '' }}><a href="{{ route('createROF') }}" class="btn btn-primary float-right">New Request</a></div>
</body>
</html>

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" />


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src={{ asset('js/script.js') }} type="text/javascript"></script>


<script>

let approveElement = document.getElementsByClassName("approve-button");
var minDate, maxDate, table;   

    function clearFilter() {
        document.getElementById("status_filter").value = "";
        document.getElementById("order_type_filter").value = "";
        document.getElementById("from_filter").value = "";
        document.getElementById("to_filter").value = "";
        location.reload();
        return false;
    }

    $(document).on("keypress", "input", function(e){
        if(e.which == 13){
            var inputVal = $(this).val();
            alert("You've entered: " + inputVal);
        }
    });

    $(document).ready( function () {

        load_table();

        $('#from_filter').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate());
                $('#to_filter').datepicker("option", "minDate", dt);
                minDate = selected;
                moreFilter();
            }
        });
        $('#to_filter').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate());
                $('#from_filter').datepicker("option", "maxDate", dt);
                maxDate = selected;
                moreFilter();
            }
        });

        function load_table(fromDate = '', toDate = '', content = ''){
            table = $('#rof-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('datatableROF') }}",
                data: { 
                    minDate : fromDate, 
                    maxDate : toDate,
                    searchContent : content
                }
            },
            columns: [
                {data: 'requested_by', name: 'requested_by'},
                {data: 'form_ref_no', name: 'form_ref_no'},
                {data: 'user.dept', name: 'user.dept'},
                {data: 'order_type', name: 'order_type'},
                {data: 'date', name: 'date'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false}
            ],
            language : {
                emptyTable : "No order form request found."
            }
            });
            
            if (user == 'User'){
                table.columns(0).visible(false);
            }
            else if (user == 'Contractor'){
                table.columns(5).visible(false);
            }

            $('input.column_filter, #order_type_filter, select.column_filter').on('change', function() {
                let filterType = $(this).attr('id').replace('_filter', '');
                let filterValue = $(this).val();
                table.column(filterType+':name').search(filterValue).draw();
            });
        }

        $('#order_content_filter').on('change', function () {
            moreFilter();
        });

        function moreFilter(){
            content = $('#order_content_filter').val();
            table.destroy();
            load_table(minDate, maxDate, content);
            table.draw();   
        }
            
     });    

</script>

