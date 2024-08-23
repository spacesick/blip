<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transaction
 * @property-read int|null $transaction_count
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImageAttachment extends Model
{
    protected $fillable = [
        'image_url',
    ];

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
