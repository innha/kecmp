<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'required|numeric',
            'regNumber' => 'required|numeric|unique:registrations',
            'lastName' => 'required',
            'firstName' => 'required',
            'fLastName' => 'required',
            'fFirstName' => 'required',
            'mLastName' => 'required',
            'mFirstName' => 'required',
            'dob' => 'required|date',
            'birthPlace' => 'required',
            // 'phoneOne' => 'numeric',
            'gender' => 'required|alpha',
            'idNumber' => 'unique:registrations',
            // 'degree_id' => 'numeric',
            // 'school' => 'alpha_spaces',
            'maritalStatus' => 'required|alpha',
            // 'email' => 'email',
            'province_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'sector_id' => 'required|numeric',
            'cell_id' => 'required|numeric',
            'village_id' => 'required|numeric',
            'diocese_id' => 'required|numeric',
            'parish_id' => 'required|numeric',
            'chapelle_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'ownsHouse' => 'required|boolean',
            // 'job' => 'alpha_spaces',
            // 'employer' => 'alpha_spaces',
            // 'jobLocation' => 'alpha_spaces',
            // 'baptismDate' => 'date',
            // 'baptismParish' => 'alpha',
            // 'duty_id' => 'numeric',
            'category_id' => 'required|numeric',
            // 'service_id' => 'numeric',
            // 'commission_id' => 'numeric',
            // 'choir_id' => 'numeric',
            'status_id' => 'required|numeric',
            'confirmed' => 'required|boolean',
            'notes' => 'max:186'

        ];
    }
}
