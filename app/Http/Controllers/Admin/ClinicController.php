<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;
use App\Repositories\Interfaces\ClinicRepositoryInterface;
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
        return view('dashboard.clinic.index',compact('clinics'));
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
        $data = $request->validated();
        $this->clinicRepository->store($data);
        toastr()->success('Clinic created successfully');
        }catch (\Exception $e) {
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
        $data = $request->validated();
        $this->clinicRepository->update($clinic, $data);
        toastr()->success('Clinic updated successfully');
        return back();
        } catch (\Exception $e) {
            toastr()->error('Failed to update clinic. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
    try {
    $this->clinicRepository->destroy($clinic);
    toastr()->success('Clinic deleted successfully');


    return back();
    } catch (\Exception $e) {
            toastr()->error('Failed to delete clinic. Please try again later.');
        }
    }
}
