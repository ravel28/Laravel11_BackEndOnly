<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function index(array $query){
        $take   = $query['take'];
        $page   = $query['page'];
        $user   = User::orderby('name','asc')->paginate($take);
        $total  = User::all()->count();
        $meta   = [
            'current_page'  => $page,
            'take'          => $take,
            'total_pages'   => ceil($total/$take),
            'total_items'   => $total
        ];
        $data   = [
            'items' => $user,
            'meta'  => $meta,
        ];
        return $data;
    }

    public function checkUser(array $data){
        $username = $data['user'] ?? '';
        $inputPassword = $data['password'] ?? '';
        $checkUser = User::whereRaw('email = ?',[$username])->first();
        
        if (Hash::check($inputPassword, $checkUser->password)) {
            $result = $checkUser;
        } else {
            $result = null;
        }
        return $result;
     }
 
     public function checkUserById($id){
        $checkUser = User::whereRaw('id = ?',$id)->first();
        return $checkUser;
     }

     public function createUser(array $data) {
        $create_data = User::create([
            'name' => $data['name'], 
            'email' => $data['email'],
            'motto' => $data['motto'],
            'age' => $data['age'],
            'email_verified_at' => now(),
            'password' => $data['password'],
        ]);
        return $create_data;
     }

     public function updateUser(int $id, array $data) {
        $update_data = User::whereRaw('id = ?',$id)->update([
            'name' => $data['name'], 
            'motto' => $data['motto'],
            'age' => $data['age'],
            'password' => $data['password'],
        ]);
        return $update_data;
     }

     public function deleteUser(int $id) {
        $delete_data = User::whereRaw('id = ?',$id)->delete();
        return $delete_data;
     }
}
