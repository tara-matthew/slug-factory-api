<?php

namespace Domain\Images\Models;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * Domain\Images\Models\Image
 *
 * @property int $id
 * @property int|null $printed_design_id
 * @property int|null $user_id
 * @property string $url
 * @property int $is_cover_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\PrintedDesignMasterImageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage whereIsCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage wherePrintedDesignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintedDesignMasterImage whereUserId($value)
 *
 * @mixin Builder
 */
class PrintedDesignMasterImage extends Model
{
    protected $fillable = ['url', 'is_cover_image', 'blurhash'];

    // TODO make a resource
    use HasFactory;

    public static function booted(): void
    {
        self::deleted(function (self $model) {
            if (Storage::disk('public')->exists($model->url)) {
                Storage::disk('public')->delete($model->url);
            }
        });
    }

    public function printedDesign(): BelongsTo
    {
        return $this->belongsTo(PrintedDesign::class);
    }
}
