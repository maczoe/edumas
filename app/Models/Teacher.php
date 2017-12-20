<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model 
{
    use SoftDeletes;
    
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'id_number',
        'phone_number', 'cellphone_number', 'address',
        'comment'
        ];
    
 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function classes() {
        return $this->hasMany('App\Models\Class');
    }
    
    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }
    
}

