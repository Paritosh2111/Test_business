<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name','working_week_days','logo'];

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'branch_business');

    }

    public function workingHours()
    {
        return $this->hasMany(BranchWorkingHour::class);
    }

    public function images()
    {
        return $this->hasMany(BranchImage::class);
    }
}
