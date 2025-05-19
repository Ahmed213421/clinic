<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinic\AppointmentRequest;
use App\Http\Requests\Clinic\UpdatedAppointmentRequest;
use App\Models\Appointment;
use App\Models\UserAppointment;
use App\Repositories\Interfaces\userInterface\UserAppointmentRepositoryInterface;
use DB;
use Exception;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $userAppointmemntRepository;

    public function __construct(UserAppointmentRepositoryInterface $userAppointmemntRepository)
    {
        $this->userAppointmemntRepository = $userAppointmemntRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Appointments = UserAppointment::where('user_id', auth()->user()->id)->latest()->get();

        return view('user.appointment.index', compact('Appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        try {

            DB::beginTransaction();

            $this->userAppointmemntRepository->store($request->validated());

            toastr()->success('user Appointment created successfully');

            DB::commit();
            return redirect()->route('user.appointment.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
    public function update(UpdatedAppointmentRequest $request, UserAppointment $appointment)
    {
        try {

            DB::beginTransaction();


            $this->userAppointmemntRepository->update($appointment, $request->validated());
            toastr()->success('user Appointment updated successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to updade appointment. Please try again later.');
            // toastr()->error($e->getMessage());
            // throw $e;
        }
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAppointment $appointment)
    {

        try {
            DB::beginTransaction();
            $this->userAppointmemntRepository->destroy($appointment);
            toastr()->success('Appointment deleted successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to delete clinic. Please try again later.');
        }
        return back();
    }
}
