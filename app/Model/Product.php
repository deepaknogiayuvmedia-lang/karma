<?php

namespace App\Model;

use App\CPU\Helpers;
use App\Model\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $casts = [
        'user_id' => 'integer',
        'brand_id' => 'integer',
        'min_qty' => 'integer',
        'published' => 'integer',
        'tax' => 'float',
        'unit_price' => 'float',
        'status' => 'integer',
        'discount' => 'float',
        'current_stock' => 'integer',
        'free_shipping' => 'integer',
        'featured_status' => 'integer',
        'refundable' => 'integer',
        'featured' => 'integer',
        'flash_deal' => 'integer',
        'seller_id' => 'integer',
        'purchase_price' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'shipping_cost' => 'float',
        'multiply_qty' => 'integer',
        'temp_shipping_cost' => 'float',
        'is_shipping_cost_updated' => 'integer',
        'choice_attributes' => 'json',
        // Phase 1: New fields
        'priority' => 'integer',
        'admin_commission' => 'float',
        'approval_status' => 'string',
        'edit_status' => 'string',

    ];

    protected $fillable = [
        'name',
        'technical_name',
        'tally_name',
        'price',
        'product_type',
        'added_by',
        'code',
        'pid',
        'indexing',
        'choice_attributes',
        // Phase 1: New fields
        'priority',
        'admin_commission',
        'admin_commission_type',
        'approval_status',
        'edit_status',
    ];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }

    public function scopeActive($query)
    {
        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        $digital_product_setting = BusinessSetting::where('type', 'digital_product')->first()->value;

        if (!$digital_product_setting) {
            $product_type = ['physical'];
        } else {
            $product_type = ['digital', 'physical'];
        }

        return $query->when($brand_setting, function ($q) {
            $q->whereHas('brand', function ($query) {
                $query->where(['status' => 1]);
            });
        })->when(!$brand_setting, function ($q) {
            $q->whereNull('brand_id');
        })->where(['status' => 1])->where(function ($query) {
            $query->where('approval_status', 'approved')
                  ->orWhereNull('approval_status');
        })->SellerApproved()->whereIn('product_type', $product_type);
    }

    public function scopeSellerApproved($query)
    {
        $query->whereHas('seller', function ($query) {
            $query->where(['status' => 'approved']);
        })->orWhere(function ($query) {
            $query->where(['added_by' => 'admin', 'status' => 1]);
        });

    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeStatus($query)
    {
        return $query->where('featured_status', 1);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'seller_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id');
    }

    public function rating()
    {
        return $this->hasMany(Review::class)
            ->select(DB::raw('avg(rating) average, product_id'))
            ->whereNull('delivery_man_id')
            ->groupBy('product_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }


    
    public function order_delivered()
    {
        return $this->hasMany(OrderDetail::class, 'product_id')
            ->where('delivery_status', 'delivered');

    }

    public function wish_list()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function scopeLowestPricePerPid($query)
    {
        return $query->whereNotNull('indexing')->where('indexing', 1);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Phase 1: Approval Status Scopes
    public function scopeDraft($query)
    {
        return $query->where('approval_status', 'draft');
    }

    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('approval_status', 'rejected');
    }

    public function scopePendingEdit($query)
    {
        return $query->where('approval_status', 'pending_edit');
    }

    // Phase 1: By Priority scope
    public function scopeByPriority($query)
    {
        return $query->orderBy('priority', 'desc');
    }

    public function getNameAttribute($name)
    {
        if (strpos(url()->current(), '/admin') || strpos(url()->current(), '/seller')) {
            return $name;
        }
        $locale = Helpers::default_lang();
        foreach ($this->translations as $t) {
            if ($t->locale === $locale && !empty($t->value)) {
                return $t->value;
            }
        }
        return $name;
    }

    public function getDetailsAttribute($detail)
    {
        if (strpos(url()->current(), '/admin') || strpos(url()->current(), '/seller')) {
            return $detail;
        }
        $locale = Helpers::default_lang();
        foreach ($this->translations as $t) {
            if ($t->locale === $locale && !empty($t->value)) {
                return $t->value;
            }
        }
        return $detail;
    }

    public function getTechnicalNameAttribute($value)
    {
        if (strpos(url()->current(), '/admin') || strpos(url()->current(), '/seller')) {
            return $value;
        }
        $locale = Helpers::default_lang();
        foreach ($this->translations as $t) {
            if ($t->locale === $locale && !empty($t->value) && $t->key === 'technical_name') {
                return $t->value;
            }
        }
        return $value;
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                if (strpos(url()->current(), '/api')) {
                    return $query->where('locale', App::getLocale());
                } else {
                    return $query->where('locale', Helpers::default_lang());
                }
            }, 'reviews'=>function($query){
                $query->whereNull('delivery_man_id');
            }])->withCount(['reviews'=>function($query){
                $query->whereNull('delivery_man_id');
            }]);
        });
    }
}
