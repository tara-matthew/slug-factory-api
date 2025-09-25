<?php

namespace Domain\Favourites\Actions;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Printers\Models\Printer;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class DeleteFavouriteAction
{
    public function handle(PrintedDesign|PrinterFilament|Printer|FilamentBrand $model, User $user): void // TODO make a favouritable base model
    {
        $model->favourites()->whereBelongsTo($user)->delete();
    }
}
