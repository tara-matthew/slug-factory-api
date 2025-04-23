<?php

namespace Domain\Favourites\Actions;

use App\Exceptions\ItemAlreadyFavouritedException;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Models\PrinterFilament;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Printers\Models\Printer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StoreFavouriteAction
{
    /**
     * @throws ItemAlreadyFavouritedException
     */
    public function execute(PrintedDesign|PrinterFilament|Printer|FilamentBrand $model): Model
    {
        $user = Auth::user();

        $favourite = $model->favourites()->make();
        $favourite->user()->associate($user);
        $favourite->save();

        return $favourite;
    }
}
