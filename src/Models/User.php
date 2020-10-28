<?php

namespace Mubangizi\Models;

use stdClass;

class User extends Entity
{
    public $role, $email, $image, $phone, $firstname, $lastname, $password;

    public function __construct(...$args)
    {
        if (sizeof($args) === 9) {
            $this->firstname = $args[1];
            $this->lastname = $args[2];
            $this->password = $args[3];
            $this->email = $args[4];
            $this->phone = $args[5];
            $this->image = $args[7];
        }
        $this->role = isset($args[6]) ? $args[6] : ANONYMOUS;
        parent::__construct('User', isset($args[0]) ? $args[0] : null);
    }

    public static function map(stdClass $user): User
    {
        return new User(
            $user->id,
            $user->firstname,
            $user->lastname,
            $user->password,
            $user->email,
            $user->phone,
            $user->role,
            $user->image
        );
    }

    public static function create($firstname, $lastname, $password, $email, $phone = '', $role = CUSTOMER, $image = '')
    {
        return (new User)->insert(array(
            'role' => "'$role'",
            'email' => "'$email'",
            'image' => "'$image'",
            'phone' => "'$phone'",
            'firstname' => "'$firstname'",
            'lastname' => "'$lastname'",
            'password' => "'$password'"
        ));
    }

    public function full_name()
    {
        return "$this->firstname $this->lastname";
    }

    public static function get_by_email($email)
    {
        $result = self::query("SELECT * FROM user WHERE email = '$email';");
        return !isset($result[0]) ? null : self::map($result[0]);
    }

    /**
     * @return User[]
     */
    public function all()
    {
        return parent::all();
    }

}
