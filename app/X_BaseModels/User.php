<?php

namespace App;


use App\Enums\EnumDataSourceType;
use Mockery\Exception;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Model as Model;
use Symfony\Component\HttpKernel\Tests\Controller\ContainerControllerResolverTest;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact', 'email_address'
    ];

    /**
     * The column name of the "remember me" token.
     *
     * @var string
     */
    protected $rememberTokenName = 'remember_token';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'active'
    ];

    /**
     * the attributes that should be guarded from Mass Assignment
     *
     * @var array
     */
    protected $guarded = [
        'created_at', 'updated_at', 'password_hash'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "user";

    /**
     * We have a non incrementing primary key
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * We are using UUID for primary key
     *
     * @var bool
     */
    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function contact(PersonContact $p = null){
        if($p !== null){
            $this->contact_id = $p->id;
        }
        return $this->hasOne(PersonContact::class);
    }

    public function accounts(){
        return $this->hasMany(Entity::class);
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null){

        $references = $this->morphToMany(DynamicEnumValue::class, 'object','x_object_dev');

        if($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id]);
        }

        $ref_array = array();

        foreach($references->get() as $reference){

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }

    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        return $this;
    }


    /**
     * @param $password string
     * set user password_hash
     * @return $this
     */
    public function setPassword($password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password_hash = Hash::make($password);
            $this->save();
        } catch(\Exception $e) {
            dump($e->getMessage());
        }
        return $this;
    }


    public function orderAccountsByName(){
        $sorted = $this->accounts->sortBy('name');

        return $sorted;
    }

    public function getEmailUsername(){
        $contact = PersonContact::getObjectById($this->contact_id);

        $email = Email::getObjectById($contact->email_id);

        return $email->username_prefix;
    }

    public static function getUserByContact($contact){
        return User::where('contact_id', $contact->id)->first();
    }

    public static function getUserByEmail($email){

        $email = Email::getEmailByAddress($email);

        if(is_object($email)){
            $contact = PersonContact::getContactByEmail($email);
            if(is_object($contact)){
                $user = User::getUserByContact($contact);
                if(is_object($user)){
                    return $user;
                }
            }
        }

        return false;
    }


    /**
     * @return string
     *
     * getFullName
     * returns concatenated first and last name of user.
     */
    public function getFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName(){
        return $this->getKeyName();

    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier(){
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(){
        return $this->password_hash;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken(){
        if (! empty($this->getRememberTokenName())) {
            return $this->{$this->getRememberTokenName()};
        }
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value){
        if (! empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName(){
        return $this->rememberTokenName;
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset(){

    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token){

    }

    public function validateAddress(){

    }


}
