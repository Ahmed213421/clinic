<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;
use App\Repositories\Interfaces\ClinicRepositoryInterface;
use DB;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    protected $clinicRepository;

    public function __construct(ClinicRepositoryInterface $clinicRepository)
    {
        $this->clinicRepository = $clinicRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = Clinic::latest()->get();
        return view('dashboard.clinic.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->clinicRepository->store($request->validated());
            toastr()->success('Clinic created successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // toastr()->error($e);
            toastr()->error('Failed to create clinic. Please try again later.');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClinicRequest $request, Clinic $clinic)
    {

        try {
            DB::beginTransaction();
            $data = $request->validated();
            $this->clinicRepository->update($clinic, $data);
            toastr()->success('Clinic updated successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            // toastr()->error('Failed to update clinic. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
        try {
            DB::beginTransaction();
            $this->clinicRepository->destroy($clinic);
            toastr()->success('Clinic deleted successfully');


        } catch (\Exception $e) {
            toastr()->error('Failed to delete clinic. Please try again later.');
        }
        return back();
    }
}
