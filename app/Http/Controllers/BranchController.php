<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Business;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index($id){

        $business = Business::with('branches')->find($id);
        dd($business);
    }
}
