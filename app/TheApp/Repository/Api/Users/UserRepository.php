<?php
namespace App\TheApp\Repository\Api\Users;

use App\TheApp\Libraries\ImgRepository;
use Illuminate\Http\Request;
use App\Models\DeviceToken;
use App\Models\Address;
use App\Models\User;
use Auth;
use Hash;
use DB;

class UserRepository
{
    protected $model;

    function __construct(User $user,Address $address,DeviceToken $token)
    {
        $this->model        = $user;
        $this->addressModel = $address;
        $this->tokenModel   = $token;
    }    

    public function checkApiToken($data)
    {
        $user = $this->model->where('api_token',$data['api_token'])->first();

        if($user)
            return true;
        
        return false;
    }

    public function login($data)
    {
        $user = Auth::attempt([
                    'email'     => $data['email'],
                    'password'  => $data['password'], 
                    'active' => 1
                ]);

        if($user)
        {
            Auth::user()->update([
                'api_token' => $this->generateApiKey()
            ]);

            return true;
        }
        
        return false;
    }

    public function checkLogin($data) 
    {
        $check = $this->model
                      ->where("id",$data['user_id'])
                      ->where("api_token",$data['api_token'])
                      ->where("active",1)
                      ->count();

        if ($check > 0) {
            Auth::loginUsingId($data['user_id']);
            return true;
        }


        return false; 
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            
            $user = $this->model->create([
                    'full_name'     => $request['full_name'],
                    'email'         => $request['email'],
                    'mobile'        => $request['mobile'],
                    'platform'      => $request['platform'],
                    'device_id'     => $request['device_id'],
                    'password'      => bcrypt($request['password']),
                    'active'        => 1,
                    'image'         => 'uploads/male.png',
                    'api_token'     => $this->generateApiKey(),
                ]);

            DB::commit();
            
            return $user;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }


    public function updateDeviceId($data)
    {
        DB::beginTransaction();

        $user = $this->findById($data['user_id']);

        try {
            
            $user->update([
                'device_id' => $data['device_id'],
            ]);


            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function deviceToken($data)
    {
        DB::beginTransaction();

        try {
            
            $user = $this->tokenModel->updateOrCreate([
                'user_id'      => $data['user_id'],
            ],
            [
                'device_token' => $data['device_token'],
                'user_id'      => $data['user_id'],
                'platform'     => $data['platform'],
            ]);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update($request)
    {
        DB::beginTransaction();

        $user = $this->findById($request['user_id']);

        try {
            
            $user->update([
                    'full_name'     => $request['full_name'],
                    'email'         => $request['email'],
                    'mobile'        => $request['mobile'],
                    'platform'      => $request['platform'],
                    'device_id'     => $request['device_id'],
            ]);


            DB::commit();
            return $user;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }


    public function updatePic($request)
    {
        DB::beginTransaction();

        $user = $this->findById($request['user_id']);

        try {
            
            $user->update([
                'image' => ImgRepository::uploadImage($request['profile_pic']),
            ]);


            DB::commit();
            return $user;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function changePassword($data)
    {
        $current_password = Auth::User()->password;

        if(Hash::check($data['old_password'] , $current_password))
        {
            Auth::user()->update([
                'password' => bcrypt($data['new_password'])
            ]);

            return true;
        }

        return false;
    }

    public function findById($userId)
    {
      $user = $this->model->find($userId);

      if (!$user) {
          return false;
      }

      return $user;
    }
    
    public function generateApiKey()
    {

      $key = str_random($length = 32);
      
      if($this->model->where('api_token' , $key)->count() == 0)
        return $key;

      $this->generateApiKey();
    }


    public function createAddress($request)
    {
        DB::beginTransaction();

        try {
            
            $user = $this->addressModel->create([
                    'province_id'  => $request['province_id'],
                    'user_id'      => $request['user_id'],
                    'block'        => $request['block'],
                    'building'     => $request['building'],
                    'note'         => $request['note'],
                    'street'       => $request['street'],
                    'address'      => $request['address'],
                ]);

            DB::commit();
            
            return $user;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function updateAddress($request)
    {
        DB::beginTransaction();

        try {

            $address = $this->addressModel
                            ->where('user_id',Auth::user()->id)
                            ->where('id',$request['address_id'])
                            ->first();

            $user = $address->update([
                'province_id'  => $request['province_id'],
                'user_id'      => $request['user_id'],
                'block'        => $request['block'],
                'building'     => $request['building'],
                'note'         => $request['note'],
                'street'       => $request['street'],
                'address'      => $request['address'],
            ]);

            DB::commit();
            
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function deleteAddress($request)
    {
        $address = $this->addressModel
                        ->where('user_id',Auth::user()->id)
                        ->where('id',$request['address_id'])
                        ->first();
                        
        return $address->delete();
    }
}