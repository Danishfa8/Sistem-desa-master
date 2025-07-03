<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsahaEkonomiRequest extends FormRequest
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
        return [
			'desa_id' => 'required',
			'tahun' => 'required',
			'nama_usaha' => 'required|string',
			'luas' => 'required|string',
			'created_by' => 'required|string',
			'updated_by' => 'string',
			'status' => 'required',
			'reject_reason' => 'string',
			'approved_by' => 'string',
			'approved_at' => 'string',
        ];
    }
}
