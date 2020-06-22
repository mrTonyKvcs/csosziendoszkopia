<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalExamination extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'name'];

    public function doctors()
    {
        return $this->belongsToMany(User::class);
    }
}
