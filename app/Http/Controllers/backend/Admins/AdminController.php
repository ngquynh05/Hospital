<?php

namespace App\Http\Controllers\backend\Admins;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UpdateAdminsRequest;
use App\Repositories\Admins\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;



class AdminController extends BackendController
{
    protected $data = [];
    protected $adminRepository;
    public function __construct(AdminRepository $adminRepository){
        parent::__construct();
        $this->adminRepository = $adminRepository;
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
        $this->data['user'] = Auth::guard('backend')->user();
        $this->data['params'] = $p;
        $users = $this->adminRepository->getAll($params);
        $total = $users->total();
        $perPage = !empty($users->perPage()) ? $users->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);
        $url = route('backend.admins.index') . '?' . Arr::query($p).'&';
        $offset = ($perPage * $page) - $perPage;
        $this->data['offset'] = $offset;
        $this->data['pager']= PaginationHelper::BackendPagination($total,$perPage,$page,$url);
        $this->data['users'] = $users;

        
        return view('components.backend.admins.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->data['isEdit'] = 0;
        $this->data['user'] = [];
        return view('components.backend.admins.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLoginRequest $request)
    {
        $params = $request->all();
        $params['password'] = Hash::make($params['password']);
        $this->adminRepository->create($params);
        return redirect()->route('backend.admins.index')->with('success', 'This user create successfully');
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
        $user = $this->adminRepository->getById($id);
        $this->data['user'] = $user;
        $this->data['isEdit'] = 1;
        return view('components.backend.admins.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminsRequest $request, string $id)
    {
        $params = $request->all();
        $user = $this->adminRepository->getById($id);
        $update = [
            'name' => $request->name,
            'email' => $request->email,];
        if (!empty($request->password)) {
            $update['password'] = Hash::make($request->password);
        }

        $user->update($update);
        return redirect()->route('backend.admins.index')->with('success', 'This user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $user = $this->adminRepository->getById($id);
        if($user){
            $user->delete();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'User deleted successfully'
            ]);
        }
        return response()->json([
            'status' =>'error',
            'code' => 404,
            'message' => 'User not found'
        ]);

       
    }
}
