<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
//        if(!in_array($this->file->getClientOriginalExtension(), ['xls', 'xlsx'])){
//            throw ValidationException::withMessages(['incorrect file extension']);
//        }
        return [
            'file' => 'required|file|mimes:xls,xlsx',
        ];
    }
}
