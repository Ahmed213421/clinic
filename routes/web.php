<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;

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
            'first_name' => $doctor->first_name,
            'specialization' => $doctor->specialization->name,

        ];
    });

    return response()->json($doctor);
});

Route::get('select/{clinicId}/appointment', function ($clinicId) {
    $clinic = Clinic::findOrFail($clinicId);

    $appointments = $clinic->appointments->map(function ($appointment) {
        $isBooked = \App\Models\UserAppointment::where('appointment_id', $appointment->id)
            ->where('user_id', auth()->id())
            ->exists();

        return [
            'id' => $appointment->id,
            'start_time' => $appointment->start_time,
            'end_time' => $appointment->end_time,
            'booked' => $isBooked,  
        ];
    });

    return response()->json($appointments);
});



require __DIR__.'/auth.php';
