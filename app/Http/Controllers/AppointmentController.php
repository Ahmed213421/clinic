<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinic\AppointmentRequest;
use App\Models\Appointment;
use App\Models\UserAppointment;
use App\Repositories\Interfaces\userInterface\UserAppointmentRepositoryInterface;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $userAppointmemntRepository;

    public function __construct(UserAppointmentRepositoryInterface $userAppointmemntRepository) {
        $this->userAppointmemntRepository = $userAppointmemntRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Appointments = UserAppointment::where('user_id',auth()->user()->id)->latest()->get();
        return view('user.appointment.index',compact('Appointments'));
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
        $this->userAppointmemntRepository->store($request->validated());

        return redirect()->route('user.appointment.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
