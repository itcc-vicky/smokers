@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
    <style type="text/css">
        .ml-5{ margin-left: 5px; }
    </style>
@endpush
@section('content')
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
                <li><a href="javascript:void(0)" class="active">Edit Job</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Edit Job
                        <span class="tools pull-right">
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form id="deleteJob{{$job->id}}" action="{{ route('jobPostDelete') }}" method="POST">
                                <input type="hidden" name="id" value="{{$job->id}}">
                                @method('DELETE')
                                @csrf
                            </form>
                            <form autocomplete="off" role="form" id="editJobForm" method="POST" action="{{ route('jobPostUpdate') }}">
                                @csrf
                                @if(isset($job->job_id))
                                    <input type="hidden" name="id" value="{{ $job->job_id }}">
                                @else
                                    <input type="hidden" name="id" value="{{ $job->id }}">
                                @endif
                                <input type="hidden" name="agency_id" id="agency_id" value="{{ $job->agency_id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="property_manager_name">Property Manager Name<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="property_manager_name" name="property_manager_name" placeholder="Property Manager Name" type="text" value="{{ $job->property_manager_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord">Landlord</label>
                                            <input class="form-control" id="landlord" name="landlord" placeholder="Landlord" type="text" value="{{ $job->landlord }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_contact">Landlord Contact</label>
                                            <input class="form-control" id="landlord_contact" name="landlord_contact" placeholder="Landlord Contact" type="text" value="{{ $job->landlord_contact }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_email">Landlord Email</label>
                                            <input class="form-control" id="landlord_email" name="landlord_email" placeholder="Landlord Email" type="text" value="{{ $job->landlord_email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="autocomplete">Search Address</label>
                                    <input id="autocomplete" class="form-control" placeholder="Search Address" onFocus="geolocate()" type="text"/>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street_number">No.<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="street_number" name="address_line_1" placeholder="No." type="text" value="{{ $job->address_line_1 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="route">Street<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="route" name="address_line_2" placeholder="Street" type="text" value="{{ $job->address_line_2 }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="locality">Suburb<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="locality" name="city" placeholder="Suburb" type="text" value="{{ $job->city }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="administrative_area_level_1">State<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="administrative_area_level_1" name="state" placeholder="State" type="text" value="{{ $job->state }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="country" name="country" placeholder="Country" type="text" value="{{ $job->country }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" type="text" value="{{ $job->postal_code }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location_area">Area Location</label>
                                            <input class="form-control" id="location_area" name="location_area" placeholder="Area Location" type="text" value="{{ $job->location_area }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="key">Key #</label>
                                            <input class="form-control" id="key" name="key" placeholder="Landlord Contact" type="text" value="{{ $job->key }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tenant">Tenant</label>
                                            <input class="form-control" id="tenant" name="tenant" placeholder="Tenant" type="text" value="{{ $job->tenant }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_details">Contact Details</label>
                                            <input class="form-control" id="contact_details" name="contact_details" placeholder="Contact Details" type="text" value="{{ $job->contact_details }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="{{$job->status == 'Booked In' ? 'col-md-4' : 'col-md-6'}}" id="service_month_div">
                                        <div class="form-group">
                                            <label for="service_month">Service Month</label>
                                            <select class="form-control" id="service_month" name="service_month" placeholder="Service Month" value="{{ $job->service_month }}">
                                                <option value="NA" {{ $job->service_month == 'na' ? 'selected' : '' }}> NA (Not Active) </option>
                                                <option value="January" {{ $job->service_month == 'January' ? 'selected' : '' }}> January </option>
                                                <option value="February" {{ $job->service_month == 'February' ? 'selected' : '' }}> February </option>
                                                <option value="March" {{ $job->service_month == 'March' ? 'selected' : '' }}> March </option>
                                                <option value="April" {{ $job->service_month == 'April' ? 'selected' : '' }}> April </option>
                                                <option value="May" {{ $job->service_month == 'May' ? 'selected' : '' }}> May </option>
                                                <option value="June" {{ $job->service_month == 'June' ? 'selected' : '' }}> June </option>
                                                <option value="July" {{ $job->service_month == 'July' ? 'selected' : '' }}> July </option>
                                                <option value="August" {{ $job->service_month == 'August' ? 'selected' : '' }}> August </option>
                                                <option value="September" {{ $job->service_month == 'September' ? 'selected' : '' }}> September </option>
                                                <option value="October" {{ $job->service_month == 'October' ? 'selected' : '' }}> October </option>
                                                <option value="November" {{ $job->service_month == 'November' ? 'selected' : '' }}> November </option>
                                                <option value="December" {{ $job->service_month == 'December' ? 'selected' : '' }}> December </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="{{$job->status == 'Booked In' ? 'col-md-4' : 'col-md-6'}}" id="status_div">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" placeholder="Status" value="{{ $job->status }}"  onchange="toggleBookedDate(event)">
                                                <option value="" {{ $job->status == '' ? 'selected' : '' }}>Select Status</option>
                                                <option value="Compliant" {{ $job->status == 'Compliant' ? 'selected' : '' }}>Compliant</option>
                                                <option value="Quoted" {{ $job->status == 'Quoted' ? 'selected' : '' }}>Quoted</option>
                                                <option value="Booked In" {{ $job->status == 'Booked In' ? 'selected' : '' }}>Booked In</option>
                                                <option value="Overdue" {{ $job->status == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                                <option value="On Hold" {{ $job->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 {{$job->status == 'Booked In' ? '' : 'hidden'}}" id="booked_date_div">
                                        <div class="form-group">
                                            <label for="booked_date">Booked Date</label>
                                            <input class="form-control datepicker" id="booked_date" name="booked_date" placeholder="DD-MM-YYYY" type="text" value="{{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_1">Location 1</label>
                                            <input class="form-control" id="loc_custom_field_1" name="loc_custom_field_1" placeholder="Location 1" type="text" value="{{ $job->loc_custom_field_1 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_1">Type 1</label>
                                            <input class="form-control" id="t_custom_field_1" name="t_custom_field_1" placeholder="Type 1" type="text" value="{{ $job->t_custom_field_1 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_1">Exp Date 1</label>
                                            <input class="form-control datepicker" id="exp_custom_field_1" name="exp_custom_field_1" placeholder="DD-MM-YYYY" type="text" value="{{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_2">Location 2</label>
                                            <input class="form-control" id="loc_custom_field_2" name="loc_custom_field_2" placeholder="Location 2" type="text" value="{{ $job->loc_custom_field_2 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_2">Type 2</label>
                                            <input class="form-control" id="t_custom_field_2" name="t_custom_field_2" placeholder="Type 2" type="text" value="{{ $job->t_custom_field_2 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_2">Exp Date 2</label>
                                            <input class="form-control datepicker" id="exp_custom_field_2" name="exp_custom_field_2" placeholder="DD-MM-YYYY" type="text" value="{{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_3">Location 3</label>
                                            <input class="form-control" id="loc_custom_field_3" name="loc_custom_field_3" placeholder="Location 3" type="text" value="{{ $job->loc_custom_field_3 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_3">Type 3</label>
                                            <input class="form-control" id="t_custom_field_3" name="t_custom_field_3" placeholder="Type 3" type="text" value="{{ $job->t_custom_field_3 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_3">Exp Date 3</label>
                                            <input class="form-control datepicker" id="exp_custom_field_3" name="exp_custom_field_3" placeholder="DD-MM-YYYY" type="text" value="{{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_4">Location 4</label>
                                            <input class="form-control" id="loc_custom_field_4" name="loc_custom_field_4" placeholder="Location 4" type="text" value="{{ $job->loc_custom_field_4 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_4">Type 4</label>
                                            <input class="form-control" id="t_custom_field_4" name="t_custom_field_4" placeholder="Type 4" type="text" value="{{ $job->t_custom_field_4 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_4">Exp Date 4</label>
                                            <input class="form-control datepicker" id="exp_custom_field_4" name="exp_custom_field_4" placeholder="DD-MM-YYYY" type="text" value="{{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_plan">Service Plan</label>
                                            <select class="form-control" id="service_plan" name="service_plan" placeholder="Service Plan" value="{{ $job->service_plan }}">
                                                <option value="AI" {{ $job->service_plan == 'AI' ? 'selected' : '' }}> AI (All inclusive) </option>
                                                <option value="$77" {{ $job->service_plan == '$77' ? 'selected' : '' }}> $77 </option>
                                                <option value="$66" {{ $job->service_plan == '$66' ? 'selected' : '' }}> $66 </option>
                                                <option value="$55" {{ $job->service_plan == '$55' ? 'selected' : '' }}> $55 </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="referral">Referral</label>
                                            <input class="form-control" id="referral" name="referral" placeholder="Referral" type="text" value="{{ $job->referral }}">
                                        </div>
                                    </div> --}}

                                    @if(Auth::user()->role == 'admin')
                                    <div class="col-md-6">
                                        @php
                                            $_services = explode(",", $job->services);
                                        @endphp
                                        <div class="form-group">
                                            <label for="">Services</label>
                                             <select class="form-control js-example-basic-select2" multiple="multiple" id="services" name="services[]" onchange="toggleServiceDates();">
                                                <option value="Alarm" {{ in_array('Alarm', $_services) ? 'selected' : '' }}>Alarm</option>
                                                <option value="Heater" {{ in_array('Heater', $_services) ? 'selected' : '' }}>Heater</option>
                                                <option value="Solar Cleaning" {{ in_array('Solar Cleaning', $_services) ? 'selected' : '' }}>Solar Cleaning</option>
                                             </select>
                                        </div>
                                    </div>
                                    @endif

                                </div>

                                @if(Auth::user()->role == 'admin')
                                <div class="row">
                                    <div class="col-md-4" id="alarm_date" style="display: {{ in_array('Alarm', $_services) ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label for="last_alarm_service">Last Alarm Service Date<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control past-datepicker" id="last_alarm_service" name="last_alarm_service" placeholder="DD-MM-YYYY" type="text" value="{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="heater_date" style="display: {{ in_array('Heater', $_services) ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label for="last_heater_service">Last Heater Service Date<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control past-datepicker" id="last_heater_service" name="last_heater_service" placeholder="DD-MM-YYYY" type="text" value="{{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="solar_cleaning_date" style="display: {{ in_array('Solar Cleaning', $_services) ? 'block' : 'none' }}">
                                        <div class="form-group">
                                            <label for="last_solar_cleaning_service">Last Solar Cleaning Service Date<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control past-datepicker" id="last_solar_cleaning_service" name="last_solar_cleaning_service" placeholder="DD-MM-YYYY" type="text" value="{{ $job->last_solar_cleaning_service != null ? \Carbon\Carbon::parse($job->last_solar_cleaning_service)->format('d-m-Y') : '' }}">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <textarea class="form-control autoresizenone" id="comments" name="comments" placeholder="Comments" rows="3">{{ $job->comments }}</textarea>
                                </div>

                                <button type="submit" id="editJobButton" class="btn btn-primary pull-right m-5">Submit</button>
                                <a href="{{ route('job') }}" class="btn btn-danger pull-left">Cancel</a>
                                <button type="button" onclick="openDeleteDialog('#deleteJob{{$job->id}}');"  class="btn btn-danger pull-left ml-5">Delete</button>
                                <div class="clearfix"></div>



                                <div id="append_row" style="margin-top: 20px;">
                                    <div class="row form-group">
                                        <label class="col-lg-2 col-form-label">Add Invoice:</label>
                                        <div class="col-lg-10">
                                            <div class="col-md-4">
                                                <input class="form-control" placeholder="Enter email" name="invoice_name[]" type="file">
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" id="services" name="service_name[]" onchange="toggleServiceDates();">
                                                    <option value="Alarm" selected>Alarm</option>
                                                    <option value="Heater">Heater</option>
                                                    <option value="Solar Cleaning">Solar Cleaning</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-info btn_inline" id="add_new_invoice">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            <div class="panel panel-primary" style="margin-top: 20px;">
                                <header class="panel-heading text-left">
                                    Invoices
                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="30%">Date</th>
                                            <th width="30%">Name</th>
                                            <th width="30%">Service</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($job->invoices as $key => $invoice)
                                        <tr>
                                            <td><a href="#">{{$key+1}}</a></td>
                                            <td>{{$invoice->created_at}}</td>
                                            <td class="text-capitalize">{{$invoice->invoice_name}}</td>
                                            <td class="text-capitalize">{{$invoice->service_name}}</td>
                                            <td><a href="#" class="btn btn-info btn_inline">View</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

<script>

$(document).ready(function() {
    $(".js-example-basic-select2").select2({
        placeholder: "Select Service"
    });
    let _count = 1;
    $('#add_new_invoice').on('click', function(e) {
        e.preventDefault();
        $('#append_row').append(`
                <div class="row form-group" id="myrow_`+_count+`">
                    <label class="col-lg-2 col-form-label">Add Invoice:</label>
                    <div class="col-lg-10">
                        <div class="col-md-4">
                            <input class="form-control" placeholder="Enter email" name="invoice_name[]" type="file">
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="services" name="service_name[]" onchange="toggleServiceDates();">
                                <option value="Alarm" selected>Alarm</option>
                                <option value="Heater">Heater</option>
                                <option value="Solar Cleaning">Solar Cleaning</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn_inline removeme" row_id="myrow_`+_count+`">Remove</button>
                        </div>
                    </div>
                </div>
            `);
        _count++;
    });

    $(document).on('click', '.removeme', function(e) {
        e.preventDefault();
        const _removeid = $(this).attr('row_id');
        $('#'+_removeid).remove();
    });
 });
var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
    var options = {
     componentRestrictions: {country: ['au', 'nz']}
     // types: ['geocode']
  };
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), options);

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>

<script>
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function toggleServiceDates(){

    var selectedValues = $('#services').val();
    if(selectedValues){
        if($.inArray("Alarm",selectedValues) !== -1){
            $('#alarm_date').show();
            $('#last_alarm_service').val('{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : "" }}');
        }else{
            $('#last_alarm_service').val(null);
            $('#alarm_date').hide();
        }

        if($.inArray("Heater",selectedValues) !== -1){
            $('#heater_date').show();
            $('#last_heater_service').val('{{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : "" }}');
        }else{
            $('#last_heater_service').val(null);
            $('#heater_date').hide();
        }

        if($.inArray("Solar Cleaning",selectedValues) !== -1){
            $('#solar_cleaning_date').show();
            $('#last_solar_cleaning_service').val('{{ $job->last_solar_cleaning_service != null ? \Carbon\Carbon::parse($job->last_solar_cleaning_service)->format('d-m-Y') : "" }}');
        }else{
            $('#last_solar_cleaning_service').val(null);
            $('#solar_cleaning_date').hide();
        }
    }else{
        $('#last_alarm_service').val(null);
        $('#last_heater_service').val(null);
        $('#last_solar_cleaning_service').val(null);

        $('#alarm_date').hide();
        $('#heater_date').hide();
        $('#solar_cleaning_date').hide();
    }
}

function toggleBookedDate(event){
    console.log(event.target.value);
    if(event.target.value == 'Booked In'){
        $("#booked_date_div").removeClass('hidden');
        $("#status_div").removeClass('col-md-6').addClass('col-md-4');
        $("#service_month_div").removeClass('col-md-6').addClass('col-md-4');
    }else{
        $("#booked_date_div").addClass('hidden');
        $("#status_div").addClass('col-md-6').removeClass('col-md-4');
        $("#service_month_div").addClass('col-md-6').removeClass('col-md-4');
    }
}

$("#editJobButton").click(function(event){
    event.preventDefault();
    if($("#agency_id").val() == ''){
        toastr["error"]("Please Select Agency");
        $('#agency_id').focus();
        return false;
    }
    if($("#property_manager_name").val() == ''){
        toastr["error"]("Enter Property Manager Name");
        $('#property_manager_name').focus();
        return false;
    }

    if($("#landlord_email").val() != ''){
        if( !isEmail($("#landlord_email").val()) ){
            toastr["error"]('Invalid Email');
            $('#landlord_email').focus();
            return false;
        }
    }

    if($("#street_number").val() == ''){
        toastr["error"]("Please Enter No.");
        $('#street_number').focus();
        return false;

    }
    if($("#route").val() == ''){
        toastr["error"]("Please Enter Street");
        $('#route').focus();
        return false;

    }
    if($("#locality").val() == ''){
        toastr["error"]("Please Enter Suburb");
        $('#locality').focus();
        return false;

    }
    if($("#administrative_area_level_1").val() == ''){
        toastr["error"]("Please Enter State");
        $('#administrative_area_level_1').focus();
        return false;

    }
    if($("#country").val() == ''){
        toastr["error"]("Please Enter Country");
        $('#country').focus();
        return false;

    }
    if($("#postal_code").val() == ''){
        toastr["error"]("Please Enter Zip Code");
        $('#postal_code').focus();
        return false;

    }
    var selectedValues = $('#services').val();
    if($.inArray("Alarm",selectedValues) !== -1){
        if($("#last_alarm_service").val() == '' ){
            toastr["error"]("Please Select Date");
            $("#last_alarm_service").focus();
            return false;
        }
    }
    if($.inArray("Heater",selectedValues) !== -1){
        if($("#last_heater_service").val() == '' ){
            toastr["error"]("Please Select Date");
            $("#last_heater_service").focus();
            return false;
        }
    }
    if($.inArray("Solar Cleaning",selectedValues) !== -1){
        if($("#last_solar_cleaning_service").val() == '' ){
            toastr["error"]("Please Select Date");
            $("#last_solar_cleaning_service").focus();
            return false;
        }
    }
    $("#editJobForm").submit();

});

</script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            clearBtn: true
        });
</script>
<script>
        $('.past-datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            endDate: '+0d',
        });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('settings.googlePlacesAPIKey') }}&libraries=places&callback=initAutocomplete"></script>
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
