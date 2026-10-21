<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * Temporary storage for multiple images during model assignment.
     *
     * @var array|null
     */
    public ?array $pendingImages = null;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'size',
        'color',
        'price',
        'discount',
        'sale_price',
        'stock',
        'image',
        'state',
        'status',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'stock' => 'integer',
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Stock attribute accessor taking into account product variants if present.
     */
    public function getStockAttribute($value)
    {
        if ($this->relationLoaded('variants') ? $this->variants->isNotEmpty() : $this->variants()->exists()) {
            return $this->variants()->sum('stock');
        }
        return (int) $value;
    }

    /**
     * Multiple image support: Setter for image attribute.
     * Accepts either a single string path or an array of image paths.
     */
    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['image'] = $value[0] ?? null;
            $this->pendingImages = $value;
        } else {
            $this->attributes['image'] = $value;
        }
    }

    /**
     * Image accessor with fallback to first gallery image.
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        return $this->images->first()?->image_path;
    }

    /**
     * Get all unique images (main image + gallery images).
     */
    public function getAllImagesAttribute(): array
    {
        $all = [];
        if (!empty($this->attributes['image'])) {
            $all[] = $this->attributes['image'];
        }

        $galleryImages = $this->relationLoaded('images') ? $this->images : $this->images()->get();
        foreach ($galleryImages as $img) {
            if (!in_array($img->image_path, $all)) {
                $all[] = $img->image_path;
            }
        }

        return $all;
    }

    /**
     * Save multiple image paths into product_images relation.
     */
    public function syncMultipleImages(array $imagePaths): void
    {
        foreach ($imagePaths as $path) {
            if (!empty($path)) {
                $this->images()->firstOrCreate([
                    'image_path' => $path,
                ]);
            }
        }

        if (empty($this->attributes['image']) && !empty($imagePaths[0])) {
            $this->update(['image' => $imagePaths[0]]);
        }
    }

    /**
     * State accessor synced with status.
     */
    public function getStateAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        return $this->status ? 'active' : 'inactive';
    }

    /**
     * State mutator syncing status boolean.
     */
    public function setStateAttribute($value)
    {
        $this->attributes['state'] = $value;
        $val = strtolower((string)$value);
        if (in_array($val, ['1', 'true', 'active', 'published', 'enabled'])) {
            $this->attributes['status'] = 1;
        } elseif (in_array($val, ['0', 'false', 'inactive', 'draft', 'disabled'])) {
            $this->attributes['status'] = 0;
        }
    }

    /**
     * Status mutator syncing state string.
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = (bool) $value;
        if (empty($this->attributes['state'])) {
            $this->attributes['state'] = $value ? 'active' : 'inactive';
        }
    }

    /**
     * Effective price accessor calculating discount if sale_price is not set.
     */
    public function getEffectivePriceAttribute(): float
    {
        if ($this->sale_price !== null && (float) $this->sale_price > 0) {
            return (float) $this->sale_price;
        }
        if ($this->discount !== null && (float) $this->discount > 0 && (float) $this->price > 0) {
            return (float) round($this->price - ($this->price * ($this->discount / 100)), 2);
        }
        return (float) $this->price;
    }

    /**
     * Discount percentage accessor.
     */
    public function getDiscountPercentAttribute(): int
    {
        if ($this->discount !== null && (float) $this->discount > 0) {
            return (int) round($this->discount);
        }
        if ($this->sale_price !== null && (float) $this->sale_price < (float) $this->price && (float) $this->price > 0) {
            return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            // Auto generate slug if missing
            if (empty($product->slug) && !empty($product->name)) {
                $baseSlug = \Illuminate\Support\Str::slug($product->name);
                $slug = $baseSlug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$baseSlug}-" . $count++;
                }
                $product->slug = $slug;
            }

            // Auto generate SKU if missing
            if (empty($product->sku) && !empty($product->name)) {
                $prefix = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $product->name), 0, 3));
                $product->sku = ($prefix ?: 'PRD') . '-' . strtoupper(\Illuminate\Support\Str::random(6));
            }

            // Auto calculate sale_price if discount is provided and sale_price is empty
            if (!empty($product->discount) && empty($product->sale_price) && !empty($product->price)) {
                $product->sale_price = round($product->price - ($product->price * ($product->discount / 100)), 2);
            }

            // Default state
            if (empty($product->state)) {
                $product->state = ($product->status ?? true) ? 'active' : 'inactive';
            }
        });

        static::saved(function ($product) {
            if (!empty($product->pendingImages)) {
                foreach ($product->pendingImages as $path) {
                    if (!empty($path)) {
                        $product->images()->firstOrCreate([
                            'image_path' => $path,
                        ]);
                    }
                }
                $product->pendingImages = null;
            }
        });

        static::deleting(function ($product) {
            // Delete main product image
            if ($product->image && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }

            // Delete gallery images
            foreach ($product->images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    @unlink(public_path($image->image_path));
                }
            }
        });
    }
}
