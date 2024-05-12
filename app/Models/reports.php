<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_title',
        'category',
<<<<<<< Updated upstream
        'location',
=======
        'coordinates',
        'fillColor',
>>>>>>> Stashed changes
        'date',
        'description',
        'image'
    ];
}
