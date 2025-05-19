<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/user')->middleware('auth')->name('user.')->group(function(){
    Route::get('/', function () {
        return view('user.index');
    })->name('home');

    Route::resource('appointment',AppointmentController::class);
});

Route::get('select/{clinicId}/doctors', function ($clinicid) {
    $clinic = Clinic::findOrFail($clinicid);

    if ($clinic->doctors->isEmpty()) {
        return response()->json(['message' => 'No doctors found for this clinic'], 404);
    }

    $doctor = $clinic->doctors->map(function ($doctor) {
        return [
            'id' => $doctor->id,
            'name' => $doctor->name,
            'specialization' => $doctor->specialization?->name,
        ];
    });

    return response()->json($doctor);
});


Route::get('/select/{clinic}/doctor/{doctor}/appointments', function (Request $request, $clinicId, $doctorId) {
    $clinic = Clinic::findOrFail($clinicId);

    $doctor = $clinic->doctors()
        ->role('doctor')
        ->where('admins.id', $doctorId)
        ->first();

    if (! $doctor) {
        return response()->json([], 403);
    }

    $currentAppointmentId = $request->query('current_appointment_id');

    // Get unbooked appointments only
    $appointments = $doctor->appointments()
        ->where('clinic_id', $clinicId)
        ->where('booked',false)
        ->where('start_time', '>=', now())
        ->where('end_time', '>', now())
        ->get(['id', 'start_time', 'end_time']);

    // Include the current (booked) appointment if not already in the list
    if ($currentAppointmentId) {
        $alreadyIncluded = $appointments->pluck('id')->contains($currentAppointmentId);

        if (! $alreadyIncluded) {
            $extra = $doctor->appointments()
                ->where('clinic_id', $clinicId)
                ->where('id', $currentAppointmentId)
                ->get(['id', 'start_time', 'end_time']);

            $appointments = $appointments->merge($extra);
        }
    }

    return response()->json($appointments);
});




require __DIR__.'/auth.php';
