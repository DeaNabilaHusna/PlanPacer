<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProyekRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
// return true;
    $user = Auth::user();
    $kolaborator = $this->route('kolaborator');

    // Periksa apakah pengguna yang login adalah pemilik proyek atau memiliki peran 'pic'
    if ($user->id === $kolaborator->user_id || $user->role === 'pic') {
        return true;
    }

    return false;
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
        ];
    }
}
