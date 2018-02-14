<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    public $locationTypes = [
        'ca'  => 'Cagar Alam',
        'sm'  => 'Suaka Margasatwa',
        'tn'  => 'Taman Nasional',
        'thr' => 'Taman Hutan Raya',
        'twa' => 'Taman Wisata Alam'
    ];

    protected $fillable = [
        'type', 'name', 'description', 'location', 'lat', 'lng', 'boundaries', 'area', 'flora', 'fauna', 'contacts', 'data_sources', 'created_by'
    ];

    protected $casts = [
        'contacts' => 'array',
        'data_sources' => 'array'
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->locationTypes[$this->type].' '.$this->name;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
