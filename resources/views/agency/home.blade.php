@extends('layouts.app')

@push('styles')
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
@endpush


@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title"> Agencies
                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="#" class="active">Agencies</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading panel-border">
                    &nbsp;
                    <span class="new_button pull-right">
                        <a href="{{ route('agencyAdd') }}" class="btn btn-info "><i class="fa fa-plus"></i> Add New Agency</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="table table-responsive">
                    <table class="table responsive-data-table table-striped">
                        <thead>
                        <tr>
                            <th> Actions </th>
                            <th> Agency Name </th>
                            <th> Property Manager Name </th>
                            <th> Email </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agencies as $agency)
                        <tr>
                            <td>
                                <a href="{{ route('agencyEdit', ['id' => $agency->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary btn_inline_mobile"><i class="fa fa-pencil"></i></a>
                                <button onclick="openDeleteDialog('#deleteAgency{{$agency->id}}');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger btn_inline_mobile"><i class="fa fa-trash"></i></button>
                            </td>
                            <td> {{ $agency->name }} </td>
                            <td> {{ $agency->property_manager_name }} </td>
                            <td> {{ $agency->email }} </td>
                            <form id="deleteAgency{{$agency->id}}" action="{{ route('agencyPostDelete') }}" method="POST">
                                <input type="hidden" name="id" value="{{$agency->id}}">
                                @method('DELETE')
                                @csrf
                            </form>
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

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('dist/js/init-datatables.js') }}"></script>

<script>
function openDeleteDialog(formId){
    Swal.fire({
        title: 'Are you sure?',
        html : "All Jobs associated with agency will be deleted..!<br>You won't be able to revert this!",
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
