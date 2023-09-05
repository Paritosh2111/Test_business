<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchWorkingHour extends Model
{
    use HasFactory;

    protected $fillable = ['day','branch_id','start_time','end_time','closed'];

    protected $table = ['branch_working_hours'];
}
