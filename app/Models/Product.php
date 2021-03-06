<?php

namespace App\Models;

use App\Http\Resources\CompanyResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'rate',
    ];

    /**
     * Get the company that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all of the rating for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rating(): HasMany
    {
        return $this->hasMany(ProductRating::class);
    }

    public static function getRate($id)
    {
        $rate = ProductRating::where('product_id', $id)->avg('rating');
        return $rate;
    }
}
