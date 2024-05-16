<?php
namespace App\Repositories\Admins;
use App\Models\Admins\Admin;
use Prettus\Repository\Eloquent\BaseRepository;

class AdminRepository extends BaseRepository{
    public function model(){
        return Admin::class;
    }
    public function getAll($params = [], $limit = 20){
        $params = array_merge([
            'search' => null
        ], $params);

        $result = Admin::select('*');
        
        if(!empty($params['search'])){
            $result->where('name', 'like', '%' . $params['search'] . '%');
        }
        $result->orderBy('id','desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }
    public function getById($id){
        return Admin::find($id);
    }

   
}
