<?php

namespace App\Http\Controllers\backend\Subjects;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\StoreSubjectRequest;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Helpers\PaginationHelper;

class SubjectController extends BackendController
{

    protected $data = [];
    protected $subjectRepository;
    public function __construct(SubjectRepository $subjectRepository){
        parent::__construct();
        $this->subjectRepository = $subjectRepository;
        $this->data['status'] = [
            0 => 'Dịch vụ tạm ngưng',
            1 => 'Dịch vụ đang sử dụng'
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $p = $request->all();
        
        $params = [
            'search' => $request->search ?? null
        ];
        $this->data['params'] = $p;
        $subjects = $this->subjectRepository->getAll($params);
        $total = $subjects->total();
        $perPage = !empty($subjects->perPage()) ? $subjects->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);
        $url = route('backend.subjects.index') . '?' . Arr::query($p).'&';
        $offset = ($perPage * $page) - $perPage;
        $this->data['offset'] = $offset;
        $this->data['pager']= PaginationHelper::BackendPagination($total,$perPage,$page,);
        $this->data['subjects'] = $subjects;

        
        return view('components.backend.subjects.index',$this->data);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['subject'] = [];
        $this->data['isEdit'] = 0;
        return view('components.backend.subjects.create', $this->data);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        $this->subjectRepository->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description ?? null

        ]);
        return redirect()->route('backend.subjects.index')->with('success', 'This subject create successfully');

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
        $subject = $this->subjectRepository->getById($id);
        if(!$subject){
            return redirect()->route('backend.subjects.index')->with('error', 'lịch khám không tồn tại');
        }
        $this->data['subject'] = $subject;
        $this->data['isEdit'] = 1;
        return view('components.backend.subjects.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $request->all();
        $subject = $this->subjectRepository->getById($id);
        if(!$subject){
            return redirect()->route('backend.subjects.index')->with('error', 'dịch vụ không tồn tại');
        }
        $subject->update([
            'name'=> $request->name,
            'description' =>$request->description,
            'price'=> $request->price,
            'status'=> $request->status,
        ]);
        return redirect()->route('backend.subjects.index')->with('success', 'This subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = $this->subjectRepository->getById($id);
        if($subject){
            $subject->delete();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'subject deleted successfully'
            ]);
        }
        return response()->json([
            'status' =>'error',
            'code' => 404,
            'message' => 'subject not found'
        ]);
    }
}
