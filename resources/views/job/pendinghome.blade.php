@extends('layouts.app')
@push('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <style>
        table.dataTable tbody td {word-break: break-word !important;vertical-align: top;}
        .i-checks { margin:0; }
        .i-checks > i { width: 15px !important; height: 15px !important;margin-right: 10px !important;}
        .btn_inline { padding: 2px 10px !important; }
        .table { width: 100% !important; }
        .label { color: #626262;}
        div.ColVis { margin: 0 10px;}
        button.ColVis_Button.ColVis_MasterButton { background: #4aa9e9 !important; color: #FFF !important; border-color: #4aa9e9 !important; }
        .buttons-print { background: #62549a !important; color: #FFF !important; border-color: #62549a !important; }
        table.dataTable tbody td { word-break: break-word !important; vertical-align: top; }
        table.dataTable tbody th, table.dataTable tbody td { padding: 4px 7px; font-size: 13px; }
        table.dataTable thead th, table.dataTable tfoot th { font-weight: 600; font-size: 13px; }
        .panel-body { padding: 15px 5px; }
        .dt-buttons { float: right; }
        .dt-buttons button { outline: none; background: #f3f3f3; border-color: #ddd; border: 1px solid #999; color: black; border-radius: 2px; height: 30px; padding: 3px 8px; }
        .dataTables_wrapper .dataTables_info { padding-top: 10px !important; }
        .text-success {
            color: #ff6c60 !important;
        }
        .text-danger {
            color: #23b9a9 !important;
        }
    </style>
@endpush


@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title">
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
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
                </header>
                <div class="panel-body">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
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
                    </table>
                </div>
            </section>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    window._table_targets = [ 2,3,4,5,10,12,13,16,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35 ];
</script>


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
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
            dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'BCf>>
            <'row'<'col-sm-12't>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html
            buttons: [ 'print' ],
            language: {
                'lengthMenu': 'Display _MENU_',
            },
            lengthMenu: [5, 10, 25, 50],

            pageLength: 50,
            bServerSide:true,

            searchDelay: 1000,
            processing: false,
            aaSorting: [],
            serverSide: true,
            cache:false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('postPendingIndex') }}',
                type: 'POST',
                dataSrc: 'jobs',
            },
            columns: [
                {data: 'id'},
                {data: 'agency.name'},
                {data: 'property_manager_name'},
                {data: 'landlord'},
                {data: 'landlord_contact'},
                {data: 'landlord_email'},
                {data: 'address_line_1'},
                {data: 'address_line_2'},
                {data: 'city'},
                {data: 'state'},
                {data: 'postal_code'},
                {data: 'key'},
                {data: 'country'},
                {data: 'location_area'},
                {data: 'service_month'},
                {data: 'tenant'},
                {data: 'contact_details'},
                {data: 'status'},
                {data: 'loc_custom_field_1'},
                {data: 't_custom_field_1'},
                {data: 'exp_custom_field_1'},
                {data: 'loc_custom_field_2'},
                {data: 't_custom_field_2'},
                {data: 'exp_custom_field_2'},
                {data: 'loc_custom_field_3'},
                {data: 't_custom_field_3'},
                {data: 'exp_custom_field_3'},
                {data: 'loc_custom_field_4'},
                {data: 't_custom_field_4'},
                {data: 'exp_custom_field_4'},
                {data: 'comments'},
                {data: 'service_plan'},
                {data: 'services'},
                {data: 'last_alarm_service'},
                {data: 'last_heater_service'},
                {data: 'last_solar_cleaning_service'},
            ],

            columnDefs: [
                {
                    targets: window._table_targets,
                    visible: false,
                },
                {
                    targets: 0,
                    title: 'Actions',
                    orderable: false,
                    sortable: false,
                    selector: false,
                    render: function(data, type, full, meta) {
                        return `<a href="preview/`+full.job_id+`" class="btn btn-primary btn_inline">View</a>`;
                    },
                },
                {
                    targets:17,
                    render: function(data, type, full, meta) {
                        var status = {
                            'Compliant' : {'title': 'Compliant', 'class': 'bg-lightgreen'},
                            'Quoted' : {'title': 'Quoted', 'class': ' bg-lightorange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' bg-lightblue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' bg-lightred'},
                            'On Hold' : {'title': 'On Hold', 'class': ' bg-lightpurple'}
                        };
                        // console.log(data);
                        // console.log(full.original_job.status);
                        if (data == null && full.original_job.status == null) {
                            return ''
                        }
                        if (data == null) {
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status].title+'<del></p><p class="text-success m-0"></p>';
                        }
                        if (full.original_job.status == null) {
                            return '<p class="text-danger m-0"><del><del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                        if(data == full.original_job.status){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets:2,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.property_manager_name){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.property_manager_name+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:3,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.landlord){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.landlord+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:4,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.landlord_contact){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.landlord_contact+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:5,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.landlord_email){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.landlord_email+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:6,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.address_line_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.address_line_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:7,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.address_line_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.address_line_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:8,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.city){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.city+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:9,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.state){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.state+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:10,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.postal_code){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.postal_code+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:11,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.key){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.key+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:12,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.country){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.country+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:13,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.location_area){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.location_area+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:14,
                    render: function(data, type, full, meta) {
                        var status = {
                            'NA' : {'title': 'NA', 'class': 'bg-danger'},
                            'January' : {'title': 'January', 'class': ''},
                            'February' : {'title': 'February', 'class': ''},
                            'March' : {'title': 'March', 'class': ''},
                            'April' : {'title': 'April', 'class': ''},
                            'May' : {'title': 'May', 'class': ''},
                            'June' : {'title': 'June', 'class': ''},
                            'July' : {'title': 'July', 'class': ''},
                            'August' : {'title': 'August', 'class': ''},
                            'September' : {'title': 'September', 'class': ''},
                            'October' : {'title': 'October', 'class': ''},
                            'November' : {'title': 'November', 'class': ''},
                            'December' : {'title': 'December', 'class': ''},
                        };
                        if(data == full.original_job.service_month){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.service_month].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets:15,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.tenant){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.tenant+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:16,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.contact_details){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.contact_details+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:18,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:19,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:20,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:21,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:22,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:23,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:24,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:25,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:26,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:27,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_4){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_4+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:28,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_4){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_4+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:29,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_4){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_4+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:30,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.comments){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.comments+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:31,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.service_plan){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.service_plan+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:32,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.services){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.services+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:33,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.last_alarm_service){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.last_alarm_service+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:34,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.last_heater_service){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.last_heater_service+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets:35,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.last_solar_cleaning_service){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.last_solar_cleaning_service+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
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

        $('.kt_search').on('click', function(e) {
            e.preventDefault();
            let status = $(this).attr('value');
            table.column(17).search(status, false, false);
            table.table().draw();

        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            table.column(17).search('', false, false);
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
