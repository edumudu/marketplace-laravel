<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['reference', 'pagseguro_code', 'pagseguro_status', 'items'];

    public function user ()
    {
      return $this->belongsTo(User::class);
    }

    public function store ()
    {
      return $this->belongsTo(Store::class);
    }

    public function stores()
    {
      return $this->belongsToMany(Store::class, 'order_store', 'order_id');
    }
}
