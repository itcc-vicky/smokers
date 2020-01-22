@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
<style>

.text-success {
    color: #ff6c60 !important;
}
.text-danger {
    color: #23b9a9 !important;
}

</style>
    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title"> Job
                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">Preview Changes</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Preview Changes
                        <span class="tools pull-right">
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="preview_tab">
                                @csrf

                                <input type="hidden" name="id" value="{{ $job->id }}">
                                <input type="hidden" name="agency_id" id="agency_id" value="{{ $job->agency_id }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="property_manager_name">Property Manager Name<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->property_manager_name != $clonedJob->property_manager_name)
                                                <p class="text-danger m-0"><b><del>{{$job->property_manager_name}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->property_manager_name}}</b></p>
                                            @else
                                                <p>{{$job->property_manager_name}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord">Landlord</label>
                                            @if($job->landlord != $clonedJob->landlord)
                                                <p class="text-danger m-0"><b><del>{{$job->landlord}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->landlord}}</b></p>
                                            @else
                                                <p>{{$job->landlord}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_contact">Landlord Contact</label>
                                            @if($job->landlord_contact != $clonedJob->landlord_contact)
                                                <p class="text-danger m-0"><b><del>{{$job->landlord_contact}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->landlord_contact}}</b></p>
                                            @else
                                                <p>{{$job->landlord_contact}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_email">Landlord Email</label>
                                            @if($job->landlord_email != $clonedJob->landlord_email)
                                                <p class="text-danger m-0"><b><del>{{$job->landlord_email}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->landlord_email}}</b></p>
                                            @else
                                                <p>{{$job->landlord_email}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street_number">No.<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->address_line_1 != $clonedJob->address_line_1)
                                                <p class="text-danger m-0"><b><del>{{$job->address_line_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->address_line_1}}</b></p>
                                            @else
                                                <p>{{$job->address_line_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="route">Street<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->address_line_2 != $clonedJob->address_line_2)
                                                <p class="text-danger m-0"><b><del>{{$job->address_line_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->address_line_2}}</b></p>
                                            @else
                                                <p>{{$job->address_line_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="locality">Suburb<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->city != $clonedJob->city)
                                                <p class="text-danger m-0"><b><del>{{$job->city}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->city}}</b></p>
                                            @else
                                                <p>{{$job->city}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="administrative_area_level_1">State<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->state != $clonedJob->state)
                                                <p class="text-danger m-0"><b><del>{{$job->state}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->state}}</b></p>
                                            @else
                                                <p>{{$job->state}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->country != $clonedJob->country)
                                                <p class="text-danger m-0"><b><del>{{$job->country}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->country}}</b></p>
                                            @else
                                                <p>{{$job->country}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->postal_code != $clonedJob->postal_code)
                                                <p class="text-danger m-0"><b><del>{{$job->postal_code}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->postal_code}}</b></p>
                                            @else
                                                <p>{{$job->postal_code}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location_area">Area Location</label>
                                            @if($job->location_area != $clonedJob->location_area)
                                                <p class="text-danger m-0"><b><del>{{$job->location_area}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->location_area}}</b></p>
                                            @else
                                                <p>{{$job->location_area}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="key">Key #</label>
                                            @if($job->key != $clonedJob->key)
                                                <p class="text-danger m-0"><b><del>{{$job->key}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->key}}</b></p>
                                            @else
                                                <p>{{$job->key}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tenant">Tenant</label>
                                            @if($job->tenant != $clonedJob->tenant)
                                                <p class="text-danger m-0"><b><del>{{$job->tenant}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->tenant}}</b></p>
                                            @else
                                                <p>{{$job->tenant}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_details">Contact Details</label>
                                            @if($job->contact_details != $clonedJob->contact_details)
                                                <p class="text-danger m-0"><b><del>{{$job->contact_details}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->contact_details}}</b></p>
                                            @else
                                                <p>{{$job->contact_details}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_month">Service Month</label>
                                            @if($job->service_month != $clonedJob->service_month)
                                                <p class="text-danger m-0"><b><del>{{$job->service_month}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->service_month}}</b></p>
                                            @else
                                                <p>{{$job->service_month}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            @if($job->status != $clonedJob->status)
                                                <p class="text-danger m-0"><b><del>{{$job->status}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->status}}</b></p>
                                            @else
                                                <p>{{$job->status}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_1">Location 1</label>
                                            @if($job->loc_custom_field_1 != $clonedJob->loc_custom_field_1)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_1}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_1">Type 1</label>
                                            @if($job->t_custom_field_1 != $clonedJob->t_custom_field_1)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_1}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_1">Exp Date 1</label>
                                            @if($job->exp_custom_field_1 != $clonedJob->exp_custom_field_1)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_1 != null ? \Carbon\Carbon::parse($clonedJob->exp_custom_field_1)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_2">Location 2</label>
                                            @if($job->loc_custom_field_2 != $clonedJob->loc_custom_field_2)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_2}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_2">Type 2</label>
                                            @if($job->t_custom_field_2 != $clonedJob->t_custom_field_2)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_2}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_2">Exp Date 2</label>
                                            @if($job->exp_custom_field_2 != $clonedJob->exp_custom_field_2)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_2 != null ? \Carbon\Carbon::parse($clonedJob->exp_custom_field_2)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_3">Location 3</label>
                                            @if($job->loc_custom_field_3 != $clonedJob->loc_custom_field_3)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_3}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_3}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_3}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_3">Type 3</label>
                                            @if($job->t_custom_field_3 != $clonedJob->t_custom_field_3)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_3}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_3}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_3">Exp Date 3</label>
                                            @if($job->exp_custom_field_3 != $clonedJob->exp_custom_field_3)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_3 != null ? \Carbon\Carbon::parse($clonedJob->exp_custom_field_3)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_4">Location 4</label>
                                            @if($job->loc_custom_field_4 != $clonedJob->loc_custom_field_4)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_4}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_4}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_4}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_4">Type 4</label>
                                            @if($job->t_custom_field_4 != $clonedJob->t_custom_field_4)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_4}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_4}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_4}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_4">Exp Date 4</label>
                                            @if($job->exp_custom_field_4 != $clonedJob->exp_custom_field_4)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_4 != null ? \Carbon\Carbon::parse($clonedJob->exp_custom_field_4)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="service_plan">Service Plan</label>
                                            @if($job->service_plan != $clonedJob->service_plan)
                                                <p class="text-danger m-0"><b><del>{{$job->service_plan}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->service_plan}}</b></p>
                                            @else
                                                <p>{{$job->service_plan}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    @if(Auth::user()->role == 'admin')
                                    <div class="col-md-6">
                                        @php
                                            $_services = explode(",", $job->services);
                                        @endphp
                                        <div class="form-group">
                                            <label for="">Services</label>
                                            @if($job->services != $clonedJob->services)
                                                <p class="text-danger m-0"><b><del>{{$job->services}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->services}}</b></p>
                                            @else
                                                <p>{{$job->services}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                </div>

                                @if(Auth::user()->role == 'admin')
                                <div class="row">
                                    <div class="col-md-4" id="alarm_date" style="display: {{ in_array('Alarm', $_services) ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label for="last_alarm_service">Last Alarm Service Date</label>
                                            @if($job->last_alarm_service != $clonedJob->last_alarm_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->last_alarm_service != null ? \Carbon\Carbon::parse($clonedJob->last_alarm_service)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="heater_date" style="display: {{ in_array('Heater', $_services) ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label for="last_heater_service">Last Heater Service Date</label>
                                            @if($job->last_heater_service != $clonedJob->last_heater_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->last_heater_service != null ? \Carbon\Carbon::parse($clonedJob->last_heater_service)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="solar_cleaning_date" style="display: {{ in_array('Solar Cleaning', $_services) ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label for="last_solar_cleaning_service">Last Solar Cleaning Service Date</label>
                                            @if($job->last_solar_cleaning_service != $clonedJob->last_solar_cleaning_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->last_solar_cleaning_service != null ? \Carbon\Carbon::parse($job->last_solar_cleaning_service)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->last_solar_cleaning_service != null ? \Carbon\Carbon::parse($clonedJob->last_solar_cleaning_service)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->last_solar_cleaning_service != null ? \Carbon\Carbon::parse($job->last_solar_cleaning_service)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    @if($job->comments != $clonedJob->comments)
                                        <p class="text-danger m-0"><b><del>{{$job->comments}}</del></b></p>
                                        <p class="text-success m-0"><b>{{$clonedJob->comments}}</b></p>
                                    @else
                                        <p>{{$job->comments}}</p>
                                    @endif
                                </div>

                                <a href="{{ route('jobPostDecline', ['id' => $job->id]) }}" class="btn btn-danger pull-left m-5">Decline</a>
                                <a href="{{ route('jobPostApprove', ['id' => $job->id]) }}" class="btn btn-primary pull-right m-5">Approve</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
