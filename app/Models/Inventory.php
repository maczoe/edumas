<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'establishment_id', 'stock'
        ];
    
    public function establishment()
    {
        return $this->belongsTo('App\Models\Establishment');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
