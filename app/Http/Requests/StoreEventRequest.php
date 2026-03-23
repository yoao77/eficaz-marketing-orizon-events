<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'event_datetime' => 'required|date|after:now',
            'end_date' => 'required|date|after:event_datetime',
            'people_capacity' => 'nullable|integer|min:1',
            'status' => 'nullable|in:active,canceled',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The event title is required.',
            'description.required' => 'The event description is required.',
            'location.required' => 'The event location is required.',
            'event_datetime.required' => 'The event date and time are required.',
            'event_datetime.after' => 'The event date and time must be in the future.',
            'end_date.required' => 'The end date and time are required.',
            'end_date.after' => 'The end date must be after the start date.',
            'people_capacity.integer' => 'The people capacity must be an integer.',
            'people_capacity.min' => 'The minimum capacity is 1 person.',
            'status.in' => 'The event status must be either "active" or "canceled".',
        ];
    }
}
