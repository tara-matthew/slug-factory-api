<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PrintedDesign
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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

 * @mixin Builder
 */
class PrintedDesign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
