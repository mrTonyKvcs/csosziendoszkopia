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
    return response()->json([$request->consultation_id]);
});
