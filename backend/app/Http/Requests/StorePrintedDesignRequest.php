<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;
use PrintedDesignData;

class StorePrintedDesignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'images.*.url' => 'required'

        ];
    }

//    public function toDTO(): PrintedDesignData
//    {
//        return new PrintedDesignData(
//            title: $this->title,
//            description: $this->description,
//            userID: $this->user_id
//        );
//    }
}
