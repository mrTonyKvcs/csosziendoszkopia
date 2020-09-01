<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalExamination extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'name', 'is_active'];

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_medical_examination')->withPivot('minutes', 'price');
    }

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1);
    }
}
