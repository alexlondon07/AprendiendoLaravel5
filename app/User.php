<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

    protected $dates = ['deleted_at'];

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
	protected $fillable = ['name', 'email', 'password', 'enable', 'profile'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function setPasswordAttribute($value){
		if(!empty($value)){
			$this->attributes['password']= bcrypt($value);
			//$this->attributes['password'] = Hash::make($pass);
		}
	}

	public $errors;
    public function isValid($data)
    {
        // se define la validacion de los campos
        $rules = array(
            'name' => 'required|max:60',
            'email'  => 'required|email|unique:users,email,' . $this->attributes['id'],
            'profile' => 'in:colaborador,usuario,super_admin',
            'enable'=>'in:si,no');
         // Se validan los datos ingresados segun las reglas definidas
        $validator = \Validator::make($data, $rules);
        if ($validator->passes())
        {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
    
    public function isValidStore($data)
    {
        // se define la validacion de los campos
        $rules = array(
            'name' => 'required|max:60',
            'email'  => 'required|email|unique:users,email,',
            'profile' => 'in:colaborador,usuario,super_admin',
            'enable'=>'in:si,no');
         // Se validan los datos ingresados segun las reglas definidas
        $validator = \Validator::make($data, $rules);
        if ($validator->passes())
        {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

}
