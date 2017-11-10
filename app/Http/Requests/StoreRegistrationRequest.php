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
            'regNumber' => 'required|numeric',
            'lastName' => 'required|alpha',
            'firstName' => 'required|alpha',
            'fLastName' => 'required|alpha',
            'fFirstName' => 'required|alpha',
            'mLastName' => 'required|alpha',
            'mFirstName' => 'required|alpha',
            'dob' => 'required|date',
            'birthPlace' => 'required|alpha',
            'phoneOne' => 'required|numeric',
            'gender' => 'required|alpha',
            'idNumber' => 'required|numeric',
            'degree_id' => 'required|numeric',
            'school' => 'required|alpha',
            'maritalStatus' => 'required|alpha',
            'email' => 'required|email',
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
            'job' => 'required|alpha',
            'employer' => 'required|alpha',
            'jobLocation' => 'required|alpha',
            'baptismDate' => 'required|date',
            'baptismParish' => 'required|alpha',
            'duty_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'commision_id' => 'required|numeric',
            'choir_id' => 'required|numeric',
            'status_id' => 'required|numeric',
            'confirmed' => 'required|boolean',
            'notes' => 'required|alpha|max:186'

        ];
    }
}
