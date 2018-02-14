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

    public function setContactsAttribute($value)
    {
        $this->attributes['contacts'] = is_array($value) ? json_decode($value, true) : $value;
    }

    public function setDataSourcesAttribute($value)
    {
        $this->attributes['data_sources'] = is_array($value) ? json_decode($value, true) : $value;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeWhereFilters($query, array $filters)
    {
        $filters = collect($filters);

        $query->when($filters->get('search'), function ($query, $search) {
            $query->whereSearch($search);
        });
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', '%'.$term.'%');
            });
        }
    }
}
