<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model_id',
        'nominal_name',
        'mechanism',
        'years_of_production',
        'watch_case_width',
        'width_of_the_watchs_ear',
        'ear_ear_dimension',
        'glass',
        'number_of_stones',
        'gender',
        'detailed_desc',
    ];
}
