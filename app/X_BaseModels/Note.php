<?php

namespace App;

use App\Model as Model;

/**
 * App\Note
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $text
 * @property string|null $noteable_id
 * @property string|null $noteable_type
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $noteable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereNoteableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereNoteableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Note extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Get all of the owning noteable models.
     */
    public function noteable()
    {
        return $this->morphTo();
    }

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "note";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }
}
