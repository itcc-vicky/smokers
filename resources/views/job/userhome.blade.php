@extends('layouts.app')

@push('styles')
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <style>
        table.dataTable tbody td {
            word-break: break-word !important;
            vertical-align: top;
        }
        table.dataTable tbody th, table.dataTable tbody td {
            padding: 8px 6px;
            font-size: 13px;
        }
        table.dataTable thead th, table.dataTable tfoot th {
            font-weight: 600;
            font-size: 13px;
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
                                    <th> Actions </th>
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
                                </tr>
                            </thead>
                            <tbody>
                                @isset($clonedJobs)
                                @foreach($clonedJobs as $job)
                                <tr>
                                    <td>
                                        <a href="{{ route('jobEdit', ['id' => $job->job_id]) }}" class="btn btn-primary btn_inline">View</a>
                                    </td>
                                    <td> {{ $job->property_manager_name }} </td>
                                    <td> {{ $job->landlord }} </td>
                                    <td> {{ $job->landlord_contact }} </td>
                                    <td> {{ $job->landlord_email }} </td>
                                    <td> {{ $job->address_line_1 }} </td>
                                    <td> {{ $job->address_line_2 }} </td>
                                    <td> {{ $job->city }} </td>
                                    <td> {{ $job->state }} </td>
                                    <td> {{ $job->postal_code }} </td>
                                    <td> {{ $job->key }} </td>
                                    <td> {{ $job->country }} </td>
                                    <td> {{ $job->location_area }} </td>
                                    <td class="{{ $job->service_month == 'NA' ? 'bg-danger' : '' }}" > {{ $job->service_month }} </td>
                                    <td> {{ $job->tenant }} </td>
                                    <td> {{ $job->contact_details }} </td>
                                    <td class="{{ $job->status == 'Compliant' ? 'bg-lightgreen' : '' }} {{ $job->status == 'Quoted' ? 'bg-lightorange' : '' }}"> {{ $job->status }} </td>
                                    <td> {{ $job->loc_custom_field_1 }} </td>
                                    <td> {{ $job->t_custom_field_1 }} </td>
                                    <td class="{{ $job->exp_custom_field_1 != '' && \Carbon\Carbon::parse($job->exp_custom_field_1)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : ''}} </td>
                                    <td> {{ $job->loc_custom_field_2 }} </td>
                                    <td> {{ $job->t_custom_field_2 }} </td>
                                    <td class="{{ $job->exp_custom_field_2 != '' && \Carbon\Carbon::parse($job->exp_custom_field_2)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d M Y') : ''}} </td>
                                    <td> {{ $job->loc_custom_field_3 }} </td>
                                    <td> {{ $job->t_custom_field_3 }} </td>
                                    <td class="{{ $job->exp_custom_field_3 != '' && \Carbon\Carbon::parse($job->exp_custom_field_3)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d M Y') : ''}} </td>
                                    <td> {{ $job->loc_custom_field_4 }} </td>
                                    <td> {{ $job->t_custom_field_4 }} </td>
                                    <td class="{{ $job->exp_custom_field_4 != '' && \Carbon\Carbon::parse($job->exp_custom_field_4)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d M Y') : ''}} </td>
                                    <td> {{ $job->comments }} </td>
                                    <td> {{ $job->service_plan }} </td>
                                </tr>
                                @endforeach
                                @endisset

                                @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        <a href="{{ route('jobEdit', ['id' => $job->id]) }}" class="btn btn-primary btn_inline">View</a>
                                    </td>
                                    <td> {{ $job->property_manager_name }} </td>
                                    <td> {{ $job->landlord }} </td>
                                    <td> {{ $job->landlord_contact }} </td>
                                    <td> {{ $job->landlord_email }} </td>
                                    <td> {{ $job->address_line_1 }} </td>
                                    <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->address_line_2}}">{{ Illuminate\Support\Str::limit($job->address_line_2, 20) }}</p> </td>
                                    <td> {{ $job->city }} </td>
                                    <td> {{ $job->state }} </td>
                                    <td> {{ $job->postal_code }} </td>
                                    <td> {{ $job->key }} </td>
                                    <td> {{ $job->country }} </td>
                                    <td> {{ $job->location_area }} </td>
                                    <td class="{{ $job->service_month == 'NA' ? 'bg-danger' : '' }}" > {{ $job->service_month }} </td>
                                    <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->tenant}}">{{ Illuminate\Support\Str::limit($job->tenant, 15) }} </p></td>
                                    <td> {{ $job->contact_details }} </td>
                                    <td class="{{ $job->status == 'Compliant' ? 'bg-lightgreen' : '' }} {{ $job->status == 'Quoted' ? 'bg-lightorange' : '' }}"> {{ $job->status }} </td>
                                    <td> {{ $job->loc_custom_field_1 }} </td>
                                    <td> {{ $job->t_custom_field_1 }} </td>
                                    <td class="{{ $job->exp_custom_field_1 != '' && \Carbon\Carbon::parse($job->exp_custom_field_1)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : '' }} </td>
                                    <td> {{ $job->loc_custom_field_2 }} </td>
                                    <td> {{ $job->t_custom_field_2 }} </td>
                                    <td class="{{ $job->exp_custom_field_2 != '' && \Carbon\Carbon::parse($job->exp_custom_field_2)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d M Y') : '' }} </td>
                                    <td> {{ $job->loc_custom_field_3 }} </td>
                                    <td> {{ $job->t_custom_field_3 }} </td>
                                    <td class="{{ $job->exp_custom_field_3 != '' && \Carbon\Carbon::parse($job->exp_custom_field_3)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d M Y') : '' }} </td>
                                    <td> {{ $job->loc_custom_field_4 }} </td>
                                    <td> {{ $job->t_custom_field_4 }} </td>
                                    <td class="{{ $job->exp_custom_field_4 != '' && \Carbon\Carbon::parse($job->exp_custom_field_4)->isPast() ? 'bg-danger' : ''}}"> {{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d M Y') : '' }} </td>
                                    <td> {{ $job->comments }} </td>
                                    <td> {{ $job->service_plan }} </td>
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
    window._table_targets = [ 1,2,3,4,9,11,12,15,17,18,19,20,21,22,23,24,25,26,27,28,29,30 ];
    // window._table_targets = [ 2,3,4,5,10,12,13,16,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35 ];
</script>

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="{{ asset('dist/js/init-datatables.js') }}"></script>

@endpush