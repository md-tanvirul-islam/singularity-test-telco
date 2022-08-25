<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebRequest\OutletCreateRequest;
use App\Http\Requests\WebRequest\OutletEditRequest;
use App\Models\Outlet;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OutletController extends Controller
{
    const IMAGE_LOCATION = "outlets/image/";

    public function __construct()
    {
        $this->authorizeResource(Outlet::class, 'outlet');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::paginate(10);
        return view('outlets.index', compact('outlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutletCreateRequest $request)
    {
        $data = $request->except(['image']);
        if($request->image){
            $data['image'] = uploadFile($request->image, self::IMAGE_LOCATION);
        }
        DB::beginTransaction();
        try {
            Outlet::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Outlet has been created successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            if(Storage::disk('public')->exists($data['image'])){
                deleteFile($data['image']);
            }
            Log::error("$e");
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        return view('outlets.show', compact('outlet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return view('outlets.edit', compact('outlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(OutletEditRequest $request, Outlet $outlet)
    {
        $data = $request->except(['image']);
        if($request->image){
            $data['image'] = uploadFile($request->image, self::IMAGE_LOCATION);
            deleteFile($outlet->image);
        }
        DB::beginTransaction();
        try {
            $outlet->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Outlet has been updated successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            if(Storage::disk('public')->exists($data['image'])){
                deleteFile($data['image']);
            }
            Log::error("$e");
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        DB::beginTransaction();
        try {
            $outlet->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Outlet has been deleted successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return abort(500);
        }
    }

    public function maps(){
        $coordinates = Outlet::get(['latitude', 'longitude'])->toArray();
        return view('outlets.maps', compact('coordinates'));
    }
}
