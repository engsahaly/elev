<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|min:5',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required|min:5|confirmed',
            'status'    => 'nullable',
            'id_number' => 'required|unique:admins,id_number',
            'branch_id' => 'nullable|exists:branches,id',
            'role'      => 'nullable',
            'phone'     => 'nullable|unique:admins,phone',
            'address'   => 'nullable',
        ];
    }

    /**
     * Attributes .
     *
     * @return array
     */
    public function attributes()
    {
        return [            
            'name'      => __('lang.name'),
            'email'     => __('lang.email'),
            'password'  => __('lang.password'),
            'status'    => __('lang.status'),
            'id_number' => __('lang.id_number'),
            'branch_id' => __('lang.branch'),
            'phone'     => __('lang.phone'),
            'address'   => __('lang.address'),
        ];
    }
}
