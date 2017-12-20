<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity', 'detail', 'unit_price', 'amount', 'product_id', 'payment_id'
        ];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
    
    public function getUnitPriceCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.number_format($this->unit_price,2);
    }
    
    public function getAmountCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.number_format($this->amount,2);
    }
}
