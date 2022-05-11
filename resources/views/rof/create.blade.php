<title>Request Order Form</title>
@include('layouts.app')
<?php
//use App\Http\Controllers\ROFController;
use App\Models\User;

$jsonCategory = $categories->toJson();

$date=date("m/d"); //this date is only used as Form Ref No builder
$counter = $daily_counter['counter'];
$counter++;

//below is the styling of all applicable input type. it is a collection of bootstrap 4 classes
$inputStyling = "mt-1 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full";
?>

<style>
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
    <slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight m-3">
            {{ __('Request Order Form') }}
        </h2><br>
    </slot>

    <!-- Request Order Form starts here -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ml-4">
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
                                <td><x-label for="form_ref_no" :value="__(': CTS/NTW/ROF/').$date.sprintf('-%03d', $counter)" /></td>
                                <x-input id="counter" type="hidden" name="counter" value='{{ $counter }}' required autofocus />
                                <!--Check the value passed for the line below!!-->
                                <x-input id="form_ref_no" class="block mt-1 w-40" type="hidden" name="form_ref_no" value="CTS/NTW/ROF/{{$date.sprintf('-%03d', $counter);}}" required autofocus />
                            </tr>
                            <tr>
                                <td><x-label style="font-weight: bold;" for="department" :value="__('Department')" /></td>
                                <td colspan="3"><x-label for="department" :value="': '.Auth::user()->dept" /></td>
                                {{-- Below is the actual value that will be sent --}}
                                <x-input id="department" class="block mt-1 w-40" type="hidden" name="department" value='{{ Auth::user()->dept }}' required autofocus />

                                <td><x-label style="font-weight: bold;" for="date" :value="__('Request Date ')" /></td>
                                <x-input hidden type="text" id="date" name="date" value="{{ date('Y-m-d') }}"/>
                                <td><x-label :value="': '.date('Y-m-d')" /></td>
                            </tr>
                            <tr>
                                <td><x-label style="font-weight: bold;" for="project" :value="__('Project')"/></td>
                                <td>    
                                    <div class="inline-block">: 
                                    <x-input type="radio" id="transmission" name="project" value="Transmission" required/>
                                    <label class="font-medium text-sm text-gray-700" for="transmission">Transmission</label>
                                    </div>
                                </td>
                                <td> 
                                    <x-input type="radio" id="ftth" name="project" value="Fiber to the Home"/>
                                    <label class="font-medium text-sm text-gray-700" for="ftth">Fiber to the Home</label>   
                                </td>
                                <td></td>
                                <td>
                                    <x-label style="font-weight: bold;" for="time" :value="__('Request Time')" />
                                    <x-input hidden type="text" id="time" name="time" value="{{ date('H:i') }}"/>
                                </td>
                                <td><x-label for="time" :value="': '.__(date('H:i'))" /></td>
                            </tr>
                            <tr>
                                <td><x-label style="font-weight: bold;" for="others" :value="__('Other details')" /></td>
                                <td colspan="3">: <input id="others" type="text" name="others" value=""></input></td>
                                {{-- <input id="others" type="text" name="others" autocomplete="off" autofocus ></input> --}}
                                <td><x-label style="font-weight: bold;" for="request_order_type" :value="__('Request Order Type')"/></td>
                                <td>:
                                    <input type="text" placeholder="Others" list="order_type" id="request_order_type" name="request_order_type" class="w-75" required/></input>
                                    <datalist id="order_type">
                                        <option value="New Project">
                                        <option value="Desktop Survey">
                                        <option value="Site Survey">
                                    </datalist>  
                                </td>
                            </tr>

                            <tr>
                                <td><x-label style="font-weight: bold;" for="others" :value="__('Request to')" /></td>
                                <td>:
                                    <select id="contractor" name="contractor" class="w-75" required>
                                        <option value=""></option>
                                        @for($i=0; $i < count($contractors); $i++ )
                                            <option value="{{ $contractors[$i]; }}">{{ $contractors[$i]; }}</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>

                            <tr><td></td></tr>

                            <x-input id="checked_at" hidden type="text" name="checked_at" value="" autofocus />
                            <x-input id="checked_by" hidden type="text" name="checked_by" value="" autofocus />
                            <x-input id="received_by" hidden type="text" name="received_by" value="" autofocus />
                            <x-input id="received_at" hidden type="text" name="received_at" value="" autofocus />
                        </table>
                        
                        {{-------------------------------------------------------------}}
                        <!--Request Order Items-->
                        <div><hr style="margin-top:3%; margin-bottom:3%;"></div>
                        <div style="width:85%; margin:auto;">
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
                                <tr>
                                    <td><input for="rofi" id="link1" class="{{ $inputStyling }}" type="text" name="link1"></input></td>
                                    <td>
                                        <select name='remarks1' id='remarks1' :value="old('remarks1')" class="{{ $inputStyling }}">
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
                                    </td>
                                    <td><input disabled type="button" value="X" onclick="deleteRow(this)"></td>
                                </tr>
                                {{-- <tr style='visibility:collapse'></tr> --}}
                                <x-input id="indexNum" hidden type="text" name="indexNum" value="1" autofocus />
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
    var i = 1; 
    //This const takes the JSON form of ROFI categories passed from $categories  
    const jsonCategory = <?= $jsonCategory?>;

    function getCategories(value, index) {

        if(value['category'] == "High Loss" || value['category'] == "ISP" || value['category'] == "BHP"){
            formItemCategories += '<optgroup label="' + value['type'] + '">';
        }

        formItemCategories += '<option value="' 
                    + value['category'] +'"> '
                    + value['category'] +' </option>';

        if(value['category'] == "Others (Network Improvement)" || value['category'] == "Others (New Link)" || value['category'] == "Others (Relocation)"){
            formItemCategories += '</optgroup>';
        }  

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
