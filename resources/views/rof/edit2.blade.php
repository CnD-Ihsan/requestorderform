<!DOCTYPE html>

<?php
$i = 0;
?>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <title>Request Order Form</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            @page {
            size: 21cm 29.7cm;
            margin: 0;
            }

            body {
                font-family: 'Nunito', sans-serif;
                /* padding: .5in; */
            }
            th, td{
                padding: 12px;
                padding-left: 0px;
            }

            td.no-top-padding {
                padding-top: 0px;
            }
            td.no-bot-padding {
                padding-bottom: 0px;
            }
        </style>
    </head>

    <body class="antialiased">
        @include('sweetalert::alert')
        <div class="mx-auto" style="width:60%">
            <div><h3 class="text-white bg-dark px-4" style="text-align:center;"><b>ENG-F01 | REQUEST ORDER FORM</b></h3></div>
            <div class="container">

                <table style="width:100%; margin:auto;">
                    <thead></thead>
                    <tbody>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Requested By</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['requested_by'] }}</div></td>
                            <td class=""><div class="font-weight-bold">Form Ref. No.</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['form_ref_no'] }}</div></td>
                        </tr>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Department</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details->user['dept'] }}</div></td>
                            <td class=""><div class="font-weight-bold">Request Date</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['date'] }}</div></td>
                        </tr>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Project</div></td>
                            <td class="">
                                <div class=""><b>: </b>
                                    <select>
                                        <option {{ $details['project_type'] == "Transmission" ? "selected" : "" }} value="">Transmission</option>
                                        <option {{ $details['project_type'] != "Transmission" ? "selected" : "" }} value="">Fiber to the Home</option>
                                    </select>
                                </div>
                            </td>
                            <td class=""><div class="font-weight-bold">Request Time</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['time'] }}</div></td>
                        </tr>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Other details</div></td>
                            <td colspan="3" class=""><div class=""><b>: </b> <input type="text" value="{{ $details['others'] }}"></div></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row pt-4">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Link</th>
                                <th scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($details->rofItems->first())
                                @foreach($details->rofItems as $rofi)
                                    <tr>
                                        <input id="item_no_{{ ++$i }}" type="hidden" value="{{ $rofi->item_no }}">
                                        <td><input type="text" value="{{ $rofi->link }}"></td>
                                        <td>
                                            <select id='remarks{{ $i }}'>
                                                <option value=""> {{ $rofi->category }}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category }}">{{ $category }}</option>    
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr> 
                                @endforeach 
                            @else<title>Request Order Form</title>
                            @include('layouts.app')
                            <?php
                            $jsonCategory = $categories->toJson();
                            $i=1; //Item counter
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
                                                                    <th style="width:70%;">Link</th>
                                                                    <th style="width:30%;">Remarks</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="appendRow" >
                                                            <tr>
                                                                <td><input for="rofi" id="link{{ $i }}" class="{{ $inputStyling }}" type="text" name="link{{ $i }}"></input></td>
                                                                <td>
                                                                    <select name='remarks{{ $i }}' id='remarks{{ $i }}' :value="old('remarks{{ $i }}')" class="{{ $inputStyling }}">
                                                                        <option selected value="blank"> 
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
                                $("#dynamic-ar").click(function () {
                                    i++;
                                    formAddItem = '<tr><td><input id="link' + i + '" class="mt-1 w-40" type="text" name="link' 
                                                    + i + '" autofocus></td><td><select name="remarks' + i + '" id="remarks' 
                                                    + i + '" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">'
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
                            
                                <tr>
                                    <td colspan=4>No Link was provided</td>
                                </tr> 
                            @endif
                        </tbody>
                    </table>
                </div>

                <table style="width:100%; margin:auto;">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td class="no-bot-padding"><div class="font-weight-bold">Request Order Type</div></td>
                            <td class="no-bot-padding"><div class="font-weight-bold">Status</div></td>
                        </tr>
                        <tr>
                            <td class="no-top-padding"><div>{{ $details['order_type'] }}</div></td>
                            <td class="no-top-padding"><div>{{ $details['status'] }}</div></td>
                        </tr>
                        <tr>
                            <td class="no-bot-padding"><div class="font-weight-bold">{{ ($details['status'] == "Rejected") ? "Rejected" : "Approved" }} by</div></td>
                            <td class="no-bot-padding"><div class="font-weight-bold">Received by</div></td>
                        </tr>
                        <tr>
                            <td class="no-top-padding"><div>{{ $details['approved_by'] }} </div></td>
                            <td class="no-top-padding"><div>(Placeholder)</div></td>
                        </tr>
                        <tr>
                            <td class="no-bot-padding"><div class="font-weight-bold">{{ ($details['status'] == "Rejected") ? "Rejection" : "Approval" }} date</div></td>
                            <td class="no-bot-padding"><div class="font-weight-bold">Receipt date</div></td>
                        </tr>
                        <tr>
                            <td class="no-top-padding"><div>{{ $details['approved_at'] }} </div></td>
                            <td class="no-top-padding"><div>(Placeholder)</div></td>
                        </tr>
                        <tr>
                            <td colspan=2 class=""><div class="font-weight-bold">Remarks: </div></td>
                        </tr>
                        <tr>
                            <td colspan=2 class="no-top-padding"><div>{{ $details['remarks'] }}</div></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row pt-5">
                    <div class="col">
                        <button type="button" onclick="" class="btn btn-success">Save</button>
                        <button type="button" onclick="history.back()" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
