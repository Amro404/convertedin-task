<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'assigned_to_id' => ['required', 'int', Rule::exists('users', 'id')
                ->where(function ($query) {
                        $query->where('is_admin', false);
                    }
                )
            ],
            'assigned_by_id' => ['required', 'int', Rule::exists('users', 'id')
                ->where(function ($query) {
                        $query->where('is_admin', true);
                    }
                )
            ]
        ];
    }
}
