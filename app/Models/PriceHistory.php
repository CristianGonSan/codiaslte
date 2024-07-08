<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $product_id
 * @property string $price
 * @property string $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @method static Builder|PriceHistory newModelQuery()
 * @method static Builder|PriceHistory newQuery()
 * @method static Builder|PriceHistory query()
 * @method static Builder|PriceHistory whereCreatedAt($value)
 * @method static Builder|PriceHistory whereDate($value)
 * @method static Builder|PriceHistory whereId($value)
 * @method static Builder|PriceHistory wherePrice($value)
 * @method static Builder|PriceHistory whereProductId($value)
 * @method static Builder|PriceHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PriceHistory extends Model
{
    use HasFactory;

    protected $table = 'price_history';

    protected $fillable = [
        'product_id',
        'price',
        'date',
    ];

    public static function newPriceHistory(Product $product)
    {
        return self::create([
            'product_id' => $product->id,
            'price' => $product->price,
            'date' => now(),
        ]);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
