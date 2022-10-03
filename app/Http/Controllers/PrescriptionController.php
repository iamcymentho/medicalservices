<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {

        date_default_timezone_set('Africa/Lagos');  //setting default time zone for Africa
        $bookings =  Booking::where('date', date('Y-m-d'))->where('status', 1)->where('doctor_id', auth()->user()->id)->get();

        return view('prescription.index', compact('bookings'));
    }


    public function store(Request $request)
    {
        $data  = $request->all();
        // $data['medicine'] = implode(',', $request->medicine);

        Prescription::create($data);
        return redirect()->back()->with('message', 'Prescription created successfully');
    }

    //display doctors prescription for a certain patient
    public function show($userId, $date)
    {
        $prescription = Prescription::where('user_id', $userId)->where('date', $date)->first();
        return view('prescription.show', compact('prescription'));
    }

    //get all patients from prescription table
    public function patientsFromPrescription()
    {
        $patients = Prescription::get();
        return view('prescription.all', compact('patients'));
    }
}
