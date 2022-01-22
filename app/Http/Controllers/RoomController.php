<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RoomRequest $request)
    {
        $employee = Employee::where('identification', $request->validated())->first();

        if (!$employee) {
            $log = Log::create([
                'action' => 'entrance',
                'status' => 'ERROR',
                'error_message' => 'Employee Not Found',
            ]);

            return redirect('/room-911')->with('error', $log->error_message);
        }

        if (!$employee->user->hasPermissionTo('room-911')) {
            $log = Log::create([
                'action' => 'entrance',
                'status' => 'ERROR',
                'error_message' => 'Employee Not Authorized',
                'employee_id' => $request->validated()['number'],
            ]);

            return redirect('/room-911')->with('error', $log->error_message);
        }

        $log = Log::create([
            'action' => 'entrance',
            'status' => 'SUCCESS',
            'error_message' => 'Employee Has ingress succesfully',
            'employee_id' => $request->validated()['number'],
        ]);

        return view('room.dashboard', [
            'name' => $employee->name,
            'message' => $log->error_message,
            'identification' => $employee->identification,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exit(Request $request)
    {
        $log = Log::create([
            'action' => 'exit',
            'status' => 'SUCCESS',
            'error_message' => 'Employee Has egress succesfully',
            'employee_id' => $request->identification,
        ]);
        
        return view(
            'room.register',
            [
                'name' => $request->name,
                'message' => $log->error_message,
                'identification' => $request->identification,
            ]
        );
    }
}
