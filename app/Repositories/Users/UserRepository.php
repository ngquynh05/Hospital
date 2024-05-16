<?php
namespace App\Repositories\Users;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Users\User;
class UserRepository extends BaseRepository{
    
    public function model(){
        return User::class;
    }


}