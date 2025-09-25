<?php

namespace Domain\PrintedDesigns\Actions;

use Domain\PrintedDesigns\DataTransferObjects\CreatePrintedDesignData;
use Domain\PrintedDesigns\Events\PrintedDesignUploaded;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class StorePrintedDesignAction
{
    public function __construct(
        private readonly StorePrintedDesignImagesAction $storePrintedDesignImagesAction,
        private readonly StorePrintedDesignSettingsAction $storePrintedDesignSettingsAction,
    ) {}

    public function execute(CreatePrintedDesignData $printedDesignData, User $user): PrintedDesign
    {
        try {
            $printedDesign = DB::transaction(function () use ($user, $printedDesignData) {
                $printedDesign = new PrintedDesign([
                    'title' => $printedDesignData->title,
                    'description' => $printedDesignData->description,
                ]);

                $printedDesign->user()->associate($user);
                $this->associateFilamentDetails($printedDesign, $printedDesignData);

                $printedDesign->save();

                $this->storePrintedDesignImagesAction->execute($printedDesign, $printedDesignData);
                $this->storePrintedDesignSettingsAction->execute($printedDesign, $printedDesignData);

                return $printedDesign;
            });

            PrintedDesignUploaded::dispatch($printedDesign);

            return $printedDesign->loadMissing([
                'filamentBrand',
                'filamentColour',
                'filamentMaterial',
                'printedDesignSetting',
                'masterImages',
            ]);

        } catch (Throwable $e) {
            throw $e;
        }
    }

    private function associateFilamentDetails(PrintedDesign $printedDesign, CreatePrintedDesignData $data): void
    {
        $printedDesign->filamentBrand()->associate($data->filament_brand_id);
        $printedDesign->filamentColour()->associate($data->filament_colour_id);
        $printedDesign->filamentMaterial()->associate($data->filament_material_id);
    }
}
