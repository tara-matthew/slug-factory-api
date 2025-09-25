<?php

namespace Domain\Favourites\Actions;

use App\Exceptions\ItemAlreadyFavouritedException;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Printers\Models\Printer;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreFavouriteAction
{
    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function execute(PrintedDesign|PrinterFilament|Printer|FilamentBrand $model, User $user): Model
    {
        $favourite = $model->favourites()->make();
        $favourite->user()->associate($user);
        $favourite->save();

        return $favourite;
    }
}
