<?php

namespace App;


use App\Enums\EnumDataSourceType;
use Laravel\Passport\HasApiTokens;

use Mockery\Exception;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


use App\Model as Model;
use Symfony\Component\HttpKernel\Tests\Controller\ContainerControllerResolverTest;

/**
 * App\User
 *
 * @property string $id
 * @property string $class_code
 * @property string $email
 * @property string|null $contact_id
 * @property string|null $password_hash
 * @property string|null $remember_token
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity[] $accounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \App\PersonContact $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePasswordHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use HasApiTokens, Authenticatable;


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
    public function contact(PersonContact $p = null)
    {
        if ($p !== null) {
            $this->contact_id = $p->id;
        }
        return $this->hasOne(PersonContact::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Entity::class)->withTimestamps();
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null)
    {

        $references = $this->morphToMany(DynamicEnumValue::class, 'object', 'object_dev')->withTimestamps();

        if ($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id, 'value_type' => $dynamic_enum_value->value_type]);
        }

        $ref_array = array();

        foreach ($references->get() as $reference) {

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }

    /**
     *
     * constructor
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        return $this;
    }


    /**
     *
     * setPassword
     *
     * @param $password string
     * @return $this
     */
    public function setPassword($password)
    {
        // TODO Password Validation
        try {
            $this->isActive();
            $this->password_hash = Hash::make($password);
            $this->save();
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        return $this;
    }


    /**
     *
     * orderAccountsByName
     *
     * @return mixed
     */
    public function orderAccountsByName()
    {
        $sorted = $this->accounts->sortBy('name');

        return $sorted;
    }

    /**
     *
     * getEmailUsername
     *
     * @return mixed
     */
    public function getEmailUsername()
    {
        $contact = PersonContact::getObjectById($this->contact_id);

        $email = Email::getObjectById($contact->email_id);

        return $email->username_prefix;
    }

    /**
     *
     * getUserByContact
     *
     * @param $contact
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getUserByContact($contact)
    {
        return User::where('contact_id', $contact->id)->first();
    }

    public static function getUserByEmail($email)
    {

        $email = Email::getEmailByAddress($email);

        if (is_object($email)) {
            $contact = PersonContact::getContactByEmail($email);
            if (is_object($contact)) {
                $user = User::getUserByContact($contact);
                if (is_object($user)) {
                    return $user;
                }
            }
        }

        return false;
    }


    /**
     *
     * hasReference
     *
     * @param $reference_key
     * @return bool
     */
    public function hasReference($reference_key)
    {
        $result = array_key_exists($reference_key, $this->references());
        return $result;
    }


    /**
     *
     * updateDev
     *
     * @param $key
     * @param $value
     * @param $de
     * @return bool
     */
    public function updateDev($key, $value, $de)
    {

        if ($this->hasReference($key)) {

            foreach ($this->devs as $dev) {

                if ($dev->dynamicenum_id === $de->id) {

                    if ($de->values[$dev->value_type] === $key) {

                        if ($dev->value === $value) {

                            return $dev;

                        } else {

                            $dev->value = $value;
                            $dev->save();
                            return $dev;

                        }

                    } else {

                        continue;

                    }
                }
            }
        }

        return false;

    }

    /**
     *
     * getFullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     *
     * getAuthIdentifierName
     *
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();

    }

    /**
     *
     * getAuthIdentifier
     *
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     *
     * getAuthPassword
     *
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     *
     * getRememberToken
     *
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        if (!empty($this->getRememberTokenName())) {
            return $this->{$this->getRememberTokenName()};
        }
    }

    /**
     *
     * setRememberToken
     *
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        if (!empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    /**
     *
     * getRememberTokenName
     *
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }

    /**
     *
     * getEmailForPasswordReset
     *
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {

    }

    /**
     *
     * sendPasswordResetNotification
     *
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {

    }

    /**
     *  validateAddress
     */
    public function validateAddress()
    {
    }


    /**
     *
     * searchByDevType
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByDevType($value)
    {

        $type = EnumDataSourceType::getKeyByValue($value);

        $result = User::join('object_dev', 'user.id', '=', 'object_dev.object_id')
            ->where('value_type', '=', $type)
            ->get();

        return $result;
    }


}
