<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
        $id = $this->route()->admin->id ?? null;
        return [
            'name'      => 'required|string|min:5',
            'email'     => 'required|email|unique:admins,email,'.$id,
            'password'  => 'nullable|min:5|confirmed',
            'status'    => 'nullable',
            'id_number' => 'required|unique:admins,id_number,'.$id,
            'branch_id' => 'nullable|exists:branches,id',
            'phone'     => 'nullable|unique:admins,phone,'.$id,
            'address'   => 'nullable',
            'role'      => 'nullable',
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
