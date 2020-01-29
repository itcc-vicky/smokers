<?php

namespace App\Http\Controllers;
use App\AgencyJobChanges;
use App\AgencyJobs;
use App\Invoice;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request){
        if(Auth::user()->role == 'admin'){
            return view('job.adminhome');
        }
        if(Auth::user()->role == 'agency'){
            $ids = AgencyJobChanges::where('agency_id',Auth::Id())->pluck('job_id');
            $jobs = AgencyJobs::where('agency_id',Auth::Id())->WhereNotIn('id',$ids)->get();
            $clonedJobs = AgencyJobChanges::where('agency_id',Auth::Id())->get();
            // dd($jobs);
            // dd($clonedJobs);
            return view('job.userhome')->with('jobs', $jobs)->with('clonedJobs', $clonedJobs);
        }
    }
    public function postIndex(Request $request){
        $columns = $request->get('columns');
        $start = $request->get('start', 0);
        $length = $request->get('length', 50);

        if(Auth::user()->role == 'admin'){
            $ids = AgencyJobChanges::pluck('job_id');
            $jobs = AgencyJobs::WhereNotIn('id',$ids)->with('agency');
            $_total = $jobs->count();
            $value = $columns[17]['search']['value'] ?? '';
            if($value){
                $jobs = $jobs->where('status',$value);
            }
            // sorting
            if( $request->has('order') ) {
                $_sort_field_data = $request->get('order')[0];
                $_filed_name = $_sort_field_data['column'];
                $_sort_type = $_sort_field_data['dir'];
                $_filed_name_val = $columns[$_filed_name]['data'];
                $jobs->orderBy($_filed_name_val, $_sort_type);
            }else{
                $jobs->latest();
            }
            $globalSearch = array();
            $columnSearch = array();

            $bindings = array();

            if ( $request->has('search') && $request->get('search')['value'] != '' ) {
                $str = $request->get('search')['value'];

                for ( $i=0, $ien=count($columns); $i<$ien; $i++ ) {
                    if( $columns[$i]['data'] != 'id' && $columns[$i]['data'] != 'agency.name') {
                        $requestColumn = $columns[$i];
                        // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                        // $column = $columns[ $columnIdx ];

                        if ( $requestColumn['searchable'] == 'true' ) {
                            // $binding = self::bind( $bindings, '%'.$str.'%', \PDO::PARAM_STR );
                            $binding = "'%".$str."%'";
                            $globalSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                        }
                    }
                }
            }

            // Individual column filtering
            if ( isset( $request['columns'] ) ) {
                for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                    $requestColumn = $request['columns'][$i];
                    // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                    // $column = $columns[ $columnIdx ];

                    $str = $requestColumn['search']['value'];

                    if ( $requestColumn['searchable'] == 'true' &&
                     $str != '' ) {
                        // $binding = self::bind( $bindings, "%".$str."%", \PDO::PARAM_STR );
                        $binding = "'%".$str."%'";
                        $columnSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                    }
                }
            }

            // Combine the filters into a single string
            $where = '';

            if ( count( $globalSearch ) ) {
                $where = '('.implode(' OR ', $globalSearch).')';
            }

            if ( count( $columnSearch ) ) {
                $where = $where === '' ?
                    implode(' AND ', $columnSearch) :
                    $where .' AND '. implode(' AND ', $columnSearch);
            }

            if ( $where !== '' ) {
                // $where = 'WHERE '.$where;
                $jobs->whereRaw($where);
            }

            // dd($where);

            // if($request->has('search') && $request->get('search')['value'] != '') {
            //     $term = $request->get('search')['value'];
            //     foreach ($columns as $key => $value) {
            //         if( $value['data'] != 'id' && $value['data'] != 'agency.name') {
            //             $jobs->orWhere($value['data'], 'LIKE', "%".$term."%");
            //         }
            //     }
            //     // dd($columns);
            // }
            $data = array();
            $data['iTotalDisplayRecords']  = $jobs->count();
            $jobs = $jobs->skip($start)->take($length)->get();
            // $jobs = $jobs->skip($start)->take($length)->toSql();

            $data['code'] = 200;
            $data['jobs'] = $jobs;
            $data['iTotalRecords']  = $_total;
            // $data['sEcho']  = 10;

            return response()->json($data);

        }
        if(Auth::user()->role == 'agency'){
            $ids = AgencyJobChanges::where('agency_id',Auth::Id())->pluck('job_id');
            $jobs = AgencyJobs::where('agency_id',Auth::Id())->WhereNotIn('id',$ids)->get();
            $clonedJobs = AgencyJobChanges::where('agency_id',Auth::Id())->get();
            return view('job.userhome')->with('jobs', $jobs)->with('clonedJobs', $clonedJobs);
        }
    }

    public function getPending(Request $request){

        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }else{
            return view('job.pendinghome');
        }
    }
    public function postPendingIndex(Request $request){
        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }

        $columns = $request->get('columns');
        $start = $request->get('start', 0);
        $length = $request->get('length', 50);


        $jobs = AgencyJobChanges::with('agency','originalJob')->latest();
        $_total = $jobs->count();
        $value = $columns[17]['search']['value'] ?? '';
        if($value){
            $jobs = $jobs->where('status',$value);
        }
        // sorting
        if( $request->has('order') ) {
            $_sort_field_data = $request->get('order')[0];
            $_filed_name = $_sort_field_data['column'];
            $_sort_type = $_sort_field_data['dir'];
            $_filed_name_val = $columns[$_filed_name]['data'];
            $jobs->orderBy($_filed_name_val, $_sort_type);
        }
        $globalSearch = array();
        $columnSearch = array();

        $bindings = array();

        if ( $request->has('search') && $request->get('search')['value'] != '' ) {
            $str = $request->get('search')['value'];

            for ( $i=0, $ien=count($columns); $i<$ien; $i++ ) {
                if( $columns[$i]['data'] != 'id' && $columns[$i]['data'] != 'agency.name') {
                    $requestColumn = $columns[$i];
                    // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                    // $column = $columns[ $columnIdx ];

                    if ( $requestColumn['searchable'] == 'true' ) {
                        // $binding = self::bind( $bindings, '%'.$str.'%', \PDO::PARAM_STR );
                        $binding = "'%".$str."%'";
                        $globalSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                    }
                }
            }
        }

        // Individual column filtering
        if ( isset( $request['columns'] ) ) {
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                // $column = $columns[ $columnIdx ];

                $str = $requestColumn['search']['value'];

                if ( $requestColumn['searchable'] == 'true' &&
                 $str != '' ) {
                    // $binding = self::bind( $bindings, "%".$str."%", \PDO::PARAM_STR );
                    $binding = "'%".$str."%'";
                    $columnSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                }
            }
        }

        // Combine the filters into a single string
        $where = '';

        if ( count( $globalSearch ) ) {
            $where = '('.implode(' OR ', $globalSearch).')';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }

        if ( $where !== '' ) {
            // $where = 'WHERE '.$where;
            $jobs->whereRaw($where);
        }

        // dd($where);

        // if($request->has('search') && $request->get('search')['value'] != '') {
        //     $term = $request->get('search')['value'];
        //     foreach ($columns as $key => $value) {
        //         if( $value['data'] != 'id' && $value['data'] != 'agency.name') {
        //             $jobs->orWhere($value['data'], 'LIKE', "%".$term."%");
        //         }
        //     }
        //     // dd($columns);
        // }
        $data = array();
        $data['iTotalDisplayRecords']  = $jobs->count();
        $jobs = $jobs->skip($start)->take($length)->get();
        // $jobs = $jobs->skip($start)->take($length)->toSql();

        $data['code'] = 200;
        $data['jobs'] = $jobs;
        $data['iTotalRecords']  = $_total;
        // $data['sEcho']  = 10;

        return response()->json($data);
    }

    public function getDeleted(Request $request){

        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }else{
            return view('job.deletedhome');
        }
    }
    public function postDeletedIndex(Request $request){
        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }

        $columns = $request->get('columns');
        $start = $request->get('start', 0);
        $length = $request->get('length', 50);


        $jobs = AgencyJobs::onlyTrashed()->with('agency')->latest();
        $_total = $jobs->count();
        $value = $columns[17]['search']['value'] ?? '';
        if($value){
            $jobs = $jobs->where('status',$value);
        }
        // sorting
        if( $request->has('order') ) {
            $_sort_field_data = $request->get('order')[0];
            $_filed_name = $_sort_field_data['column'];
            $_sort_type = $_sort_field_data['dir'];
            $_filed_name_val = $columns[$_filed_name]['data'];
            $jobs->orderBy($_filed_name_val, $_sort_type);
        }
        $globalSearch = array();
        $columnSearch = array();

        $bindings = array();

        if ( $request->has('search') && $request->get('search')['value'] != '' ) {
            $str = $request->get('search')['value'];

            for ( $i=0, $ien=count($columns); $i<$ien; $i++ ) {
                if( $columns[$i]['data'] != 'id' && $columns[$i]['data'] != 'agency.name') {
                    $requestColumn = $columns[$i];
                    // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                    // $column = $columns[ $columnIdx ];

                    if ( $requestColumn['searchable'] == 'true' ) {
                        // $binding = self::bind( $bindings, '%'.$str.'%', \PDO::PARAM_STR );
                        $binding = "'%".$str."%'";
                        $globalSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                    }
                }
            }
        }

        // Individual column filtering
        if ( isset( $request['columns'] ) ) {
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                // $column = $columns[ $columnIdx ];

                $str = $requestColumn['search']['value'];

                if ( $requestColumn['searchable'] == 'true' &&
                 $str != '' ) {
                    // $binding = self::bind( $bindings, "%".$str."%", \PDO::PARAM_STR );
                    $binding = "'%".$str."%'";
                    $columnSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                }
            }
        }

        // Combine the filters into a single string
        $where = '';

        if ( count( $globalSearch ) ) {
            $where = '('.implode(' OR ', $globalSearch).')';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }

        if ( $where !== '' ) {
            // $where = 'WHERE '.$where;
            $jobs->whereRaw($where);
        }

        // dd($where);

        // if($request->has('search') && $request->get('search')['value'] != '') {
        //     $term = $request->get('search')['value'];
        //     foreach ($columns as $key => $value) {
        //         if( $value['data'] != 'id' && $value['data'] != 'agency.name') {
        //             $jobs->orWhere($value['data'], 'LIKE', "%".$term."%");
        //         }
        //     }
        //     // dd($columns);
        // }
        $data = array();
        $data['iTotalDisplayRecords']  = $jobs->count();
        $jobs = $jobs->skip($start)->take($length)->get();
        // $jobs = $jobs->skip($start)->take($length)->toSql();

        $data['code'] = 200;
        $data['jobs'] = $jobs;
        $data['iTotalRecords']  = $_total;
        // $data['sEcho']  = 10;

        return response()->json($data);
    }
    public function add(Request $request){

        return view('job.add');
    }

    public function edit($id){

        if(Auth::user()->role == 'admin'){
            $job = AgencyJobs::find($id);
        }
        if(Auth::user()->role == 'agency'){
            $job = AgencyJobChanges::where('job_id',$id)->first();
            if(!$job){
                $job = AgencyJobs::find($id);
            }
        }
        if(!$job){
            request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return back();
        }

        return view('job.edit')->with('job', $job);
    }

    public function preview($id){
        $job = AgencyJobs::find($id);
        $clonedJob = AgencyJobChanges::where('job_id',$id)->first();
        if(!$job || !$clonedJob){
            // request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return redirect('job');
        }
        if(Auth::user()->role == 'agency'){
            request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return redirect('job');
        }
        return view('job.preview')->with('job', $job)->with('clonedJob', $clonedJob);
    }

    public function postUpdate(Request $request){
        $request->validate([
            'agency_id' => 'required',
            'property_manager_name' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
        ],[
            'agency_id.required' => 'Agency is Required',
            'property_manager_name.required' => 'Property Manager Name is Required',
            'address_line_1.required' => 'No. is Required',
            'address_line_2.required' => 'Street is Required',
            'city.required' => 'Suburb is Required',
            'state.required' => 'State is Required',
            'postal_code.required' => 'Postal Code is Required',
            'country.required' => 'Country is Required',
        ]);


        if(Auth::user()->role == 'admin'){
            if($request->has('id')){
                $id = $request->has('id') ? $request->get('id') : null;
                $job = AgencyJobs::find($id);
            }else{
                $job = new AgencyJobs();
                $job->agency_id = $request->has('agency_id') ? $request->get('agency_id') : null;
            }
        }
        if(Auth::user()->role == 'agency'){
            if($request->has('id')){
                $id = $request->has('id') ? $request->get('id') : null;
                $job = AgencyJobs::find($id);
            }else{
                $job = new AgencyJobs();
                $job->agency_id = Auth::Id();
            }
        }


        $job->property_manager_name = $request->has('property_manager_name') ? $request->get('property_manager_name') : null;
        $job->landlord = $request->has('landlord') ? $request->get('landlord') : null;
        $job->landlord_email = $request->has('landlord_email') ? $request->get('landlord_email') : null;
        $job->landlord_contact = $request->has('landlord_contact') ? $request->get('landlord_contact') : null;
        $job->address_line_1 = $request->has('address_line_1') ? $request->get('address_line_1') : null;
        $job->address_line_2 = $request->has('address_line_2') ? $request->get('address_line_2') : null;
        $job->city = $request->has('city') ? $request->get('city') : null;
        $job->state = $request->has('state') ? $request->get('state') : null;
        $job->postal_code = $request->has('postal_code') ? $request->get('postal_code') : null;
        $job->key = $request->has('key') ? $request->get('key') : null;
        $job->country = $request->has('country') ? $request->get('country') : null;
        $job->location_area = $request->has('location_area') ? $request->get('location_area') : null;
        $job->service_month = $request->has('service_month') ? $request->get('service_month') : null;
        $job->tenant = $request->has('tenant') ? $request->get('tenant') : null;
        $job->contact_details = $request->has('contact_details') ? $request->get('contact_details') : null;
        $job->status = $request->has('status') ? $request->get('status') : null;
        $job->booked_date = $request->has('booked_date') && $request->get('booked_date') != null ? Carbon::parse($request->get('booked_date')) : null;
        $job->t_custom_field_1 = $request->has('t_custom_field_1') ? $request->get('t_custom_field_1') : null;
        $job->loc_custom_field_1 = $request->has('loc_custom_field_1') ? $request->get('loc_custom_field_1') : null;
        $job->exp_custom_field_1 = $request->has('exp_custom_field_1') && $request->get('exp_custom_field_1') != null ? Carbon::parse($request->get('exp_custom_field_1')) : null;
        $job->t_custom_field_2 = $request->has('t_custom_field_2') ? $request->get('t_custom_field_2') : null;
        $job->loc_custom_field_2 = $request->has('loc_custom_field_2') ? $request->get('loc_custom_field_2') : null;
        $job->exp_custom_field_2 = $request->has('exp_custom_field_2') && $request->get('exp_custom_field_2') != null ? Carbon::parse($request->get('exp_custom_field_2')) : null;
        $job->t_custom_field_3 = $request->has('t_custom_field_3') ? $request->get('t_custom_field_3') : null;
        $job->loc_custom_field_3 = $request->has('loc_custom_field_3') ? $request->get('loc_custom_field_3') : null;
        $job->exp_custom_field_3 = $request->has('exp_custom_field_3') && $request->get('exp_custom_field_3') != null ? Carbon::parse($request->get('exp_custom_field_3')) : null;
        $job->t_custom_field_4 = $request->has('t_custom_field_4') ? $request->get('t_custom_field_4') : null;
        $job->loc_custom_field_4 = $request->has('loc_custom_field_4') ? $request->get('loc_custom_field_4') : null;
        $job->exp_custom_field_4 = $request->has('exp_custom_field_4') && $request->get('exp_custom_field_4') != null ? Carbon::parse($request->get('exp_custom_field_4')) : null;
        $job->comments = $request->has('comments') ? $request->get('comments') : null;
        $job->service_plan = $request->has('service_plan') ? $request->get('service_plan') : null;
        // $job->referral = $request->has('referral') ? $request->get('referral') : null;
        $job->services = $request->has('services') ? implode(',',$request->get('services')) : $job->services;
        $job->last_alarm_service = $request->has('last_alarm_service') && $request->has('last_alarm_service') != null ? Carbon::parse($request->get('last_alarm_service')) : $job->last_alarm_service;
        $job->last_heater_service = $request->has('last_heater_service') && $request->has('last_heater_service') != null ? Carbon::parse($request->get('last_heater_service')) : $job->last_heater_service;
        $job->last_solar_cleaning_service = $request->has('last_solar_cleaning_service') && $request->has('last_solar_cleaning_service') != null ? Carbon::parse($request->get('last_solar_cleaning_service')) : $job->last_solar_cleaning_service;

        if(Auth::user()->role == 'agency'){

            if($request->has('id')){

                if($job->getDirty()){
                    $clonedJob = AgencyJobChanges::where('job_id', $job->id)->first();
                    if(!$clonedJob){
                        $clonedJob = new AgencyJobChanges();
                        $clonedJob->job_id = $job->id;
                    }
                    $clonedJob->agency_id = Auth::Id();
                    $clonedJob->property_manager_name = $job->property_manager_name;
                    $clonedJob->landlord = $job->landlord;
                    $clonedJob->landlord_email = $job->landlord_email;
                    $clonedJob->landlord_contact = $job->landlord_contact;
                    $clonedJob->address_line_1 = $job->address_line_1;
                    $clonedJob->address_line_2 = $job->address_line_2;
                    $clonedJob->city = $job->city;
                    $clonedJob->state = $job->state;
                    $clonedJob->postal_code = $job->postal_code;
                    $clonedJob->key = $job->key;
                    $clonedJob->country = $job->country;
                    $clonedJob->location_area = $job->location_area;
                    $clonedJob->service_month = $job->service_month;
                    $clonedJob->tenant = $job->tenant;
                    $clonedJob->contact_details = $job->contact_details;
                    $clonedJob->status = $job->status;
                    $clonedJob->booked_date = $job->booked_date;
                    $clonedJob->t_custom_field_1 = $job->t_custom_field_1;
                    $clonedJob->loc_custom_field_1 = $job->loc_custom_field_1;
                    $clonedJob->exp_custom_field_1 = $job->exp_custom_field_1;
                    $clonedJob->t_custom_field_2 = $job->t_custom_field_2;
                    $clonedJob->loc_custom_field_2 = $job->loc_custom_field_2;
                    $clonedJob->exp_custom_field_2 = $job->exp_custom_field_2;
                    $clonedJob->t_custom_field_3 = $job->t_custom_field_3;
                    $clonedJob->loc_custom_field_3 = $job->loc_custom_field_3;
                    $clonedJob->exp_custom_field_3 = $job->exp_custom_field_3;
                    $clonedJob->t_custom_field_4 = $job->t_custom_field_4;
                    $clonedJob->loc_custom_field_4 = $job->loc_custom_field_4;
                    $clonedJob->exp_custom_field_4 = $job->exp_custom_field_4;
                    $clonedJob->comments = $job->comments;
                    $clonedJob->service_plan = $job->service_plan;
                    $clonedJob->services = $job->services;
                    $clonedJob->last_alarm_service = $job->last_alarm_service;
                    $clonedJob->last_heater_service = $job->last_heater_service;
                    $clonedJob->last_solar_cleaning_service = $job->last_solar_cleaning_service;
                    $clonedJob->save();
                }
                request()->session()->flash('notify-success', 'Job Updated Successfully..!');
            }else{
                $job->save();
                request()->session()->flash('notify-success', 'Job Added Successfully..!');
            }
        }

        if(Auth::user()->role == 'admin'){
            $job->save();
            if($request->has('id')){
                request()->session()->flash('notify-success', 'Job Updated Successfully..!');
            }else{
                request()->session()->flash('notify-success', 'Job Added Successfully..!');
            }
        }

        if( $request->file('invoice_name') ) {
            foreach ($request->file('invoice_name') as $key => $_file) {
                // $filename = "INV".time().$_file->getClientOriginalName();
                $filename = "INV".time()."_".rand(1000, 9999).'.'.$_file->getClientOriginalExtension();
                $_file->move(base_path().'/public/invoices', $filename);
                $inv = new Invoice;
                $inv->job_id = $job->id;
                $inv->invoice_name = $filename;
                $inv->service_name = $request->get('service_name')[$key];
                $inv->save();
            }
        }

        return redirect('job');
    }

    public function postApprove($id){
        $job = AgencyJobs::find($id);
        $clonedJob = AgencyJobChanges::where('job_id', $id)->first();

        $job->property_manager_name = $clonedJob->property_manager_name;
        $job->landlord = $clonedJob->landlord;
        $job->landlord_email = $clonedJob->landlord_email;
        $job->landlord_contact = $clonedJob->landlord_contact;
        $job->address_line_1 = $clonedJob->address_line_1;
        $job->address_line_2 = $clonedJob->address_line_2;
        $job->city = $clonedJob->city;
        $job->state = $clonedJob->state;
        $job->postal_code = $clonedJob->postal_code;
        $job->key = $clonedJob->key;
        $job->country = $clonedJob->country;
        $job->location_area = $clonedJob->location_area;
        $job->service_month = $clonedJob->service_month;
        $job->tenant = $clonedJob->tenant;
        $job->contact_details = $clonedJob->contact_details;
        $job->status = $clonedJob->status;
        $job->booked_date = $clonedJob->booked_date;
        $job->t_custom_field_1 = $clonedJob->t_custom_field_1;
        $job->loc_custom_field_1 = $clonedJob->loc_custom_field_1;
        $job->exp_custom_field_1 = $clonedJob->exp_custom_field_1;
        $job->t_custom_field_2 = $clonedJob->t_custom_field_2;
        $job->loc_custom_field_2 = $clonedJob->loc_custom_field_2;
        $job->exp_custom_field_2 = $clonedJob->exp_custom_field_2;
        $job->t_custom_field_3 = $clonedJob->t_custom_field_3;
        $job->loc_custom_field_3 = $clonedJob->loc_custom_field_3;
        $job->exp_custom_field_3 = $clonedJob->exp_custom_field_3;
        $job->t_custom_field_4 = $clonedJob->t_custom_field_4;
        $job->loc_custom_field_4 = $clonedJob->loc_custom_field_4;
        $job->exp_custom_field_4 = $clonedJob->exp_custom_field_4;
        $job->comments = $clonedJob->comments;
        $job->service_plan = $clonedJob->service_plan;
        $job->services = $clonedJob->services;
        $job->last_alarm_service = $clonedJob->last_alarm_service;
        $job->last_heater_service = $clonedJob->last_heater_service;
        $job->last_solar_cleaning_service = $clonedJob->last_solar_cleaning_service;
        $job->save();
        $clonedJob->delete();
        request()->session()->flash('notify-success', 'Job Approved Successfully..!');
        return redirect('job');
    }

    public function postDecline($id){
        $clonedJob = AgencyJobChanges::where('job_id', $id)->first();
        $clonedJob->delete();
        request()->session()->flash('notify-success', 'Job Declined Successfully..!');
        return redirect('job');
    }
    public function postRestore($id){

        $response = array();
        $response['code'] = 400;
        $response['title'] = 'Job Not Found..!';
        $response['message'] = '';

        $job = AgencyJobs::withTrashed()->find($id);

        if($job){
            $agency = User::find($job->agency_id);
            if($agency){
                $job->restore();
                $response['code'] = 200;
                $response['title'] = 'Job Restored Successfully..!';
                $response['message'] = '';

            }else{
                $response['code'] = 400;
                $response['title'] = 'Job Restoring failed..!';
                $response['message'] = 'Job\'s Agency Does not exists, Unable to restore Job..!!';
            }
        }
        return response()->json($response);
    }


    public function postDelete(Request $request){
        $id = $request->has('id') ? $request->get('id') : null;
        $job = AgencyJobs::find($id);
        if(!$job){
            return back();
        }
        $job->delete();
        request()->session()->flash('notify-success', 'Job Deleted Successfully..!');

        return redirect('job');
    }

    public function changejobbulkstatus(Request $request) {
        if( $request->has('job_ids') ) {
            foreach ($request->get('job_ids') as $key => $value) {
                if(Auth::user()->role == 'agency'){
                    // first check in 'agency_job_changes' table
                    // if not found then clone from 'agency_jobs' to 'agency_job_changes'
                } else {
                    // change directly in 'agency_jobs' table
                    $job = AgencyJobs::find($value);
                    $job->status = NULL;
                    $job->save();
                }
            }
        }
        request()->session()->flash('notify-success', 'Job Status Updated Successfully..!');
        $response['code'] = 200;
        $response['title'] = 'Job Status Updated Successfully..!';
        $response['message'] = '';
        return response()->json($response);
    }


    public function cronUpdateBookingStatus()
    {
        $jobs = AgencyJobs::where('status','Booked In')->get();
        foreach ($jobs as $key => $job) {
            if($job->booked_date != null){
                $date = Carbon::parse($job->booked_date);
                if(!$date->isToday() && !$date->isFuture()){
                    $job->status = 'Overdue';
                    $job->save();
                }
            }
        }
    }
}

