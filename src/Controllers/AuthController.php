<?php

namespace Mubangizi\Controllers;

use Mubangizi\Models\User;

class AuthController extends Controller
{

    public function sign_in($view, $request)
    {
        if (get_user()->role !== ANONYMOUS) {
            $this->to('index');
        }

        list('params' => $params) = $request;

        if (array_has($params, 'sign-in-submit', 'email', 'password')) {
            list('email' => $email, 'password' => $password) = $params;

            $user = User::get_by_email($email);
            if ($user != null) {
                if (password_verify($password, $user->password)) {
                    $_SESSION['user'] = $user;
                    if ($user->role === ADMINISTRATOR) {
                        $this->to('dashboard', '?alert=sign-in-success');
                    }
                    $this->to('index', '?alert=sign-in-success');
                }
            } else {
                alert(
                    'Invalid Login Credentials',
                    'check you\'re email and password',
                    'security-announcement',
                    'danger'
                );
                form_data($request, "login-form", array('email' => $email, 'password' => $password));
            }
        }

        render($this->page, "Auth/$view", $request, 'Sign in');
    }

    public function sign_up($view, $request)
    {
        if (get_user()->role !== ANONYMOUS) {
            $this->to('index');
        }

        list('params' => $params) = $request;

        if (array_has($params, 'full-name', 'sign-up-submit', 'email', 'password')) {
            list('email' => $email, 'password' => $password) = $params;
            list(0 => $first, 1 => $last) = explode(' ', $params['full-name']);
            User::create($first, $last, password_hash($password, PASSWORD_BCRYPT), $email, '', CUSTOMER, '/public/img/profile.jpg');

            $user = User::get_by_email($email);
            if ($user != null) {
                $_SESSION['user'] = $user;
                $this->to('index', '?alert=sign-up-success');
            }

        }
        render($this->page, "Auth/$view", $request, 'Sign up');
    }

    public function recovery($view, $request)
    {
        render($this->page, "Auth/$view", $request, 'Password Recovery');
    }
}
