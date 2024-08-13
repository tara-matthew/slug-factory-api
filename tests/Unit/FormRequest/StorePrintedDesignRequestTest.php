<?php

namespace Tests\Unit\FormRequest;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has rules set up correctly', function () {
    $storePrintedDesignRequest = new StorePrintedDesignRequest();

    $this->assertEquals(
        [
            'title' => 'required|max:255',
            'description' => 'required',
            'filament_brand_id' => 'required:exists:filament_brands,id',
            'filament_colour_id' => 'required:exists:filament_colours,id',
            'filament_material_id' => 'required:exists:filament_materials,id',
            'images.*.url' => 'required',
            'images.*.is_cover_image' => 'required|bool',
        ],
        $storePrintedDesignRequest->rules()
    );
});
