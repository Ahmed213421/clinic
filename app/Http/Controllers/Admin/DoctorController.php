<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Admin;
use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use DB;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class DoctorController extends Controller
{
    protected $doctorRepository;

    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Admin::role('doctor')->get();

        return view('dashboard.doctor.index', compact('doctors'));
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
    public function store(DoctorRequest $request)
    {

        try {
            DB::beginTransaction();
            $this->doctorRepository->store($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            // toastr()->error($e->getMessage());
            // toastr()->error('Failed to create doctor. Please try again later.');
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
    public function update(UpdateDoctorRequest $request, $id)
    {

        try {
            DB::beginTransaction();
            $this->doctorRepository->update($id, $request->validated());
            toastr()->success('doctor updated successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            // toastr()->error('Failed to create doctor. Please try again later.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->doctorRepository->destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            // toastr()->error('Failed to create doctor. Please try again later.');
        }
        return back();
    }
}
