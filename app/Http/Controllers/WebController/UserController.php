<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebRequest\UserCreateRequest;
use App\Http\Requests\WebRequest\UserEditRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->except(['password', 'password_confirmation']);
        $data['password'] = Hash::make($request->password);
        DB::beginTransaction();
        try {
            User::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'User has been created successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        $data = $request->except(['password', 'password_confirmation']);
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        DB::beginTransaction();
        try {
            $user->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'User has been updated successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->back()->with('success', 'User has been deleted successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return abort(500);
        }
    }
}
