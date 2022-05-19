<!DOCTYPE html>

@if(session()->has('message'))
    <div class="alert alert-success">
        <?php
            $message = session()->get('message');
            echo "
                <script> 
                    alert('$message'); 
                </script>
            ";
        ?>
    </div>
@endif

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src={{ asset('js/script.js') }} type="text/javascript"></script>

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
            hr{
                border-top: 1px solid;
            }
        </style>
    </head>

    <body class="antialiased">
        @include('sweetalert::alert')
        <div class="mx-auto" style="width:60%">
            <div class="py-3"><x-application-logo class="w-20 h-20 fill-current text-gray-500" /></div>
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
                            <td class=""><div class=""><b>: </b>{{ $details->user['user_group'] }}</div></td>
                            <td class=""><div class="font-weight-bold">Request Date</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['date'] }}</div></td>
                        </tr>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Project</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['project_type'] }}</div></td>
                            <td class=""><div class="font-weight-bold">Request Time</div></td>
                            <td class=""><div class=""><b>: </b>{{ $details['time'] }}</div></td>
                        </tr>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Other details</div></td>
                            <td colspan="3" class=""><div class=""><b>:</b> {{ $details['others'] }}</div></td>
                        </tr>
                        <tr class="">
                            <td class=""><div class="font-weight-bold">Appointed to</div></td>
                            <td colspan="3" class=""><div class=""><h5>: <u>{{ $details['request_to'] }}</u></h5> </div></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row pt-4">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Item Ref. No.</th>
                                <th scope="col">Link</th>
                                <th scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($details->rofItems->first())
                                @foreach($details->rofItems as $rofi)
                                    <tr>
                                        <th scope="row">{{ $rofi->item_no}}</th>
                                        <td>{{ $rofi->item_ref_no }}</td>
                                        <td>{{ $rofi->link }}</td>
                                        <td>{{ $rofi->category }}</td>
                                    </tr> 
                                @endforeach 
                            @else
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
                            <td colspan="2" class="no-bot-padding"><div class="font-weight-bold">Request Order Type</div></td>
                            <td colspan="2" class="no-bot-padding"><div class="font-weight-bold">Status</div></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="no-top-padding"><div>{{ $details['order_type'] }}</div></td>
                            <td colspan="2" class="no-top-padding"><div>{{ $details['status'] }}</div></td>
                        </tr>
                        <tr><td colspan="4" class="no-bot-padding"><div class="font-weight-bold">Requested by</div></td></tr>
                        <tr><td colspan="4" class="no-bot-padding"><div><img src="{{ asset('img/USER/'.$requested_by.'.png') }}"  style="width:256px;height:72px;"></div></td></tr>
                        <tr>
                            <td class="no-bot-padding"><div class="font-weight-bold">Name </div></td>
                            <td colspan="3" class="no-bot-padding"><div>: {{ $details['requested_by'] }}</div></td>
                        </tr>
                        <tr>
                            <td class="no-top-padding"><div class="font-weight-bold">Date </div></td>
                            <td colspan="3" class="no-top-padding"><div>: {{ $details['date'] }}</div></td>
                        </tr>
                        <tr>
                            <td colspan="4"><hr></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="no-bot-padding w-50"><div class="font-weight-bold">{{ ($details['status'] == "Rejected") ? "Rejected" : "Approved" }} by</div></td>
                            <td colspan="2" class="no-bot-padding"><div class="font-weight-bold">Received by</div></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div>
                                    @if($checked_by != "Pending")
                                        <img src="{{ asset('img/HOD/'.$checked_by.'.png') }}"  style="width:256px;height:72px;">
                                    @endif
                                </div>
                            </td>
                            <td colspan="2"><div></div></td>
                        </tr>
                        <tr>
                            <td class="no-bot-padding"><div class="font-weight-bold">Name </div></td>
                            <td class="no-bot-padding"><div>: {{ $details['checked_by'] }}</div></td>
                            <td class="no-bot-padding w-25"><div class="font-weight-bold">Name </div></td>
                            <td class="no-bot-padding"><div>:</div></td>
                        </tr>
                        <tr>
                            <td class="no-top-padding"><div class="font-weight-bold">Date </div></td>
                            <td class="no-top-padding"><div>: {{ $details['checked_at'] }} </div></td>
                            <td class="no-top-padding"><div class="font-weight-bold">Date</div></td>
                            <td class="no-top-padding"><div>:</div></td>
                        </tr>
                        <tr {{ $details['status'] == "Rejected" ? "" : "hidden"; }}>
                            <td colspan=4 class=""><div class="font-weight-bold">Remarks: </div></td>
                        </tr>
                        <tr>
                            <td colspan=4 class="no-top-padding"><div>{{ $details['remarks'] }}</div></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row pt-5">
                    <div class="col">
                        @if (auth()->user()->user_type == "HOD" && $details['status'] == 'Pending')
                            <button onclick="approveROF({{ $details['rof_id'] }})" class="approve-button btn btn-success m-1">Approve</button>
                            <button onclick="rejectROF({{ $details['rof_id'] }})" class="reject-button btn btn-danger m-1">Reject</button>
                        @endif

                        <a href="{{ route('downloadPDF', [$details['rof_id']]); }}" target="_blank" class="btn btn-warning">Save as PDF</a>

                        @if (auth()->user()->user_type == "User" && $details['status'] == "Pending")
                            <a id="edit_{{ $details->rof_id }}" href="{{ route('editROF', [$details['rof_id']]); }}" class="btn btn-warning m-1">Edit Details</a>
                        @endif

                        <a type="button" href="{{ route('indexROF') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

