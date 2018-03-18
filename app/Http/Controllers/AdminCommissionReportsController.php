<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CommissionReport;
use App\Commission;
use Auth;
use Session;

class AdminCommissionReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminCommissionsController@index';
        $commission_reports = CommissionReport::paginate(5);
        // $commission_reports = CommissionReport::all();

        return view('admin.app.commission_report.index', compact('commission_reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commissions = Commission::pluck('name', 'id')->all();

        return view('admin.app.commission_report.create', compact('commissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'commission_id' => 'required|numeric',
            'report_date' => 'date'
        ]);

        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        $user_name = $user->name;

        if($file = $request->file('report')) {

            $allowed_file_types = config('app.allowed_file_types');

            $max_file_size = config('app.max_file_size');

            $rules = ['report.*' => 'required|mimes:' . $allowed_file_types . '|max:' . $max_file_size];

            $this->validate($request, $rules);        

            // $destination_path = config('app.files_destination_path') . '/commission_reports/' . $user_name;
            $destination_path = public_path() . '/commission_reports/';            

            $file_name = now()->format('Y-m-d-H-i-s') . '_' . $file->getClientOriginalName();            

            // $uploaded = Storage::put($destination_path.$file_name. '_' . $file->getClientOriginalExtension(), file_get_contents($file->getRealPath()));

            $uploaded = $file->move($destination_path, $file_name);

            // dd($uploaded);

            if($uploaded) {

                $input['report'] = $file_name;

                CommissionReport::create($input);

                Session::flash('created_commission_report', 'Commission report added');

                return redirect(route('admin.commission_reports.index'));

            }
        }
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'commission_id' => 'required|numeric',
            'date' => 'date'
        ]);

        CommissionReport::whereId($id)->update($request->all());

        return CommissionReport::whereId($id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);

        $deleted = CommissionReport::findOrFail($id)->delete();

        Session::flash('deleted_commission_report', 'Commission report id ' . $id . ' deleted');
        
        return redirect(route('admin.commission_reports.index'));
    }
}
