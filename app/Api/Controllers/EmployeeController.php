<?php

namespace App\Api\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Return all employees
     *
     * @param Request $request
     * @return object
     */
    public function index()
    {
        $employees = Employee::all();

        return response()
            ->json($employees, Response::HTTP_OK);
    }

    /**
     * Store new employee
     *
     * @param StoreEmployeeRequest $request
     * @return object
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = Employee::create([
                'city' => $request->city,
                'country_id' => $request->country,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'postal_code' => $request->postal_code,
                'date_of_birth' => $request->date_of_birth,
                'email_address' => $request->email_address,
                'contact_number' => $request->contact_number,
                'street_address' => $request->street_address,
            ]);

            if (!empty($request->skills)) {
                foreach ($request->skills as $skill) {
                    $employee->skills()->attach($skill['skill_id'], [
                        'years' => $skill['years'],
                        'seniority_rating' => $skill['rating']
                    ]);
                }
            }

            return response()
                ->json($employee, Response::HTTP_OK);
        } catch (Exception $e) {
            report($e);
        }

        return response()
            ->json(['message' => 'Ooops something went wrong.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Show employee details
     *
     * @param Request $request
     * @param integer $id
     * @return object
     */
    public function show(Request $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {

            return response()
                ->json($employee->load('skills'), Response::HTTP_OK);
        }

        return response()
            ->json(['message' => 'Ooops something went wrong.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the employee details
     *
     * @param UpdateEmployeeRequest $request
     * @param integer $id
     * @return object
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            try {

                $employee->city = $request->city;
                $employee->country_id = $request->country;
                $employee->last_name = $request->last_name;
                $employee->first_name = $request->first_name;
                $employee->postal_code = $request->postal_code;
                $employee->date_of_birth = $request->date_of_birth;
                $employee->email_address = $request->email_address;
                $employee->contact_number = $request->contact_number;
                $employee->street_address = $request->street_address;
                $employee->save();

                if (!empty($request->skills)) {
                    $employee->skills()->detach();
                    foreach ($request->skills as $skill) {
                        $employee->skills()->attach($skill['skill_id'], [
                            'years' => $skill['years'],
                            'seniority_rating' => $skill['rating']
                        ]);
                    }
                }

                return response()
                    ->json($employee->load('skills'), Response::HTTP_OK);
            } catch (Exception $e) {
                report($e);
            }
        }

        return response()
            ->json(['message' => 'Ooops something went wrong.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Edit employee
     *
     * @param Request $request
     * @param integer $id
     * @return object
     */
    public function edit(Request $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return response()
                ->json($employee->load('skills'), Response::HTTP_OK);
        }

        return response()
            ->json(['message' => 'Ooops something went wrong.'], Response::HTTP_BAD_REQUEST);
    }
}
