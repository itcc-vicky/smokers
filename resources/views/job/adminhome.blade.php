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
                                    <td>
                                        <a href="{{ route('jobEdit', ['id' => $job->id]) }}" class="btn btn-primary btn_inline">View</a>
                                    </td>
                                    <td> {{ $job->agency->name }} </td>
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
                                    <td class="{{ $job->status == 'Compliant' ? 'bg-lightgreen' : '' }} {{ $job->status == 'Quoted' ? 'bg-lightorange' : '' }} {{ $job->status == 'Booked In' ? 'bg-lightblue' : '' }} {{ $job->status == 'Overdue' ? 'bg-lightred' : '' }} {{ $job->status == 'On Hold' ? 'bg-lightpurple' : '' }}"> {{ $job->status }} @if($job->status == 'Booked In')<br>{{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }} @endif </td>
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
                                    <td> {{ str_replace(',', ', ', $job->services) }} </td>
                                    <td> {{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }} </td>
                                    <td> {{ $job->last_heater_service != null ? \Carbon\Carbon::parse($job->last_heater_service)->format('d-m-Y') : '' }} </td>
                                    <td> {{ $job->last_solar_cleaning_service != null ? \Carbon\Carbon::parse($job->last_solar_cleaning_service)->format('d-m-Y') : '' }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
        <thead>
            <tr>
                <th>Record ID</th>
                <th>Order ID</th>
                <th>Country</th>
                <th>Ship City</th>
                <th>Company Agent</th>
                <th>Ship Date</th>
                <th>Status</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Record ID</th>
                <th>Order ID</th>
                <th>Country</th>
                <th>Ship City</th>
                <th>Company Agent</th>
                <th>Ship Date</th>
                <th>Status</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>

@endsection


@push('scripts')

<script>
@if( Auth::user()->role == 'admin' )
    window._table_targets = [ 2,3,4,5,10,12,13,16,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35 ];
@endif
</script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="{{ asset('dist/js/init-datatables.js') }}"></script>
<script>

var KTDatatablesSearchOptionsAdvancedSearch = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {
        // begin first table
        var table = $('#kt_table_1').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 50],

            pageLength: 1,

            searchDelay: 500,
            processing: false,
            serverSide: true,
            ajax: {
                url: '{{ route('job') }}',
                type: 'GET',
                dataSrc: 'jobs',
            },
            columns: [
                {data: 'id'},
                {data: 'OrderID'},
                {data: 'Country'},
                {data: 'ShipCity'},
                {data: 'CompanyAgent'},
                {data: 'ShipDate'},
                {data: 'Status'},
                {data: 'Type'},
                {data: 'Actions', responsivePriority: -1},
            ],

            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;

                    switch (column.title()) {
                        case 'Country':
                            column.data().unique().sort().each(function(d, j) {
                                $('.kt-input[data-col-index="2"]').append('<option value="' + d + '">' + d + '</option>');
                            });
                            break;

                        case 'Status':
                            var status = {
                                1: {'title': 'Pending', 'class': 'kt-badge--brand'},
                                2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
                                3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
                                4: {'title': 'Success', 'class': ' kt-badge--success'},
                                5: {'title': 'Info', 'class': ' kt-badge--info'},
                                6: {'title': 'Danger', 'class': ' kt-badge--danger'},
                                7: {'title': 'Warning', 'class': ' kt-badge--warning'},
                            };
                            column.data().unique().sort().each(function(d, j) {
                                $('.kt-input[data-col-index="6"]').append('<option value="' + d + '">' + status[d].title + '</option>');
                            });
                            break;

                        case 'Type':
                            var status = {
                                1: {'title': 'Online', 'state': 'danger'},
                                2: {'title': 'Retail', 'state': 'primary'},
                                3: {'title': 'Direct', 'state': 'success'},
                            };
                            column.data().unique().sort().each(function(d, j) {
                                $('.kt-input[data-col-index="7"]').append('<option value="' + d + '">' + status[d].title + '</option>');
                            });
                            break;
                    }
                });
            },

            columnDefs: [
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },
                {
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var status = {
                            1: {'title': 'Pending', 'class': 'kt-badge--brand'},
                            2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
                            3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
                            4: {'title': 'Success', 'class': ' kt-badge--success'},
                            5: {'title': 'Info', 'class': ' kt-badge--info'},
                            6: {'title': 'Danger', 'class': ' kt-badge--danger'},
                            7: {'title': 'Warning', 'class': ' kt-badge--warning'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
                    },
                },
                {
                    targets: 7,
                    render: function(data, type, full, meta) {
                        var status = {
                            1: {'title': 'Online', 'state': 'danger'},
                            2: {'title': 'Retail', 'state': 'primary'},
                            3: {'title': 'Direct', 'state': 'success'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
                            '<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
                    },
                },
            ],
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        var asdasd = function(value, index) {
            var val = $.fn.dataTable.util.escapeRegex(value);
            table.column(index).search(val ? val : '', false, true);
        };

        $('#kt_search').on('click', function(e) {
            e.preventDefault();
            var params = {};
            $('.kt-input').each(function() {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                }
                else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.kt-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            table.table().draw();
        });

    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesSearchOptionsAdvancedSearch.init();
});
</script>
@endpush
