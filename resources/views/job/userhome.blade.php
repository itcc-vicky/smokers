@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
@endpush


@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title">
                @if(request()->route()->getName() == 'job') Job Lists @endif
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                @if(request()->route()->getName() == 'jobDeleted') Deleted Jobs @endif

                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">
                @if(request()->route()->getName() == 'job') Job Lists @endif
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
                    <button class="btn btn-default btn-sm text-center font-bold" id="kt_reset">
                        <span>
                            <i class="la la-search"></i>
                            <span>Show All</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-green btn-sm kt_search text-center font-bold" value="Compliant">
                        <span>
                            <i class="la la-search"></i>
                            <span>Compliant</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-orange btn-sm kt_search text-center font-bold" value="Quoted">
                        <span>
                            <i class="la la-search"></i>
                            <span>Quoted</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-blue btn-sm kt_search text-center font-bold" value="Booked In">
                        <span>
                            <i class="la la-search"></i>
                            <span>Booked In</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-red btn-sm kt_search text-center font-bold" value="Overdue">
                        <span>
                            <i class="la la-search"></i>
                            <span>Overdue</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-purple btn-sm kt_search text-center font-bold" value="On Hold">
                        <span>
                            <i class="la la-search"></i>
                            <span>On Hold</span>
                        </span>
                    </button>
                    <span class="pull-right">
                        @if(request()->route()->getName() == 'job')
                        <a href="{{ route('jobAdd') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New Job</a>
                        @endif
                    </span>
                </header>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="table table-responsive">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <table class="table colvis-responsive-data-table table-striped dataTable table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
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
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($clonedJobs)
                        @foreach($clonedJobs as $job)
                        <tr>
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
                            <td class="{{ $job->service_month == 'NA' ? 'bg-red' : '' }}">{{ $job->service_month }}</td>
                            <td> {{ $job->tenant }} </td>
                            <td> {{ $job->contact_details }} </td>
                            <td class="text-center font-bold {{ $job->status == 'Compliant' ? 'bg-green' : '' }} {{ $job->status == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status == 'Overdue' ? 'bg-red' : '' }} {{ $job->status == 'On Hold' ? 'bg-purple' : '' }}">{{ $job->status }}</span> @if($job->status == 'Booked In')<br>{{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }}@endif </td>
                            <td> {{ $job->loc_custom_field_1 }} </td>
                            <td> {{ $job->t_custom_field_1 }} </td>
                            <td class="{{ $job->exp_custom_field_1 != '' && \Carbon\Carbon::parse($job->exp_custom_field_1)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : ''}} </td>
                            <td> {{ $job->loc_custom_field_2 }} </td>
                            <td> {{ $job->t_custom_field_2 }} </td>
                            <td class="{{ $job->exp_custom_field_2 != '' && \Carbon\Carbon::parse($job->exp_custom_field_2)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d M Y') : ''}} </td>
                            <td> {{ $job->loc_custom_field_3 }} </td>
                            <td> {{ $job->t_custom_field_3 }} </td>
                            <td class="{{ $job->exp_custom_field_3 != '' && \Carbon\Carbon::parse($job->exp_custom_field_3)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d M Y') : ''}} </td>
                            <td> {{ $job->loc_custom_field_4 }} </td>
                            <td> {{ $job->t_custom_field_4 }} </td>
                            <td class="{{ $job->exp_custom_field_4 != '' && \Carbon\Carbon::parse($job->exp_custom_field_4)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d M Y') : ''}} </td>
                            <td> {{ $job->comments }} </td>
                            <td> {{ $job->service_plan }} </td>
                            <td>
                                <a href="{{ route('jobEdit', ['id' => $job->job_id]) }}" class="btn btn-primary btn_inline">View</a>
                            </td>
                        </tr>
                        @endforeach
                        @endisset

                        @foreach($jobs as $job)
                        <tr>
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
                            <td class="{{ $job->service_month == 'NA' ? 'bg-red' : '' }}">{{ $job->service_month }}</td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->tenant}}">{{ Illuminate\Support\Str::limit($job->tenant, 15) }} </p></td>
                            <td> {{ $job->contact_details }} </td>
                            <td class="text-center font-bold {{ $job->status == 'Compliant' ? 'bg-green' : '' }} {{ $job->status == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status == 'Overdue' ? 'bg-red' : '' }} {{ $job->status == 'On Hold' ? 'bg-purple' : '' }}">{{ $job->status }}</span> @if($job->status == 'Booked In')<br>{{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }}@endif </td>
                            <td> {{ $job->loc_custom_field_1 }} </td>
                            <td> {{ $job->t_custom_field_1 }} </td>
                            <td class="{{ $job->exp_custom_field_1 != '' && \Carbon\Carbon::parse($job->exp_custom_field_1)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_1 != null ? \Carbon\Carbon::parse($job->exp_custom_field_1)->format('d M Y') : '' }} </td>
                            <td> {{ $job->loc_custom_field_2 }} </td>
                            <td> {{ $job->t_custom_field_2 }} </td>
                            <td class="{{ $job->exp_custom_field_2 != '' && \Carbon\Carbon::parse($job->exp_custom_field_2)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_2 != null ? \Carbon\Carbon::parse($job->exp_custom_field_2)->format('d M Y') : '' }} </td>
                            <td> {{ $job->loc_custom_field_3 }} </td>
                            <td> {{ $job->t_custom_field_3 }} </td>
                            <td class="{{ $job->exp_custom_field_3 != '' && \Carbon\Carbon::parse($job->exp_custom_field_3)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_3 != null ? \Carbon\Carbon::parse($job->exp_custom_field_3)->format('d M Y') : '' }} </td>
                            <td> {{ $job->loc_custom_field_4 }} </td>
                            <td> {{ $job->t_custom_field_4 }} </td>
                            <td class="{{ $job->exp_custom_field_4 != '' && \Carbon\Carbon::parse($job->exp_custom_field_4)->isPast() ? 'bg-red' : ''}}"> {{ $job->exp_custom_field_4 != null ? \Carbon\Carbon::parse($job->exp_custom_field_4)->format('d M Y') : '' }} </td>
                            <td> {{ $job->comments }} </td>
                            <td> {{ $job->service_plan }} </td>
                            <td>
                                <a href="{{ route('jobEdit', ['id' => $job->id]) }}" class="btn btn-primary btn_inline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    window._table_targets = [ 0,1,2,3,8,10,11,14,16,17,18,19,20,21,22,23,24,25,26,27,28,29 ];
