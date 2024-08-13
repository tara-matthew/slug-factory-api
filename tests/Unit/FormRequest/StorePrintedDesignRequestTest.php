<?php

namespace Tests\Unit\FormRequest;

use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StorePrintedDesignRequestTest extends TestCase
{
    use AdditionalAssertions;
    use RefreshDatabase;

    private StorePrintedDesignRequest $printedDesignRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->printedDesignRequest = new StorePrintedDesignRequest();
    }

    #[Test]
    public function it_has_rules_set_up_as_expected(): void
    {
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
            $this->printedDesignRequest->rules()
        );
    }
}
