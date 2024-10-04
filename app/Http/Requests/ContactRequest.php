<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email",
            "phone" => "required|string|size:10",
            "image"=>"image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name is required",
            "email.required" => "Email is required",
            "email.email" => "Email is invalid",
            "phone.required" => "Phone is required",
            "phone.numeric" => "Phone is invalid",
            "phone.size" => "Phone is invalid",
            "image.image" => "Image is invalid",
            "image.max" => "Image size is too large",
            "image.mimes" => "Image type is invalid",
        ];
    }
}
