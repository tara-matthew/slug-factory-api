<?php

namespace Domain\Favourites\Actions;

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Printers\Models\Printer;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeleteFavouriteAction
{
    public function handle(PrintedDesign|PrinterFilament|Printer|FilamentBrand $model): void // TODO make a favouritable base model
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        $model->favourites()->whereBelongsTo($user)->delete();
    }
}
