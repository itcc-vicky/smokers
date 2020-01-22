@extends('layouts.app')

@push('styles')
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <style>
        .text-success {
            color: #ff6c60 !important;
        }
        .text-danger {
            color: #23b9a9 !important;
        }
        .bg-light-danger {
            background: #ffafa8!important;
        }
        .panel-body {
            padding: 15px 5px;
        }
    </style>
@endpush


@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title">
                @if(request()->route()->getName() == 'job') Jobs @endif
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                @if(request()->route()->getName() == 'jobDeleted') Deleted Jobs @endif

                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">
                @if(request()->route()->getName() == 'job') Jobs @endif
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                @if(request()->route()->getName() == 'jobDeleted') Deleted Jobs @endif
                </a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading panel-border"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    &nbsp;
                    <span class="new_button pull-right">
                        @if(request()->route()->getName() == 'job')
                        <a href="{{ route('jobAdd') }}" class="btn btn-info "><i class="fa fa-plus"></i> Add New Job</a>
                        @endif
                    </span>
                </header>
                <div class="panel-body">
                    <div class="table table-responsive">
                        <table class="table colvis-responsive-data-table table-striped">
                            <thead>
                                <tr>
                                    <th> Action </th>
                                    <th> Agency Name </th>
                                    <th> Property Manager Name </th>
                                    <th> Landlord </th>
                                    <th> Landlord Contact</th>
                                    <th> Landlord Email </th>
                                    <th> No. </th>
                                    <th> Street </th>
                                    <th> Suburb </th>
                                    <th> State </th>
                                    <th> Postal Code </th>
                                    <th> Key </th>
                                    <th> Country </th>
                                    <th> Area Location </th>
                                    <th> Service Month </th>
                                    <th> Tenant </th>
                                    <th> Contact Details </th>
                                    <th> Status </th>
                                    <th> Location 1 </th>
                                    <th> Type 1 </th>
                                    <th> Exp Date 1 </th>
                                    <th> Location 2 </th>
                                    <th> Type 2 </th>
                                    <th> Exp Date 2 </th>
                                    <th> Location 3 </th>
                                    <th> Type 3 </th>
                                    <th> Exp Date 3 </th>
                                    <th> Location 4 </th>
                                    <th> Type 4 </th>
                                    <th> Exp Date 4 </th>
                                    <th> Comments </th>
                                    <th> Service Plan </th>
                                    <th> Services </th>
                                    <th> Last Alarm Service Date </th>
                                    <th> Last Heater Service Date </th>
                                    <th> Last Solar Cleaning Service Date </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td> <a href="{{ route('jobPreviewChanges', ['id' => $job->job_id]) }}" data-toggle="tooltip" data-placement="top" title="Preview" class="btn btn-primary btn_inline"><i class="fa fa-eye"></i></a> </td>
                                    <td> {{ $job->agency->name }} </td>
                                    <td>
                                        @if($job->originalJob->property_manager_name != $job->property_manager_name)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->property_manager_name}}<del></p>
                                        <p class="text-success m-0">{{$job->property_manager_name}}</p>
                                        @else
                                        {{ $job->property_manager_name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->landlord != $job->landlord)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->landlord}}<del></p>
                                        <p class="text-success m-0">{{$job->landlord}}</p>
                                        @else
                                        {{ $job->landlord }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->landlord_contact != $job->landlord_contact)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->landlord_contact}}<del></p>
                                        <p class="text-success m-0">{{$job->landlord_contact}}</p>
                                        @else
                                        {{ $job->landlord_contact }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->landlord_email != $job->landlord_email)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->landlord_email}}<del></p>
                                        <p class="text-success m-0">{{$job->landlord_email}}</p>
                                        @else
                                        {{ $job->landlord_email }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->address_line_1 != $job->address_line_1)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->address_line_1}}<del></p>
                                        <p class="text-success m-0">{{$job->address_line_1}}</p>
                                        @else
                                        {{ $job->address_line_1 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->address_line_2 != $job->address_line_2)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->address_line_2}}<del></p>
                                        <p class="text-success m-0">{{$job->address_line_2}}</p>
                                        @else
                                        {{ $job->address_line_2 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->city != $job->city)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->city}}<del></p>
                                        <p class="text-success m-0">{{$job->city}}</p>
                                        @else
                                        {{ $job->city }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->state != $job->state)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->state}}<del></p>
                                        <p class="text-success m-0">{{$job->state}}</p>
                                        @else
                                        {{ $job->state }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->postal_code != $job->postal_code)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->postal_code}}<del></p>
                                        <p class="text-success m-0">{{$job->postal_code}}</p>
                                        @else
                                        {{ $job->postal_code }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->key != $job->key)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->key}}<del></p>
                                        <p class="text-success m-0">{{$job->key}}</p>
                                        @else
                                        {{ $job->key }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->country != $job->country)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->country}}<del></p>
                                        <p class="text-success m-0">{{$job->country}}</p>
                                        @else
                                        {{ $job->country }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->location_area != $job->location_area)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->location_area}}<del></p>
                                        <p class="text-success m-0">{{$job->location_area}}</p>
                                        @else
                                        {{ $job->location_area }}
                                        @endif
                                    </td>
                                    <td class="{{ $job->service_month == 'NA' ? 'bg-danger' : '' }}">
                                        @if($job->originalJob->service_month != $job->service_month)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->service_month}}<del></p>
                                        <p class="text-success m-0">{{$job->service_month}}</p>
                                        @else
                                        {{ $job->service_month }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->tenant != $job->tenant)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->tenant}}<del></p>
                                        <p class="text-success m-0">{{$job->tenant}}</p>
                                        @else
                                        {{ $job->tenant }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->contact_details != $job->contact_details)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->contact_details}}<del></p>
                                        <p class="text-success m-0">{{$job->contact_details}}</p>
                                        @else
                                        {{ $job->contact_details }}
                                        @endif
                                    </td>
                                    <td class="{{ $job->status == 'Compliant' ? 'bg-lightgreen' : '' }} {{ $job->status == 'Quoted' ? 'bg-lightorange' : '' }}">
                                        @if($job->originalJob->status != $job->status)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->status}}<del></p>
                                        <p class="text-success m-0">{{$job->status}}</p>
                                        @else
                                        {{ $job->status }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->loc_custom_field_1 != $job->loc_custom_field_1)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->loc_custom_field_1}}<del></p>
                                        <p class="text-success m-0">{{$job->loc_custom_field_1}}</p>
                                        @else
                                        {{ $job->loc_custom_field_1 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->t_custom_field_1 != $job->t_custom_field_1)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->t_custom_field_1}}<del></p>
                                        <p class="text-success m-0">{{$job->t_custom_field_1}}</p>
                                        @else
                                        {{ $job->t_custom_field_1 }}
                                        @endif
                                    </td>
                                    <td class="{{ $job->exp_custom_field_1 != '' && \Carbon\Carbon::parse($job->exp_custom_field_1)->isPast() ? 'bg-light-danger' : ''}}">
                                        @if($job->originalJob->exp_custom_field_1 != $job->exp_custom_field_1)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->originalJob->exp_custom_field_1)->format('d M Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : '' }}</p>
                                        @else
                                        {{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->loc_custom_field_2 != $job->loc_custom_field_2)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->loc_custom_field_2}}<del></p>
                                        <p class="text-success m-0">{{$job->loc_custom_field_2}}</p>
                                        @else
                                        {{ $job->loc_custom_field_2 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->t_custom_field_2 != $job->t_custom_field_2)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->t_custom_field_2}}<del></p>
                                        <p class="text-success m-0">{{$job->t_custom_field_2}}</p>
                                        @else
                                        {{ $job->t_custom_field_2 }}
                                        @endif
                                    </td>
                                    <td class="{{ $job->exp_custom_field_2 != '' && \Carbon\Carbon::parse($job->exp_custom_field_2)->isPast() ? 'bg-light-danger' : ''}}">
                                        @if($job->originalJob->exp_custom_field_2 != $job->exp_custom_field_2)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->originalJob->exp_custom_field_2)->format('d M Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d M Y') : '' }}</p>
                                        @else
                                        {{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d M Y') : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->loc_custom_field_3 != $job->loc_custom_field_3)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->loc_custom_field_3}}<del></p>
                                        <p class="text-success m-0">{{$job->loc_custom_field_3}}</p>
                                        @else
                                        {{ $job->loc_custom_field_3 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->t_custom_field_3 != $job->t_custom_field_3)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->t_custom_field_3}}<del></p>
                                        <p class="text-success m-0">{{$job->t_custom_field_3}}</p>
                                        @else
                                        {{ $job->t_custom_field_3 }}
                                        @endif
                                    </td>
                                    <td class="{{ $job->exp_custom_field_3 != '' && \Carbon\Carbon::parse($job->exp_custom_field_3)->isPast() ? 'bg-light-danger' : ''}}">
                                        @if($job->originalJob->exp_custom_field_3 != $job->exp_custom_field_3)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->originalJob->exp_custom_field_3)->format('d M Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d M Y') : '' }}</p>
                                        @else
                                        {{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->loc_custom_field_4 != $job->loc_custom_field_4)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->loc_custom_field_4}}<del></p>
                                        <p class="text-success m-0">{{$job->loc_custom_field_4}}</p>
                                        @else
                                        {{ $job->loc_custom_field_4 }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->t_custom_field_4 != $job->t_custom_field_4)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->t_custom_field_4}}<del></p>
                                        <p class="text-success m-0">{{$job->t_custom_field_4}}</p>
                                        @else
                                        {{ $job->t_custom_field_4 }}
                                        @endif
                                    </td>
                                    <td class="{{ $job->exp_custom_field_4 != '' && \Carbon\Carbon::parse($job->exp_custom_field_4)->isPast() ? 'bg-light-danger' : ''}}">
                                        @if($job->originalJob->exp_custom_field_4 != $job->exp_custom_field_4)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->originalJob->exp_custom_field_4)->format('d M Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d M Y') : '' }}</p>
                                        @else
                                        {{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d M Y') : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->comments != $job->comments)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->comments}}<del></p>
                                        <p class="text-success m-0">{{$job->comments}}</p>
                                        @else
                                        {{ $job->comments }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->service_plan != $job->service_plan)
                                        <p class="text-danger m-0"><del>{{$job->originalJob->service_plan}}<del></p>
                                        <p class="text-success m-0">{{$job->service_plan}}</p>
                                        @else
                                        {{ $job->service_plan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->services != $job->services)
                                        <p class="text-danger m-0"><del>{{ str_replace(',', ', ', $job->originalJob->services) }}<del></p>
                                        <p class="text-success m-0">{{ str_replace(',', ', ', $job->services) }}</p>
                                        @else
                                        {{ str_replace(',', ', ', $job->services) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->last_alarm_service != $job->last_alarm_service)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->last_alarm_service != null ? \Carbon\Carbon::parse($job->originalJob->last_alarm_service)->format('d-m-Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}</p>
                                        @else
                                        {{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->last_alarm_service != $job->last_alarm_service)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->last_alarm_service != null ? \Carbon\Carbon::parse($job->originalJob->last_alarm_service)->format('d-m-Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}</p>
                                        @else
                                        {{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->originalJob->last_heater_service != $job->last_heater_service)
                                        <p class="text-danger m-0"><del>{{ $job->originalJob->last_heater_service != null ? \Carbon\Carbon::parse($job->originalJob->last_heater_service)->format('d-m-Y') : '' }}<del></p>
                                        <p class="text-success m-0">{{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : '' }}</p>
                                        @else
                                        {{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : '' }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    // window._table_targets = [1];
    window._table_targets = [ 2,3,4,5,10,12,13,16,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35 ];
</script>

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="{{ asset('dist/js/init-datatables.js') }}"></script>

<script>
function openDeleteDialog(formId){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $(formId).submit();
        }
    })
}
</script>
@endpush
