<?php
namespace App\Repositories\Schedules;

use App\Models\Schedules\Schedules;
use Prettus\Repository\Eloquent\BaseRepository;

class ScheduleRepository extends BaseRepository{
    public function model(){
        return Schedules::class;
    }
    public function getAll($params = [], $limit = 20 ){
        $params = array_merge([],$params);
        $result = Schedules::select('*');
        $result->orderBy('id','desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }
    public function getById($id){
        return Schedules::find($id);
    }

}