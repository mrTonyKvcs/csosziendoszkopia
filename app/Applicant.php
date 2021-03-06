<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'comment', 'payment_id', 'payment_request_id', 'order_number'
    ];

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    public function appointments()
    {
        return $this->belongsTo(Appointment::class);
    }
}
