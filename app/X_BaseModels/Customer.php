<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 2:54 AM
 */

namespace App;

use Illuminate\Support\Facades\Hash;

use App\Model as Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact', 'username', 'email_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password_hash', 'active'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    public $incrementing = false;

    /**
     * relationships
     */
    public function contact(){
        return $this->hasOne(Contact::class);
    }

    public function endpoints(){
        return $this->hasMany(Endpoint::class);
    }


    /**
     * Customer constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        return $this;
    }


    public function getEmailUsername(){
        $contact = Contact::getObjectById($this->contact_id);

        $email = Email::getObjectById($contact->email_id);

        return $email->username_prefix;
    }

    /**
     * @param $password string
     * set customer password_hash
     */
    public function setPassword($password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password_hash = Hash::make($password);
            if($this->exists) {
                $this->save();
            }
        } catch(\Exception $e) {
            dump($e->getMessage());
        }
    }

    /**
     * Returns whether or not this customer is active.
     * @return bool
     * @throws \Exception
     */
    public function isActive(){
        if($this->active) {
            return true;
        } else {
            Throw new \Exception('This user is not active. Therefore you cannot change the password', 409);
        }
    }

}