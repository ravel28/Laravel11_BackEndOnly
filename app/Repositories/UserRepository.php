<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function index(array $query) {
        try {
            $take   = $query['take'];
            $page   = $query['page'] ?? 1;
            $user   = User::orderby('divisions.id','asc')
                            ->orderby('users.name','asc')
                            ->join('divisions','users.division_id','=','divisions.id')
                            ->paginate($take);
            $total  = User::all()->count();

            if(count($user) < 1) abort(404, "User data is null or not found !");

            $meta   = [
                'current_page'  => $page,
                'take'          => $take,
                'total_pages'   => ceil($total/$take),
                'item_per_page' => count($user),
                'total_items'   => $total
            ];
            $data   = [
                'items' => $user,
                'meta'  => $meta,
            ];
            return $data;
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
    }

    public function checkUser(array $data) {
        try{
            $username       = $data['user'] ?? '';
            $inputPassword  = $data['password'] ?? '';
            $checkUser      = User::whereRaw('email = ?',[$username])
                                    ->first();
            
            
            if($checkUser){
                Hash::check($inputPassword, $checkUser->password) ? $result = $checkUser : abort(404,'Password not valid !');
            } else {
                abort(404,'Email not found !');
            }
            return $result;
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
     }
 
     public function checkUserById($id){
        try{
            $checkUser = User::whereRaw('users.id_user = ?',$id)
                                ->join('divisions','users.division_id','=','divisions.id')
                                ->first();
            if(!$checkUser) abort(404, "User data is null or not found !");
            return $checkUser;
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
     }

     public function createUser(array $data) {
        try{
            $create_data = User::create([
                'name'              => $data['name'], 
                'email'             => $data['email'],
                'motto'             => $data['motto'],
                'age'               => $data['age'],
                'division_id'       => $data['division_id'],
                'email_verified_at' => now(),
                'password'          => $data['password'],
            ]);
            return $create_data;
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
     }

     public function updateUser(int $id, array $data) {
        try{
            $update_data = User::whereRaw('id_user = ?',$id)->update([
                'name'          => $data['name'], 
                'motto'         => $data['motto'],
                'age'           => $data['age'],
                'password'      => $data['password'],
                'division_id'   => $data['division_id'],
            ]);
            
            return $update_data;
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
     }

     public function deleteUser(int $id) {
        $delete_data = User::whereRaw('id_user = ?',$id)->delete();
        return $delete_data;
     }
}
