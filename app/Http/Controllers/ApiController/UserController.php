<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest\UserCreateRequest;
use App\Http\Requests\ApiRequest\UserEditRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return successResponse(200, User::all(), 'User List');
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
            $user = User::create($data);
            DB::commit();
            return successResponse(201, $user, 'User has been created successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return errorResponse(500, null, 'System Error.');
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
        return successResponse(200, $user,'User details');
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
            return successResponse(200, $user, 'User has been updated successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return errorResponse(500, null, 'System Error.');
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
            return successResponse(200, null, 'User has been deleted successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return errorResponse(500, null, 'System Error.');
        }
    }
}
