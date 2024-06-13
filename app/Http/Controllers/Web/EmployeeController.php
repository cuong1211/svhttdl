<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Staff\Department;
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
}
