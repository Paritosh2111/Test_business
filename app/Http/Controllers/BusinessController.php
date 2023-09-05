<?php

namespace App\Http\Controllers;
use App\Models\Business;
use App\Models\Branch;
use App\Models\BranchWorkingHour;
use App\Models\BranchImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    public function index(){

        $datas = Business::all();
        return view('business',compact('datas'));
    }

    public function create(){
        return view('business.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'logo' => 'required|image|max:2048',
            'branch_name.*' => 'required|string',
        ]);
        DB::beginTransaction();

        try {
            $business = new Business([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'logo' => $request->file('logo')->store('logos', 'public'),
            ]);

            $business->save();

            $branchesData = $request->branch_name;
            $workingHoursData = $request->working_hours;
            $branchImagesData = $request->file('branch_images');

            foreach ($branchesData as $index => $branchName) {
                $branch = new Branch(['name' => $branchName]);
                $business->branches()->save($branch);

                foreach ($workingHoursData[$index] as $day => $hours) {
                    if (isset($hours['closed']) && $hours['closed'] === "on") {
                        BranchWorkingHour::create([
                            'branch_id' => $branch->id,
                            'day' => $day,
                            'closed' => true,
                        ]);
                    } else {
                        BranchWorkingHour::create([
                            'branch_id' => $branch->id,
                            'day' => $day,
                            'start_time' => $hours['start_time'],
                            'end_time' => $hours['end_time'],
                            'closed' => false,
                        ]);
                    }
                }

                // if ($branchImagesData[$index]) {
                //     foreach ($branchImagesData[$index] as $image) {
                //         $imagePath = $image->store('branch_images', 'public');
                //         $branchImage = new BranchImage(['image' => $imagePath]);
                //         $branch->images()->save($branchImage);
                //     }
                // }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to create the business.'], 500);
        }
    }
}
