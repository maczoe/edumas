<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'password', 'email', 'username'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    
    public function students() {
        $this->hasMany('App\Models\Student');
    }
    
    public function teachers() {
        $this->hasMany('App\Models\Teacher');
    }
    
    public function payments() {
        return $this->hasMany('App\Models\Payment');
    }
    
    public function cashflows() {
        return $this->hasMany('App\Models\Cashflow');
    }
    
    public function attendances() {
        return $this->hasMany('App\Models\Attendance');
    }
    
    public static function searchByName($name) {
        return User::where('name', $name)->first();
    }
    
}
