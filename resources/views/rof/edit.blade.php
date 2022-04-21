<title>Request Order Form</title>
@include('layouts.app')
<?php
$jsonCategory = $categories->toJson();
$i=1; //Item counter
$date=date("d/m");

$inputStyling = "mt-1 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full";
?>

<style>

label{block font-medium text-sm text-gray-700}

input:disabled {
  /* background: #dddddd; */
  border: 0;
}

td, th {
    padding: 10px;
}

th {
  display: table-cell;
  vertical-align: inherit;
  font-weight: bold;
  text-align: center;
}

</style>

<app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Order Form') }}
        </h2>
    </x-slot>

    <!-- Request Order Form starts here -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-4">
                <div class="m-2">
                    <form method="POST" action="">
                        @csrf
                        <table style="table-layout: auto; width:90%; border-spacing:15px;">
                            <tr style="min-width">
                                <td><x-label style="font-weight: bold;" for="requested_by" :value="__('Requested by')" /></td>
                                <td colspan="3">
                                    <x-label for="requested_by" :value="': '.Auth::user()->name" />
                                    <x-input id="requested_by" type="hidden" name="requested_by" value='{{ Auth::user()->name }}' required autofocus />
                                </td>
                                <td><x-label style="font-weight: bold;" for="form_ref_no" :value="__('Form Ref. No.')" /></td>
                                <td><x-label for="form_ref_no" :value="__(': '. $details->form_ref_no )" /></td>
                            </tr>
                            <tr>
                                <td><x-label style="font-weight: bold;" for="department" :value="__('Department')" /></td>
                                <td colspan="3"><x-label for="department" :value="': '.Auth::user()->dept" /></td>
           
                                <td><x-label style="font-weight: bold;" for="date" :value="__('Request Date ')" /></td>                                
                                <td><x-label :value="': '.$details->date" /></td>
                            </tr>
                            <tr>
                                <td><x-label style="font-weight: bold;" for="project" :value="__('Project')"/></td>
                                <td>    
                                    <div class="inline-block">: 
                                    <input type="radio" {{ $details->project_type == "Transmission" ? "checked" : ""; }} id="transmission" name="project" value="Transmission" required>
                                    <label class="font-medium text-sm text-gray-700" for="transmission">Transmission</label>
                                    </div>
                                </td>
                                <td> 
                                    <input type="radio" {{ $details->project_type == "Fiber to the Home" ? "checked" : ""; }} id="ftth" name="project" value="Fiber to the Home">
                                    <label class="font-medium text-sm text-gray-700" for="ftth">Fiber to the Home</label>   
                                </td>

                                <td></td>

                                <td><x-label style="font-weight: bold;" for="time" :value="__('Request Time')" /></td>
                                <td><x-label :value="': '.$details->time" /></td>
                            </tr>
                            <tr>
                                <td><x-label style="font-weight: bold;" for="others" :value="__('Other details')" /></td>
                                <td colspan="3">: <input id="others" type="text" name="others" value="{{ $details->others }}"></input></td>

                                <td><x-label style="font-weight: bold;" for="request_order_type" :value="__('Request Order Type')"/></td>
                                <td>:
                                    <input type="text" placeholder="{{ $details->order_type }}" list="order_type" id="request_order_type" name="request_order_type" value="" required/></input>
                                    <datalist id="order_type">
                                        <option value="New Project">
                                        <option value="Desktop Survey">
                                        <option value="Site Survey">
                                    </datalist>  
                                </td>
                            </tr>
                            <x-input id="approved_at" hidden type="text" name="approved_at" value="" autofocus />
                            <x-input id="approved_by" hidden type="text" name="approved_by" value="" autofocus />
                            <x-input id="received_by" hidden type="text" name="received_by" value="" autofocus />
                            <x-input id="received_at" hidden type="text" name="received_at" value="" autofocus />
                        </table>
                        
                        {{-------------------------------------------------------------}}
                        <!--Request Order Items-->
                        <div><hr style="margin-top:3%; margin-bottom:3%;"></div>
                        <div style="width:80%; margin:auto;">
                            {{-- <x-label for="rofi" style="font-weight: bold;" :value="__('Request Order Items:')" /> --}}
                            <div class="my-3"><h5><b>Request Order Item<b></h5></div>
                            <table id="rofi">
                                <thead>
                                    <tr>
                                        <th style="width:70%;">Link</th>
                                        <th style="width:30%;">Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="appendRow" >
                                @foreach($details->rofItems as $rofi)
                                    <tr>
                                        <td><input for="rofi" id="link{{ $i }}" class="{{ $inputStyling }}" type="text" name="link{{ $i }}" value={{ $rofi->link }}></input></td>
                                        <td>
                                            <select name='remarks{{ $i }}' id='remarks{{ $i }}' class="{{ $inputStyling }}">
                                                <option selected value="blank">
                                                    {{ $rofi->category }} 
                                                </option>  
                                                @foreach($categories as $category=>$value)
                                                    <option value="{{ $value['category'] }}"> 
                                                    {{ $value['category'] }}
                                                    </option>  
                                                @endforeach 
                                            </select>
                                        </td>
                                        <td><input disabled type="button" value="X" onclick="deleteRow(this)"></td>
                                    </tr>
                                @endforeach
                                {{-- <tr style='visibility:collapse'></tr> --}}
                                <x-input id="indexNum" hidden type="text" name="indexNum" value="{{ $i }}" autofocus />
                                </tbody>
                            </table>
                            <br>
                            <button class="m-2 btn btn-primary" type="button" id="dynamic-ar">+ Link</button>
                            <button class="m-2 float-end btn btn-success" type="submit">Submit</button>
                            <button class="my-2 float-end btn btn-secondary" type="button" onclick="history.back()">Back</button>  
                            {{-- <x-button class="mt-1">Add Link</x-button> --}}
                        </div>
                    </form><br><br>
                </div>
                
            </div>
        </div>
    </div>
