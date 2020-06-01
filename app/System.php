<?php

namespace TesteBussola;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use TesteBussola\Support\Cropper;

class System extends Model
{
    protected $fillable = [
        'title',
        'logo',
        'favico'
    ];


    public function getUrlLogoAttribute()
    {
        if (!empty($this->logo)){
            return Storage::url(Cropper::thumb($this->logo, 300, 300));
        }
        return '';
    }

    public function getUrlFavicoAttribute()
    {
        if (!empty($this->favico)){
            return Storage::url(Cropper::thumb($this->favico, 100, 100));
        }
        return '';
    }

}
