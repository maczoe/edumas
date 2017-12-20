<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'barcode', 'cost', 'price'
        ];
    
    public function getCostCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.number_format($this->cost,2);
    }
    
    public function getPriceCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.number_format($this->price,2);
    }
}
