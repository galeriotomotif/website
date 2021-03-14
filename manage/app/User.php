<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'npk', 'password', 'avatar',
    ];

    protected $with = [
        // 'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createData($request)
    {
        $data = new self;
        $data->fill($request->all());
        $data->password = Hash::make($request->password);
        $data->save();

        $data->syncRoles($request->roles);

        return $data;
    }

    public static function updateData($user, $request)
    {
        $data = $user;
        $data->fill($request->except(['password']));

        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->save();

        $data->syncRoles($request->roles);

        return $data;
    }

    public static function register($request)
    {
        $data = new self;
        $data->fill($request->all());
        $data->password = Hash::make($request->password);
        $data->save();

        $data->syncRoles(['user']);

        return $data;
    }

    public static function deleteData($data)
    {
        return $data->delete();
    }

    public static function datatables()
    {
        return self::select('*');
    }
}
