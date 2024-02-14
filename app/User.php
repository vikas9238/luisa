<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;
use Auth;

class User extends Authenticatable
{

    use SoftDeletes;
    use Notifiable;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS = [
        self::STATUS_ACTIVE => "Active",
        self::STATUS_INACTIVE => "Inactive",
    ];
    const USER_DEVICE_TYPE_ANDROID = 'android';
    const USER_DEVICE_TYPE_IOS = 'iso';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'status',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function permissions()
    {
        return $this->hasMany('App\UserPermission', 'user_id');
    }

    /**
     * Fetch Permissions
     * 
     * @author Chandan Kumar Jha <ckchandanjha868@gmail.com>
     * @param object $request
     * @return object
     */
    public function fetchUsers($request)
    {
        $resultSets = self::get();
        return $resultSets;
    }

    public function addUser($request)
    {
        $obj = new $this;
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->username = $request->username;
        $obj->role_id = $request->role;
        $obj->password = $request->password;
        if (isset($request->branch_id)) {
            $obj->branch_id = $request->branch_id;
        }
        if (isset($request->image_file_name)) {
            $obj->image = $request->image_file_name;
        }
        $obj->save();
        return $obj;
    }

    public function updateUser($id, $request)
    {
        $obj = self::find($id);
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->username = $request->username;
        $obj->role_id = $request->role;
        if (isset($request->password)) {
            $obj->password = $request->password;
        }
        if (isset($request->branch_id)) {
            $obj->branch_id = $request->branch_id;
        }
        if (isset($request->image_file_name)) {
            $obj->image = $request->image_file_name;
        }
        $obj->save();
        return $obj;
    }

    public function updatePassword($id, $password)
    {
        $obj = self::find($id);
        $obj->password = $password;
        $obj->save();
        return $obj;
    }

    public function updateStatus($id, $status)
    {
        $obj = self::find($id);
        $obj->status = $status;
        $obj->save();
        return $obj;
    }

    public function getIsCustomerAttribute()
    {
        return $this->role->id == Role::CUSTOMER_ROLE_ID ? true : false;
    }

    public function getIsAdminAttribute()
    {
        return $this->role->id == Role::ADMIN_ROLE_ID ? true : false;
    }

    public function getIsBranchManagerAttribute()
    {
        return $this->role->id == Role::BRANCH_MANAGER_ROLE_ID ? true : false;
    }

    /**
     * This function is used to authenticate / authorize user API
     *
     * @author Chandan Kumar Jha <ckchandanjha868@gmail.com>
     * @param string $username
     * @param string $password
     * @return object User details
     */
    public function authenticateUserForApi($request)
    {
        $userData = [];
        if (
                Auth::attempt([
                    'username' => $request->username,
                    'password' => $request->password,
                    'role_id' => $request->user_type == 1 ? Role::FA_ROLE_ID : Role::CUSTOMER_ROLE_ID
                ])
        ) {
            $userData = self::where('username', $request->username)
                    ->get()
                    ->first();
        }

        return $userData;
    }

    public function findUserByUsername($username)
    {
        return self::where('username', $username)->first();
    }

    public function faListNotExistInRoute($userIds)
    {
        $resultSets = self::where('role_id', Role::FA_ROLE_ID)->whereNotIn('id', $userIds)->get();
        $data = [
            '' => 'Select FA'
        ];
        foreach ($resultSets as $resultSet) {
            $data[$resultSet->id] = $resultSet->name . '(' . $resultSet->username . ')';
        }
        return $data;
    }

    public function updateDeviceTokenByUserName($request)
    {
        $obj = self::where('username', $request->username)->first();
        $obj->device_token = $request->device_token;
        $obj->platform = $request->platform;
        $obj->last_login_time = date('Y-m-d h:i:s');
        $obj->save();
    }

    public function getFaByBranch($branchId)
    {
        $resultSets = self::where('branch_id', $branchId)->where('role_id', Role::FA_ROLE_ID)
                ->get();
        $data = [
            '' => 'All'
        ];
        foreach ($resultSets as $resultSet) {
            $data[$resultSet->id] = $resultSet->name . '(' . $resultSet->username . ')';
        }
        return $data;
    }

    public function getTransactionByDropdown($userId = 0)
    {
        $resultSets = self::where('role_id', Role::FA_ROLE_ID);
        if (isset($userId) && !empty($resultSets)) {
            $resultSets->where('id', $userId);
        }
        $resultSets = $resultSets->get();

        $data = [
            '' => 'Select Transaction By'
        ];
        foreach ($resultSets as $resultSet) {
            $data[$resultSet->id] = $resultSet->name . '(' . $resultSet->username . ')';
        }
        return $data;
    }

}
