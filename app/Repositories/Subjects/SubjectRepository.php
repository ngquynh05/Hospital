<?php
namespace App\Repositories\Subjects;
use App\Models\Subject\Subject;
use Prettus\Repository\Eloquent\BaseRepository;

class SubjectRepository extends BaseRepository{
    public function model(){
        return Subject::class;
    }
    public function getAll($params = [], $limit = 20){
        $params = array_merge([
            'search' => null
        ], $params);

        $result = Subject::select('*');
        
        if(!empty($params['search'])){
            $result->where('name', 'like', '%' . $params['search'] . '%');
        }
        $result->orderBy('id','desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }
    public function getById($id){
        return Subject::find($id);
    }

   
}
