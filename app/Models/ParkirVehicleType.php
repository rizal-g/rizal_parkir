<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirVehicleType extends Model
{
    use HasFactory;
    
    protected $table = 'parkir_vehicle_types';
    
    protected $fillable = [
        'jenis', 
        'perjam_pertama', 
        'perjam_berikutnya', 
        'max_perhari'
        ];
}