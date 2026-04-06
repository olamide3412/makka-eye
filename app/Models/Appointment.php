<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'dob',
        'appointment_date',
        'appointment_time',
        'service_needed',
        'is_existing_patient',
        'file_number',
        'tracking_number',
        'status',
        'notes',
    ];
}
