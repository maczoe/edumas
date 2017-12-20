<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Serie extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'series';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serie', 'establishment_id', 'current', 'min', 'max', 'enabled', 'type'
        ];
    
    public function establishment()
    {
        return $this->belongsTo('App\Models\Establishment');
    }
    
    public function getTypeLocaleAttribute() {
        return Lang::get('attrib.'.$this->type);
    }
}
