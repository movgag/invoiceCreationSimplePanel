<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    /**
     * The payment items associated with the invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment_items()
    {
        return $this->hasMany('App\PaymentItem','invoice_id','id');
    }

    /**
     * The purchase items associated with the invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchase_items()
    {
        return $this->hasMany('App\PurchaseItem','invoice_id','id');
    }
}
