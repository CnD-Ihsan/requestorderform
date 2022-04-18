<title>Request Order Form</title>
@include('layouts.app')
<?php
$jsonCategory = $categories->toJson();
$limit=5; //Default ROFI limit.
$date=date("d/m");
$counter = $daily_counter['counter'];
$counter++;

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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                <td colspan="3">: <input id="others" type="text" name="others" autocomplete="off" autofocus ></input></td>

                                <td><x-label style="font-weight: bold;" for="request_order_type" :value="__('Request Order Type')"/></td>
                                <td>:
                                    <input type="text" placeholder="Others" list="order_type" id="request_order_type" name="request_order_type"  required/></input>
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
                                        <th style="width:5%;">No.</th>
                                        <th style="width:80%;">Link</th>
                                        <th style="width:40%;">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="appendRow" >
                                @for ($i = 1; $i <= $limit; $i++)
                                    <tr>
                                        <td><x-label for="item_no{{ $i }}" :value="__($i)"/></td>
                                        <x-input for="rofi" id="item_no{{ $i }}" type="text" hidden name="item_no{{ $i }}" value="{{ $i }}"/>
                                        <td><input for="rofi" id="link{{ $i }}" class="{{ $inputStyling }}" type="text" name="link{{ $i }}"></input></td>
                                        <td>
                                            <select onchange="setIRN(this.value, {{ $i }})" name='remarks{{ $i }}' id='remarks{{ $i }}' :value="old('remarks{{ $i }}')" class="setIRN {{ $inputStyling }}">
                                                <option selected value="blank"> 
                                                </option>  
                                                @foreach($categories as $category=>$value)
                                                    <option value="{{ $value['category'] }}"> 
                                                    {{ $value['category'] }}
                                                    </option>  
                                                @endforeach 
                                            </select>
                                        </td>
                                    </tr>
                                @endfor
                                {{-- <tr style='visibility:collapse'></tr> --}}
                                <x-input id="indexNum" hidden type="text" name="indexNum" value="{{ $i }}" autofocus />
                                </tbody>
                            </table>
                            <br>
                            <button class="btn btn-primary" type="button" name="add" id="dynamic-ar">+ Row</button>
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
    
    const labelCount = [0,0,0];
    const categoryA = "Network Improvement High Loss Aging Cable Protection Others (Existing Link)";
    const categoryB = "ISP Enterprise Others (New Link)";
    const categoryC = "BHP Local Authority Others (Relocation)";
    let previousLabel = "0", previousIndex = 0, label;

    //This var refers to the ROFI limit declared at the top PHP lines, used in adding a new row function
    var i = {{ --$i }}; 
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
    $("#dynamic-ar").click(function () {
        i++;
        formAddItem = '<tr><td><label class="mt-3" for="item_no' + i + '">' 
                        + i + '<input for="rofi" id="item_no' + i + '" type="hidden" name="item_no' + i + '" value="' 
                        + i + '"></input></label></td><td><input id="link' + i + '" class="mt-1 w-40" type="text" name="link' 
                        + i + '" autofocus></td><td><select onchange="setIRN(this.value, ' + i + ')" name="remarks' + i + '" id="remarks' 
                        + i + '" class="setIRN form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">'
                        + '<option selected value ="blank"></option>' + formItemCategories + '</select></td></tr>'; 

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
    
    //Below function should remove additional row of fields.
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });

    //This function automatically build Item Ref No and set it to ROF Item form 
    function setIRN(val, itemIndex) { 

        let itemRefNo = '', labelIndex;
        let currentItemRefNo = document.getElementById('item_ref_no' + itemIndex).value;
        let setRequired = document.getElementById('link' + itemIndex).value;
        
        if (currentItemRefNo !== ''){

            if((currentItemRefNo.includes("A") && categoryA.includes(val))
                ||(currentItemRefNo.includes("B") && categoryB.includes(val))
                    ||(currentItemRefNo.includes("C") && categoryC.includes(val)))
            {
                itemRefNo = currentItemRefNo;
            }
            else{    
                if (currentItemRefNo.includes("A")){ 
                        labelCount[0]--;
                    }
                    else if (currentItemRefNo.includes("B")) {
                        labelCount[1]--;
                    }
                    else if (currentItemRefNo.includes("C")) { 
                        labelCount[2]--; 
                }    
                 
                if (categoryA.includes(val)) {
                    labelCount[0]++;
                    label = "A";
                    itemRefNo = label + ("-00" + labelCount[0]).slice (-4);
                }
                else if (categoryB.includes(val)) {
                    labelCount[1]++;
                    label = "B";
                    itemRefNo = label + ("-00" + labelCount[1]).slice (-4);
                }
                else if (categoryC.includes(val)){
                    labelCount[2]++;
                    label = "C";
                    itemRefNo = label + ("-00" + labelCount[2]).slice (-4);
                }  
                else {
                    itemRefNo = '';
                    document.getElementById('link' + itemIndex).value = itemRefNo;
                } 
            }


            // if (currentItemRefNo.includes("A") && categoryA.includes(val)) {
            //     labelCount[0] = parseInt(refNoSubstring);
            //     label = "A";
            //     itemRefNo = label + ("-00" + labelCount[0]).slice (-4);
            // }
            // else if (currentItemRefNo.includes("B")) {
            //     labelCount[1] = parseInt(refNoSubstring);
            //     label = "B";
            //     itemRefNo = label + ("-00" + labelCount[1]).slice (-4);
            // }
            // else if (currentItemRefNo.includes("C")){
            //     labelCount[2] = parseInt(refNoSubstring);
            //     label = "C";
            //     itemRefNo = label + ("-00" + labelCount[2]).slice (-4);
            // }                              
        }
        else{
            if (categoryA.includes(val)) {
                label = "A";
                labelCount[0]++;
                itemRefNo = label + ("-00" + labelCount[0]).slice (-4);
            }
            else if (categoryB.includes(val)) {
                label = "B";
                labelCount[1]++;
                itemRefNo = label + ("-00" + labelCount[1]).slice (-4);
            }
            else if (categoryC.includes(val)) {
                label = "C";
                labelCount[2]++;
                itemRefNo = label +  ("-00" + labelCount[2]).slice (-4);
            } 
            else {
                if (currentItemRefNo.includes("A")){ 
                    labelCount[0]--;
                }
                else if (currentItemRefNo.includes("B")) {
                    labelCount[1]--;
                }
                else if (currentItemRefNo.includes("C")) { 
                    labelCount[2]--; 
                }
                itemRefNo = '';
                document.getElementById('link' + itemIndex).value = itemRefNo;
            }
        }




        document.getElementById('view_item_ref_no' + itemIndex).value = itemRefNo;
        document.getElementById('item_ref_no' + itemIndex).value = itemRefNo;
        updateRequirements(val, itemIndex);
    }   

</script>