</app-layout>

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">

    //This var refers to the ROFI limit declared at the top PHP lines, used in adding a new row function
    var i = {{ $i }}; 
    //This const takes the JSON form of ROFI categories passed from $categories  
    const jsonCategory = <?= $jsonCategory?>;

    function getCategories(value, index) {
        formItemCategories += '<option value="' 
                    + value['category'] +'"> '
                    + value['category'] +' </option>';
    }

    var formAddItem = '', formItemCategories = '';
    jsonCategory.forEach(getCategories);
  
    //Below function adds new row of fields.
    // $("#dynamic-ar").click(function () {
    //     i++;
    //     formAddItem = '<tr><td><input id="link' + i + '" class="mt-1 w-40" type="text" name="link' 
    //                     + i + '" autofocus></td><td><select name="remarks' + i + '" id="remarks' 
    //                     + i + '" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">'
    //                     + '<option selected value ="blank"></option>' + formItemCategories + '</select></td><td><input type="button" value="X" onclick="deleteRow(this)"></td></tr>'; 
                        
    //     var targetDiv = document.getElementById('rofi');
    //     document.getElementById('indexNum').value = i;
    //     $("#appendRow").append(formAddItem);
    // });
    $("#dynamic-ar").click(function addRow () {
        i++;
        formAddItem = '<tr><td><input id="link' + i + '" class="{{ $inputStyling }}" type="text" name="link' 
                        + i + '" autofocus></td><td><select name="remarks' + i + '" id="remarks' 
                        + i + '" class="{{ $inputStyling }}">'
                        + '<option selected value ="blank"></option>' + formItemCategories + '</select></td><td><input type="button" value="X" onclick="deleteRow(this)"></td></tr>'; 
                        
        var targetDiv = document.getElementById('rofi');
        document.getElementById('indexNum').value = i;
        $("#appendRow").append(formAddItem);
    });

    function updateRequirements(val, itemIndex) {
        if (val == "blank") {
            document.getElementById('link' + itemIndex).required = false;
        } else {
            document.getElementById('link' + itemIndex).required = true;
        }
    }
    
    function deleteRow(r) {
        var delRow = r.parentNode.parentNode.rowIndex;
        document.getElementById("rofi").deleteRow(delRow);
    }

</script>
