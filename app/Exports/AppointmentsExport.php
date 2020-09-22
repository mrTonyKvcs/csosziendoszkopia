<?php

namespace App\Exports;

use App\Appointment;
use App\Consultation;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppointmentsExport implements FromCollection
{
    public function __construct($appointments)
    {
        $this->appointments = $appointments;
    }

    public function collection()
    {
        dd($this->appointments[0]);
    }
}
