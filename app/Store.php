<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasSlug;

    protected $fillable = [
      'name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'
    ];

    public function getSlugOptions()
    {
      return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function products()
    {
      return $this->hasMany(Product::class);
    }

    public function orders()
    {
      return $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id');
    }

    public function notifyStoreOwners(array $storesIds = [])
    {
      $stores = $this->whereIn('id', $storesIds)->get();

      $stores->map(fn($store) => $store->user)
             ->each->notify(new StoreReceiveNewOrder);
    }
}
