<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'status' => ['required', 'string', 'in:Pending,In Progress,Completed'],
            'priority' => ['required', 'string', 'in:Low,Medium,High'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'user_ids' => ['nullable', 'array', 'exists:users,id'],
            'admins' => ['nullable', 'array', 'exists:users,id']
        ];
    }
}
