<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use App\Models\Company;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'password',
        'remember_token',
        'country_code',
        'profile_image',
        'provider_type',
        'socket_id',
        'fcm_id',
        'apn_token',
        'email_verified_at',
        'email_verified_status',
        'phone_verified_at',
        'phone_verified_status',
        'user_status',
        'title',
        'added_by',
        'company_name'
    ];

    protected $appends = ['profile_image_url'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfileImageUrlAttribute()
    {
        try{
            return ($this->attributes['profile_image'] ? \Storage::url('profile-image/'.$this->attributes['profile_image']) : 'profile');
        }catch(\Exception $ex){
            return "error";
        }
    }


    public function roles()
    {
        return $this->belongsToMany(Roles::class,'user_roles', 'user_id', 'role_id');
    }

    public function user_role(){
        return $this->belongsToMany(Roles::class,'user_roles', 'user_id', 'role_id');
        
    }

    public function companies() {
        return $this->belongsToMany(Company::class, 'assign_admin_to_companies', 'user_id', 'company_id');
    }


    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                 abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
             abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('key', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('key', $role)->first();
    }


    public static function addCustomer($data,$role){

        $user               = new User();
        if($data->has('first_name') && $data->first_name){
            $user->first_name = $data->first_name;
        }
        if($data->has('last_name') && $data->last_name){
            $user->last_name = $data->last_name;
        }
        if($data->has('name') && $data->name){
            $user->name = $data->name;
        }
        if($data->has('password') && $data->password){
            $user->password = Hash::make($data->password);
        }
        if($data->has('email') && $data->email){
            $user->email = $data->email;
        }
        if($data->has('phone_number') && $data->phone_number){
            $user->phone = $data->phone_number;
        }
        if($data->has('country_code') && $data->country_code){
            $user->country_code = $data->country_code;
        }
        if($data->has('profile_image') && $data->profile_image){
            $user->profile_image = $data->profile_image;
        }
        if($data->has('added_by') && $data->added_by){
            $user->added_by = $data->added_by;
        }
        if($data->has('gst_number') && $data->gst_number){
            $user->gst_number = $data->gst_number;
        }
        if($data->has('pan_number') && $data->pan_number){
            $user->pan_number = $data->pan_number;
        }
        if($data->has('company_name') && $data->company_name){
            $user->company_name = $data->company_name;
        }
        if($data->has('country') && $data->country){
            $user->country = $data->country;
        }
        if($data->has('state') && $data->state){
            $user->state = $data->state;
        }
        if($data->has('landline') && $data->landline){
            $user->landline = $data->landline;
        }
        if($data->has('city') && $data->city){
            $user->city = $data->city;
        }
        if($data->has('zipcode') && $data->zipcode){
            $user->zipcode = $data->zipcode;
        }
        if($data->has('street_address') && $data->street_address){
            $user->street_address = $data->street_address;
        }
        $user->user_status  = 1;
         if($user->save()){
            $role = Roles::where('key',$role)->first();
            if(!$user->hasRole($role)){
                $user->roles()->attach($role);
            }
        }
        return $user;
    }

    public static function updateCustomer($data,$role){

            $user = User::where('id',$data->user_id)->first() ?? new User();
            if($data->has('first_name') && $data->first_name){
                $user->first_name = $data->first_name;
            }
            if($data->has('last_name') && $data->last_name){
                $user->last_name = $data->last_name;
            }
            if($data->has('name') && $data->name){
                $user->name = $data->name;
            }
            if($data->has('password') && $data->password){
                $user->password = Hash::make($data->password);
            }
            if($data->has('email') && $data->email){
                $user->email = $data->email;
            }
            if($data->has('phone_number') && $data->phone_number){
                $user->phone = $data->phone_number;
            }
            if($data->has('country_code') && $data->country_code){
                $user->country_code = $data->country_code;
            }
            if($data->has('profile_image') && $data->profile_image){
                $user->profile_image = $data->profile_image;
            }
            if($data->has('added_by') && $data->added_by){
                $user->added_by = $data->added_by;
            }
            if($data->has('gst_number') && $data->gst_number){
                $user->gst_number = $data->gst_number;
            }
            if($data->has('pan_number') && $data->pan_number){
                $user->pan_number = $data->pan_number;
            }
            if($data->has('company_name') && $data->company_name){
                $user->company_name = $data->company_name;
            }
            if($data->has('country') && $data->country){
                $user->country = $data->country;
            }
            if($data->has('state') && $data->state){
                $user->state = $data->state;
            }
            if($data->has('landline') && $data->landline){
                $user->landline = $data->landline;
            }
            if($data->has('city') && $data->city){
                $user->city = $data->city;
            }
            if($data->has('zipcode') && $data->zipcode){
                $user->zipcode = $data->zipcode;
            }
            if($data->has('street_address') && $data->street_address){
                $user->street_address = $data->street_address;
            }
            $user->user_status  = 1;
            if($user->save()){
                $role = Roles::where('key',$role)->first();
                if(!$user->hasRole($role)){
                    $user->roles()->attach($role);
                }
            }

        return $user;
    }
    

    public static function deleteUser($user_id){

      $user = User::where('id',$user_id)->update(['user_status' => config('constant.STATUS.DELETED')]);
      return true;
    }

    public static function updateVerification($request,$user_id){
        
        $check_email = EmailOtpVerifications::where('email',$request->email)->first();
        $user        = User::where('id',$user_id)->first();
        if($check_email){
            $user->email_verified_at = $check_email->verified_status ? $check_email->updated_at : null;
            $user->email_verified_status =  $check_email->verified_status;
            $check_email->user_id = $user_id;
            $check_email->save();
        }

        $check_otp  = MobileOtpVerifications::where('country_code',(int)$request->country_code)
                                           ->where('phone',(int)$request->phone)
                                           ->first();
        if($check_otp){
            $user->phone_verified_at = $check_otp->verified_status ? $check_otp->updated_at : null;
            $user->phone_verified_status = $check_otp->verified_status;
            $check_otp->user_id = $user_id;
            $check_otp->save();
        }
        if($check_otp || $check_email){
          $user->save();
        }
    }
    

    
}
