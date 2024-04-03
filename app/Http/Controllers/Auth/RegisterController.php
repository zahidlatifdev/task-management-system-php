<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255', 'nullable'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'nullable'],
        'username' => ['required', 'string', 'max:255', 'unique:users', 'nullable'],
        'password' => ['required', 'string', 'min:8', 'confirmed', 'nullable'],
        'type' => ['required', 'string', 'in:individual,organization'],
    ]);
}

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
        ]);

        $user->save();

        if ($data['type'] === 'organization') {
            $organization = Organization::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'created_by' => $user->id,
            ]);

            $user->organization_id = $organization->id;
            $user->save();
        }

        return $user;
    }

}
