<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\UpdatedAppointmentRequest;
use App\Models\Appointment;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use DB;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Appointments = Appointment::all();
        return view('dashboard.appointment.index', compact('Appointments'));
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
    public function store(AppointmentRequest $request)
    {


        try {
            DB::beginTransaction();
            $this->appointmentRepository->store($request->validated());
            toastr()->success('Appointment created successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to create appointment. Please try again later.');
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
    public function update(UpdatedAppointmentRequest $request, Appointment $appointment)
    {


        try {
            DB::beginTransaction();
            $this->appointmentRepository->update($appointment, $request->validated());
            toastr()->success('Appointment updated successfully');

            $this->appointmentRepository->updateStatus($appointment->userAppointment->id, Request()->status);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // toastr()->error($e->getMessage());
            throw $e;
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            DB::beginTransaction();
            $this->appointmentRepository->destroy($appointment);
            toastr()->success('Appointment deleted successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to create appointment. Please try again later.');
        }
        return back();
    }
}
