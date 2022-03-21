@if(session()->has('message'))
    <div class="alert alert-success">
        <?php 
            $message = session()->get('message');
            echo "<script> alert('$message'); </script>";
        ?>
    </div>
@endif

<?php
$jsonCategory = $categories->toJson();
$limit=5; //Default ROFI limit.
$date=date("d/m");
$counter = $daily_counter['counter'];
$counter++;
?>

<style>

label{block font-medium text-sm text-gray-700}

</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Order Form') }}
        </h2>
    </x-slot>

    <!-- Request Order Form starts here -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" class="flex" action="{{ route('saveROF') }}">
                        @csrf
                        <div class="flex-initial">

                            <!-- Requested By -->
                            <div class="mt-4">
                                <x-label for="requested_by" :value="__('Requested by:')" />
                                <x-label for="requested_by" :value="Auth::user()->name" />
                                <x-input id="requested_by" type="hidden" name="requested_by" value='{{ Auth::user()->name }}' required autofocus />
                            </div>
                            <!-- Form reference no. -->
                            <div class="mt-4">
                                <x-label for="form_ref_no" :value="__('Form Ref. No.:')" />
                                <x-label for="form_ref_no" :value="__('CTS/NTW/ROF/').$date.sprintf('-%03d', $counter)" />
                                <x-input id="counter" type="hidden" name="counter" value='{{ $counter }}' required autofocus />
                                <!--Check the value passed for the line below!!-->
                                <x-input id="form_ref_no" class="block mt-1 w-40" type="hidden" name="form_ref_no" value="CTS/NTW/ROF/{{$date.sprintf('-%03d', $counter);}}" required autofocus />
                            </div>
                            <!-- Department -->
                            <div class="mt-4">
                                <x-label for="department" :value="__('Department:')" />
                                <x-label for="department" :value="Auth::user()->dept" />
                                <x-input id="department" class="block mt-1 w-40" type="hidden" name="department" value='{{ Auth::user()->dept }}' required autofocus />
                            </div>
                            <!-- Project -->
                            <div class="flex mt-4">
                                <x-label for="project" :value="__('Project:')"/><br>
                            </div>
                            <div class="flex mt-1">
                                <x-input type="radio" id="transmission" name="project" value="transmission" required/>
                                <x-label for="transmission" :value="__('Transmission')"/><br>
                                <x-input type="radio" id="ftth" name="project" value="ftth"/>
                                <x-label for="ftth" :value="__('Fiber to the Home')"/><br>
                            </div>
                            <!--Request Order Type-->
                            <div class="mt-4">
                                <x-label for="request_order_type" :value="__('Request Order Type')"/>
                                <x-input type="text" class="mt-4" placeholder="Others" list="order_type" id="request_order_type" name="request_order_type"  required/>
                                <datalist id="order_type">
                                    <option value="New Project">
                                    <option value="Desktop Survey">
                                    <option value="Site Survey">
                                </datalist>
                            </div>
                            <!-- Date -->
                            <div class="mt-4">
                                <x-label for="date" :value="__('Date: ').date('d/m/Y')" />
                                <x-input hidden type="text" id="date" name="date" value="{{ date('d/m/Y') }}"/>
                            </div>
                            <!-- Time -->
                            <div class="mt-4">
                                <x-label for="time" :value="__('Time: ').date('H:i')" />
                                <x-input hidden type="text" id="time" name="time" value="{{ date('H:i') }}"/>
                            </div>
                            <!-- Others -->
                            <div class="mt-4">
                                <x-label for="others" :value="__('Other details:')" />
                                <x-input id="others" type="text" name="others" autofocus />

                                <x-input id="approved_at" hidden type="text" name="approved_at" value="" autofocus />
                                <x-input id="approved_by" hidden type="text" name="approved_by" value="" autofocus />
                                <x-input id="received_by" hidden type="text" name="received_by" value="" autofocus />
                                <x-input id="received_at" hidden type="text" name="received_at" value="" autofocus />
                            </div>
                        </div>

                        <!--Request Order Items-->
                        <div class="flex-auto pl-3 ml-3 mt-3">
                            <x-label for="rofi" :value="__('Request Order Items:')" /><br>
                            <table class="table-auto" id="rofi">
                                <thead>
                                    <tr>
                                        <th><x-label class="w-6" for="rofi" :value="__('No.')" /></th>
                                        <th><x-label for="rofi" :value="__('Item Ref. No.')" /></th> 
                                        <th><x-label for="rofi" :value="__('Link')" /></th>
                                        <th><x-label for="rofi" :value="__('Remarks')" /></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @for ($i = 1; $i <= $limit; $i++)
                                    <tr>
                                        <td><x-label for="rofi_no" :value="__($i)"/></td>
                                        <x-input for="rofi" id="item_no{{ $i }}" type="text" hidden name="item_no{{ $i }}" value="{{ $i }}"/>
                                        <td><x-input for="rofi" disabled id="view_item_ref_no{{ $i }}" class="mt-1 w-40" type="text" name="view_item_ref_no{{ $i }}" autofocus /></td>
                                        <x-input for="rofi" id="item_ref_no{{ $i }}" class="mt-1 w-40" type="hidden" name="item_ref_no{{ $i }}" autofocus />
                                        <td><x-input for="rofi" id="link{{ $i }}" class="mt-1 w-40" type="text" name="link{{ $i }}" autofocus/></td>
                                        <td>
                                        <select onchange="setIRN(this.value, {{ $i }})" name='remarks{{ $i }}' id='remarks{{ $i }}' :value="old('remarks{{ $i }}')" class="mt-1 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
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
                                <x-input id="indexNum" hidden type="text" name="indexNum" value="{{ $i }}" autofocus />
                                </tbody>
                            </table>    
                            {{-- <x-button class="mt-4" name="add" id="dynamic-ar">Add Item</x-button> --}}
                            <x-button class="mt-4 float-right" type="submit">Submit</x-button>
                        </div>
                        
                    </form><br><br>
                </div>
                
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Requested by</th>
                                <th>Form Ref. No.</th> 
                                <th>Department </th>
                                <th>Project type </th>
                                <th>Date</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0;?>
                            @foreach($rofs as $rof)
                            <tr>
                                <td> {{ $rof_index = $total_rof - $rof['id'] + 1; }} </td>
                                <td> {{ $rof['requested_by'] }} </td>
                                <td> {{ $rof['form_ref_no'] }} </td>
                                <td> {{ $rof->user()->value('dept'); }} </td>
                                <td> {{ $rof['project_type'] }} </td>
                                <td> {{ $rof['date'] }} </td>
                                {{-- <td> <x-button onclick="window.location='{{ URL::route('showROF') }}'">See details</x-button><x-button>Approve</x-button> </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $rofs->links()  }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    
    const labelCount = [0,0,0];
    const categoryA = "Network Improvement High Loss Aging Cable Protection Others (Existing Link)";
    const categoryB = "ISP Enterprise Others (New Link)";
    const categoryC = "BHP Local Authority Others (Relocation)";
    let previousLabel = "0", previousIndex = 0, label;

    //This var refers to the ROFI limit in line 3, used in add new row function
    var i = 5; 
    const jsonCategory = <?= $jsonCategory?>;

    //alert(jsonCategory);
    //jsonCategory['category'].forEach(function(element){alert(element);})

    var formAppend1 = '<tr><td><label class="mt-3" for="rofi_no">',
        formAppend2 = '</label></td><td><input id="date" class="mt-1 w-40" type="text" name="date" required autofocus></td><td><input id="date" class="mt-1 w-40" type="text" name="date" required autofocus></td><td><select class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">';
        formAppend3 = '<option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option><option value="Network Improvement">Network Improvement</option></select></td></tr>';              
        formAppend23 =formAppend2 + formAppend3;

    //Below function adds new row of fields.
    $("#dynamic-ar").click(function () {
        ++i;
        var targetDiv = document.getElementById('rofi');

        //$("#rofi").append('<tr><td><label for="rofi_no">' + i + '</label></td><td><input id="date" class="mt-1 w-40" type="text" name="date" required autofocus></td><td><input id="date" class="mt-1 w-40" type="text" name="date" required autofocus></td><td><select class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"><option value="Network Improvement">Network Improvement</option></select></td></tr>');
        $("#rofi").append(formAppend1, i, formAppend23);
    });
    
    //Below function should remove additional row of fields.
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });

    //This function automatically build Item Ref No and set it to ROF Item form 
    function setIRN(val, itemIndex) { 
        
        let itemRefNo, labelIndex;
        let currentItemRefNo = document.getElementById('item_ref_no' + itemIndex).value;
        let setRequired = document.getElementById('link' + itemIndex).value;

        if (currentItemRefNo != null || currentItemRefNo != undefined ){
            if (currentItemRefNo.includes("A")) {
                labelCount[0]--;
            }
            else if (currentItemRefNo.includes("B")) {
                labelCount[1]--;
            }
            else if (currentItemRefNo.includes("C")){
                labelCount[2]--;
            }                              
        }

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
            itemRefNo = '';
        }

        document.getElementById('view_item_ref_no' + itemIndex).value = itemRefNo;
        document.getElementById('item_ref_no' + itemIndex).value = itemRefNo;
    }   
</script>
