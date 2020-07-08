<?php

use App\Consultation;
use App\MedicalExamination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/callback', 'Api\BarionController@callback');

//Get doctors
Route::post('/doctors', function(Request $request) {
    $doctors = MedicalExamination::find($request->id)->doctors;

    return $doctors;
    //return response($doctors);
});

//Get consultations
Route::post('/consultations', function(Request $request) {
    $consultations = Consultation::where('user_id', $request->id)
        ->active()
        ->get();

    $examination = \DB::table('doctor_medical_examination')
            ->where('user_id', $request->id)
            ->where('medical_examination_id', $request->examination)
            ->first();

    return response()->json([
        'days' => $consultations,
        'info' => $examination
    ]);
});

//Get appointments
Route::post('/appointments', function(Request $request) {

    $consultation = \App\Consultation::find($request->consultation_id);

    $starttime = $consultation->open;  // your start time
    $endtime = $consultation->close;  // End time
    $duration = $request->minutes;  // split by 30 mins

    $array_of_time = array ();
    $start_time    = strtotime ($starttime); //change to strtotime
    $end_time      = strtotime ($endtime); //change to strtotime

    $add_mins  = $duration * 60;

    while ($start_time <= $end_time) // loop between time
    {
       $array_of_time[] = date ("H:i", $start_time);
       $start_time += $add_mins; // to check endtie=me
    }

    $new_array_of_time = array ();
    for($i = 0; $i < count($array_of_time) - 1; $i++)
    {
        $new_array_of_time[] = ['start_at' => $array_of_time[$i], 'end_at' => $array_of_time[$i + 1]];
    }

    if ($consultation->appointments->isEmpty()) {
        $appointments = $new_array_of_time;
    } else {

        foreach($new_array_of_time as $key => $time) {
            foreach($consultation->appointments as $appointment) {

                if (($time['start_at'] <= $appointment['end_at']) && ($time['end_at'] >= $appointment['start_at'])) {
                    \Arr::pull($new_array_of_time, $key);
                }

            }
        }

        $appointments = $new_array_of_time;
    }

    return response($appointments);
});
