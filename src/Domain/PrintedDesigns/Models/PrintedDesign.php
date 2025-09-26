<?php

namespace Domain\PrintedDesigns\Models;

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Images\Models\PrintedDesignMasterImage;
use Domain\PrintedDesignSettings\Models\PrintedDesignSetting;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Domain\PrintedDesigns\Models\PrintedDesign
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\PrintedDesignFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesign whereUserId($value)
 * @method static PrintedDesign create($array = [])
 *
 * @property-read User $user
 *
 * @mixin Builder
 */
class PrintedDesign extends Model
{
    use HasFactory;

    // TODO remove eager load of printedDesignSetting and master images when PrintedDesign template has been sorted on the frontend
    protected $with = ['masterImages', 'printedDesignSetting'];

    protected $fillable = [
        'title',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function masterImages(): HasMany
    {
        return $this->hasMany(PrintedDesignMasterImage::class);
    }

    public function filamentBrand(): BelongsTo
    {
        return $this->belongsTo(FilamentBrand::class);
    }

    public function filamentColour(): BelongsTo
    {
        return $this->belongsTo(FilamentColour::class);
    }

    public function filamentMaterial(): BelongsTo
    {
        return $this->belongsTo(FilamentMaterial::class);
    }

    public function printedDesignSetting(): HasOne
    {
        return $this->hasOne(PrintedDesignSetting::class);
    }

    public function printedDesignLists(): BelongsToMany
    {
        return $this->belongsToMany(PrintedDesignList::class);
    }

    //    public function toResource(): PrintedDesignResource
    //    {
    //        $this->loadMissing(['filamentMaterial', 'favourites', 'printedDesignSetting']);
    //
    //        return new PrintedDesignResource($this);
    //    }
}
