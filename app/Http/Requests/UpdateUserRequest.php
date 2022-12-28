<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route()->user->id ?? null;
        return [
            'name'           => 'required|string',
            'email'          => 'required|email|unique:users,email,'.$id,
            'password'       => 'nullable|min:5|confirmed',
            'status'         => 'nullable',
            'id_number'      => 'required|min:8|max:20|unique:users,id_number,'.$id,
            'nationality_id' => 'required|exists:nationalities,id',
            'phone1'         => 'required|unique:users,phone1,'.$id,
            'phone2'         => 'nullable|unique:users,phone2,'.$id,
            'address'        => 'nullable',
            'payment_number' => 'nullable',
            'id_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'notes'          => 'nullable',
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
            'name'           => __('lang.name'),
            'email'          => __('lang.email'),
            'password'       => __('lang.password'),
            'status'         => __('lang.status'),
            'id_number'      => __('lang.id_number'),
            'nationality_id' => __('lang.nationality_id'),
            'phone1'         => __('lang.phone1'),
            'phone2'         => __('lang.phone2'),
            'address'        => __('lang.address'),
            'payment_number' => __('lang.payment_number'),
            'id_image'       => __('lang.id_image'),
            'notes'          => __('lang.notes'),
        ];
    }
}
