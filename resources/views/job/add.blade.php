@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">

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
                <li><a href="javascript:void(0)" class="active">Add Job</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Add New Job
                        <span class="tools pull-right">
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form role="form" autocomplete="off" id="addJobForm" method="POST" action="{{ route('jobPostUpdate') }}">
                                @csrf

                                @if(\Auth::user()->role == 'admin')
                                    <div class="form-group">
                                        <label for="agency_id">Agency<span class="text-danger">&nbsp;*</span></label>
                                        <select class="form-control mb-10" onchange="$('#property_manager_name').val($(this).children('option:selected').data('pm'));" id="agency_id" name="agency_id">
                                            <option value="" data-pm="">Select Agency</option>
                                            @foreach($agencyList as $agency)
                                            <option data-pm="{{$agency->property_manager_name}}" value="{{$agency->id}}">{{ $agency->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('agency_id')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="property_manager_name">Property Manager Name<span class="text-danger">&nbsp;*</span></label>
                                                <input class="form-control" id="property_manager_name" name="property_manager_name" readonly placeholder="Property Manager Name" type="text" value="{{ old('property_manager_name') }}">
                                                @error('property_manager_name')
                                                    <span class="text-danger" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="landlord">Landlord</label>
                                                <input class="form-control" id="landlord" name="landlord" placeholder="Landlord" type="text" value="{{ old('landlord') }}">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="agency_id" id="agency_id" value="{{ \Auth::Id() }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="property_manager_name">Property Manager Name</label>
                                                <input class="form-control" id="property_manager_name" name="property_manager_name" readonly placeholder="Property Manager Name" type="text" value="{{ \Auth::user()->property_manager_name }}">
                                                @error('property_manager_name')
                                                    <span class="text-danger" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="landlord">Landlord</label>
                                                <input class="form-control" id="landlord" name="landlord" placeholder="Landlord" type="text" value="{{ old('landlord') }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_contact">Landlord Contact</label>
                                            <input class="form-control" id="landlord_contact" name="landlord_contact" placeholder="Landlord Contact" type="text" value="{{ old('landlord_contact') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_email">Landlord Email</label>
                                            <input class="form-control" id="landlord_email" name="landlord_email" placeholder="Landlord Email" type="text" value="{{ old('landlord_email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Search Address</label>
                                    <input id="autocomplete" class="form-control" placeholder="Search Address" onFocus="geolocate()" type="text"/>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street_number">No.<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="street_number" name="address_line_1" placeholder="No." type="text" value="{{ old('address_line_1') }}">
                                            @error('address_line_1')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="route">Street<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="route" name="address_line_2" placeholder="Street" type="text" value="{{ old('address_line_2') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="locality">Suburb<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="locality" name="city" placeholder="Suburb" type="text" value="{{ old('city') }}">
                                            @error('city')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="administrative_area_level_1">State<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="administrative_area_level_1" name="state" placeholder="State" type="text" value="{{ old('state') }}">
                                            @error('state')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="country" name="country" placeholder="Country" type="text" value="{{ old('country') }}">
                                            @error('country')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" type="text" value="{{ old('postal_code') }}">
                                            @error('postal_code')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="location_area">Area Location</label>
                                            <input class="form-control" id="location_area" name="location_area" placeholder="Area Location" type="text" value="{{ old('location_area') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="key">Key #</label>
                                            <input class="form-control" id="key" name="key" placeholder="Key #" type="text" value="{{ old('key') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tenant">Tenant</label>
                                            <input class="form-control" id="tenant" name="tenant" placeholder="Tenant" type="text" value="{{ old('tenant') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_details">Contact Details</label>
                                            <input class="form-control" id="contact_details" name="contact_details" placeholder="Contact Details" type="text" value="{{ old('contact_details') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_month">Service Month</label>
                                            <select class="form-control" id="service_month" name="service_month" placeholder="Service Month">
                                                <option value="NA" {{ old('service_month') == 'NA' ? 'selected' : '' }}> NA (Not Active)</option>
                                                <option value="January" {{ old('service_month') == 'January' ? 'selected' : '' }}> January </option>
                                                <option value="February" {{ old('service_month') == 'February' ? 'selected' : '' }}> February </option>
                                                <option value="March" {{ old('service_month') == 'March' ? 'selected' : '' }}> March </option>
                                                <option value="April" {{ old('service_month') == 'April' ? 'selected' : '' }}> April </option>
                                                <option value="May" {{ old('service_month') == 'May' ? 'selected' : '' }}> May </option>
                                                <option value="June" {{ old('service_month') == 'June' ? 'selected' : '' }}> June </option>
                                                <option value="July" {{ old('service_month') == 'July' ? 'selected' : '' }}> July </option>
                                                <option value="August" {{ old('service_month') == 'August' ? 'selected' : '' }}> August </option>
                                                <option value="September" {{ old('service_month') == 'September' ? 'selected' : '' }}> September </option>
                                                <option value="October" {{ old('service_month') == 'October' ? 'selected' : '' }}> October </option>
                                                <option value="November" {{ old('service_month') == 'November' ? 'selected' : '' }}> November </option>
                                                <option value="December" {{ old('service_month') == 'December' ? 'selected' : '' }}> December </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" placeholder="Status" value="{{ old('status') }}">
                                                <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Status</option>
                                                <option value="Compliant" {{ old('status') == 'Compliant' ? 'selected' : '' }}>Compliant</option>
                                                <option value="Quoted" {{ old('status') == 'Quoted' ? 'selected' : '' }}>Quoted</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_1">Location 1</label>
                                            <input class="form-control" id="loc_custom_field_1" name="loc_custom_field_1" placeholder="Location 1" type="text" value="{{ old('loc_custom_field_1') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_1">Type 1</label>
                                            <input class="form-control" id="t_custom_field_1" name="t_custom_field_1" placeholder="Type 1" type="text" value="{{ old('t_custom_field_1') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_1">Exp Date 1</label>
                                            <input class="form-control datepicker" id="exp_custom_field_1" name="exp_custom_field_1" placeholder="DD-MM-YYYY" type="text" value="{{ old('exp_custom_field_1') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_2">Location 2</label>
                                            <input class="form-control" id="loc_custom_field_2" name="loc_custom_field_2" placeholder="Location 2" type="text" value="{{ old('loc_custom_field_2') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_2">Type 2</label>
                                            <input class="form-control" id="t_custom_field_2" name="t_custom_field_2" placeholder="Type 2" type="text" value="{{ old('t_custom_field_2') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_2">Exp Date 2</label>
                                            <input class="form-control datepicker" id="exp_custom_field_2" name="exp_custom_field_2" placeholder="DD-MM-YYYY" type="text" value="{{ old('exp_custom_field_2') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_3">Location 3</label>
                                            <input class="form-control" id="loc_custom_field_3" name="loc_custom_field_3" placeholder="Location 3" type="text" value="{{ old('loc_custom_field_3') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_3">Type 3</label>
                                            <input class="form-control" id="t_custom_field_3" name="t_custom_field_3" placeholder="Type 3" type="text" value="{{ old('t_custom_field_3') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_3">Exp Date 3</label>
                                            <input class="form-control datepicker" id="exp_custom_field_3" name="exp_custom_field_3" placeholder="DD-MM-YYYY" type="text" value="{{ old('exp_custom_field_3') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_4">Location 4</label>
                                            <input class="form-control" id="loc_custom_field_4" name="loc_custom_field_4" placeholder="Location 4" type="text" value="{{ old('loc_custom_field_4') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_4">Type 4</label>
                                            <input class="form-control" id="t_custom_field_4" name="t_custom_field_4" placeholder="Type 4" type="text" value="{{ old('t_custom_field_4') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_4">Exp Date 4</label>
                                            <input class="form-control datepicker" id="exp_custom_field_4" name="exp_custom_field_4" placeholder="DD-MM-YYYY" type="text" value="{{ old('exp_custom_field_4') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_plan">Service Plan</label>
                                            <select class="form-control" id="service_plan" name="service_plan" placeholder="Service Plan" value="{{ old('service_plan') }}">
                                                <option value="AI" {{ old('service_plan') == 'AI' ? 'selected' : '' }}> AI (All inclusive) </option>
                                                <option value="$77" {{ old('service_plan') == '$77' ? 'selected' : '' }}> $77 </option>
                                                <option value="$66" {{ old('service_plan') == '$66' ? 'selected' : '' }}> $66 </option>
                                                <option value="$55" {{ old('service_plan') == '$55' ? 'selected' : '' }}> $55 </option>
                                            </select>
                                        </div>
                                    </div>

                                    @if(Auth::user()->role == 'admin')
                                    <div class="col-md-6">
{{--                                         <div class="form-group">
                                            <label for="referral">Referral</label>
                                            <input class="form-control" id="referral" name="referral" placeholder="Referral" type="text" >
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="">Services</label>
                                             <select class="form-control js-example-basic-select2" multiple="multiple" id="services" name="services[]" onchange="toggleServiceDates();">
                                                <option value="Alarm" selected>Alarm</option>
                                                <option value="Heater">Heater</option>
                                                <option value="Solar Cleaning">Solar Cleaning</option>
                                             </select>
                                        </div>
                                    </div>
                                    @endif

                                </div>

                                @if(Auth::user()->role == 'admin')
                                <div class="row">
                                    <div class="col-md-4" id="alarm_date">
                                        <div class="form-group">
                                            <label for="last_alarm_service">Last Alarm Service Date<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control past-datepicker required" id="last_alarm_service" name="last_alarm_service" placeholder="DD-MM-YYYY" type="text" value="{{ old('last_alarm_service') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="heater_date" style="display: none;">
                                        <div class="form-group">
                                            <label for="last_heater_service">Last Heater Service Date<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control past-datepicker required" id="last_heater_service" name="last_heater_service" placeholder="DD-MM-YYYY" type="text" value="{{ old('last_heater_service') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="solar_cleaning_date" style="display: none;">
                                        <div class="form-group">
                                            <label for="last_solar_cleaning_service">Last Solar Cleaning Service Date<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control past-datepicker required" id="last_solar_cleaning_service" name="last_solar_cleaning_service" placeholder="DD-MM-YYYY" type="text" value="{{ old('last_solar_cleaning_service') }}">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <textarea class="form-control autoresizenone" id="comments" name="comments" placeholder="Comments" rows="3">{{ old('comments') }}</textarea>
                                </div>

                                <button type="submit" id="addJobButton" class="btn btn-primary pull-right m-5">Submit</button>
                                <a href="{{ route('job') }}" class="btn btn-danger pull-left m-5">Cancel</a>
                            </form>
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
        }else{
            $('#last_alarm_service').val(null);
            $('#alarm_date').hide();
        }

        if($.inArray("Heater",selectedValues) !== -1){
            $('#heater_date').show();
        }else{
            $('#last_heater_service').val(null);
            $('#heater_date').hide();
        }

        if($.inArray("Solar Cleaning",selectedValues) !== -1){
            $('#solar_cleaning_date').show();
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

$("#addJobButton").click(function(event){
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
    $("#addJobForm").submit();

});

</script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy'
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
@endpush