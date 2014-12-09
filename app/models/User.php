<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * User model.
 */
class User extends Eloquent implements UserInterface
{
    use Illuminate\Auth\UserTrait;

    protected static $user;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'updated_at');

    /**
     * Grab the ID attribute.
     *
     * @param integer $value ID value.
     *
     * @return integer
     */
    public function getIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Validate the API key.
     *
     * @param string  $api_key Users API key.
     * @param integer $user_id Users ID.
     *
     * @return boolean|object
     */
    public static function validAPIKey($api_key, $user_id)
    {
        try {
            $user = self::where('id', $user_id)
                ->where('api_key', $api_key)
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return false;
        }

        Auth::loginUsingId($user->id);

        // Return the users data
        return true;
    }
}
