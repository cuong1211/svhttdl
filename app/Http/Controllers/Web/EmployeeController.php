<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Staff\Department;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {   
        $employees = Department::query()->with(['staffs' =>function($q){
            $q->with('position');
        }])->get();
        // dd($employees);
        return view('web.employee.index',compact('employees'));
    }
    public function show($id)
    {
        $employees = Department::query()->with(['staffs' =>function($q){
            $q->with('position');
        }])->get();
        $staff = Staff::query()->where('department_id',$id)->with('position')->get();
        // dd($staff);
        return view('web.employee.show',compact('employees','staff'));
    }
}
