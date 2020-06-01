<?php

namespace TesteBussola;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'title',
        'serie',
        'course'
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course', 'id');
    }

}
