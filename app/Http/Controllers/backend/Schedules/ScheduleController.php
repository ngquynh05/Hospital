<?php

namespace App\Http\Controllers\backend\Schedules;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Repositories\Schedules\ScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Helpers\PaginationHelper;
use App\Http\Requests\Schedules\StoreScheduleRequest;

class ScheduleController extends BackendController
{
    protected $data = [];
    protected $scheduleRepository;
    /**
     * Display a listing of the resource.
     */
    public function __construct(ScheduleRepository $scheduleRepository){
        parent::__construct();
        $this->scheduleRepository = $scheduleRepository;

    }
    public function index(Request $request)
    {
        $p = $request->all();
        $schedules = $this->scheduleRepository->getAll([]);
        $this->data['schedules'] = $schedules;
        $total = $schedules->total();
        $perPage = !empty($schedules->perPage()) ? $schedules->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.schedules.index') . '?' . Arr::query($p).'&';
        $offset = ($perPage * $page) - $perPage;
        $this->data['offset'] = $offset;
        $this->data['pager']= PaginationHelper::BackendPagination($total,$perPage,$page,$url);

        
        return view('components.backend.schedules.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.backend.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $this->scheduleRepository->create([
            'name' => $request->name
        ]);
        return redirect()->route('backend.schedules.index')->with('success','This schedule created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = $this->scheduleRepository->getById($id);
        if(!$schedule){
            return redirect()->route('backend.schedules.index')->with('error', 'lịch khám không tồn tại');
        }
        $this->data['schedule'] = $schedule;
        
        return view('components.backend.schedules.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreScheduleRequest $request, string $id)
    {
        $schedule = $this->scheduleRepository->getById($id);
        if(!$schedule){
            return redirect()->route('backend.schedules.index')->with('error', 'lịch khám không tồn tại');
        }
        $schedule->update(['name'=> $request->name]);
        return redirect()->route('backend.schedules.index')->with('success', 'This schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = $this->scheduleRepository->getById($id);
        if(!$schedule){
            return redirect()->route('backend.schedules.index')->with('error','lịch khám không tồn tại');
        }
        $schedule->delete();
        return redirect()->route('backend.schedules.index')->with('success', 'This schedule deleted successfully');
    }

    public function deleteAjax(int $id){
        $schedule = $this->scheduleRepository->getById($id);
        if(!$schedule){
            $data = [
                'message' => 'không tồn tại',
                'status' => 'fail',
                'code' => 404
            ];

        }else{
            $data = [
                'message' => 'xóa thành công',
                'status' => 'success',
                'code' => 200
            ];
            $schedule->delete();
        }
        return response()->json($data);


    }
}
