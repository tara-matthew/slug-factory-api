<?php

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Images\Models\PrintedDesignMasterImage;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\PrintedDesignSettings\Models\PrintedDesignSetting;
use Domain\Users\Models\User;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $lists = PrintedDesignList::factory(2)->create();

    $printedDesign = PrintedDesign::factory()
        ->hasMasterImages()
        ->hasPrintedDesignSetting()
        ->hasAttached($lists)
        ->create();

    expect($printedDesign->user)->toBeInstanceOf(User::class)
        ->and($printedDesign->filamentBrand)->toBeInstanceOf(FilamentBrand::class)
        ->and($printedDesign->filamentMaterial)->toBeInstanceOf(FilamentMaterial::class)
        ->and($printedDesign->filamentColour)->toBeInstanceOf(FilamentColour::class)
        ->and($printedDesign->masterImages)->each->toBeInstanceOf(PrintedDesignMasterImage::class)
        ->and($printedDesign->printedDesignLists)->each->toBeInstanceOf(PrintedDesignList::class)
        ->and($printedDesign->printedDesignSetting)->toBeInstanceOf(PrintedDesignSetting::class);
});