</script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
{{-- <script src="{{ asset('dist/js/init-datatables.js') }}"></script> --}}
<script>

var KTDatatablesSearchOptionsAdvancedSearch = function() {

    var initTable1 = function() {
        // begin first table
        var table = $('#kt_table_1').DataTable({
            responsive: false,
            // Pagination settings
            dom: `<<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'BCf>>
            <<'col-sm-12't>>
            <<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html
            buttons: [
                {
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }
            ],
            language: {
                'lengthMenu': 'Display _MENU_',
            },
            lengthMenu: [5, 10, 50, 100],
            pageLength: 50,
            bServerSide:false,
            searchDelay: 1000,
            processing: false,
            aaSorting: [],
            serverSide: false,
            cache:false,
            columnDefs: [{
                targets: window._table_targets,
                visible: false,
            },{
                    targets: 30,
                    orderable: false,
                    sortable: false,
                    selector: false,
                    width:'4%',
            }],
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        var asdasd = function(value, index) {
            var val = $.fn.dataTable.util.escapeRegex(value);
            table.column(index).search(val ? val : '', false, true);
        };

        $('.kt_search').on('click', function(e) {
            e.preventDefault();
            let status = $(this).attr('value');
            console.log(table.column(15));
            table.column(15).search(status, false, false);
            table.table().draw();

        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            table.column(15).search('', false, false);
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
