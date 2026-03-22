<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_datetime' => 'required|date|after_or_equal:now',
            'people_capacity' => 'nullable|integer|min:1',
            'status' => 'required|in:active,canceled,draft',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The event title is required for updates.',
            'description.required' => 'Please provide a description for the event.',
            'location.required' => 'A location must be specified.',
            'event_datetime.required' => 'The date and time are required.',
            'event_datetime.after_or_equal' => 'The event cannot be scheduled for a past date.',
            'people_capacity.integer' => 'Capacity must be a valid number.',
            'people_capacity.min' => 'Capacity must be at least 1 person.',
            'status.required' => 'The event status is required.',
            'status.in' => 'Selected status is invalid.',
        ];
    }
}
