<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Privilege;
use App\Province;
use App\District;
use App\Sector;
use App\Cell;
use App\Village;
use App\Diocese;
use App\Parish;
use App\Chapelle;
use App\Zone;
use App\Status;
use App\Photo;
use Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'AdminUsersController@index';
        $users = User::paginate(5);

        return view('admin.user.index', compact('users'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        $privileges = Privilege::pluck('name', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();
        $districts = District::pluck('name', 'id')->all();
        $sectors = Sector::pluck('name', 'id')->all();
        $cells = Cell::pluck('name', 'id')->all();
        $villages = Village::pluck('name', 'id')->all();
        $dioceses = Diocese::pluck('name', 'id')->all();
        $parishes = Parish::pluck('name', 'id')->all();
        $chapelles = Chapelle::pluck('name', 'id')->all();
        $zones = Zone::pluck('name', 'id')->all();
        $statuses = Status::pluck('name', 'id')->all();

        return view('admin.user.create', compact('roles', 'privileges', 'provinces', 'districts', 'sectors', 'cells', 'villages', 'dioceses', 'parishes', 'chapelles', 'zones', 'statuses'));        
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
            'role_id' => 'required|numeric',
            'privilege_id' => 'required|numeric',
            'name' => 'required|alpha_spaces',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'province_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'sector_id' => 'required|numeric',
            'cell_id' => 'required|numeric',
            'village_id' => 'required|numeric',
            'diocese_id' => 'required|numeric',
            'parish_id' => 'required|numeric',
            'chapelle_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'is_active' => 'required|boolean',
            'photo_id' => 'required'
        ]);       

        $input = $request->all();

        if($file = $request->file('photo_id'))
        {
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move('images/users', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);

        Session::flash('created_user', 'User created');

        return redirect (route('admin.users.index'));

        // Sector::create($request->all());

        // return redirect(route('admin.users.index'));        
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
        //
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

        $deleted = User::findOrFail($id)->delete();

        Session::flash('deleted_user', 'User id ' . $id . ' deleted');
        
        return redirect(route('admin.users.index'));
    }
}
