<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository){
        $this->appointmentRepository = $appointmentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Appointments = Appointment::all();
        return view('dashboard.appointment.index',compact('Appointments'));
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
            $this->appointmentRepository->store($request->validated());
            toastr()->success('Appointment created successfully');
        } catch (\Exception $e) {
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
