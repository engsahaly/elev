<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserStatuses;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Services\UploadService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    const DIRECTORY = 'dashboard.users';    
    private $uploadService;

    function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
        $this->middleware('check_permission:list_users')->only(['index', 'getData']);
        $this->middleware('check_permission:add_users')->only(['create', 'store']);
        $this->middleware('check_permission:show_users')->only(['show']);
        $this->middleware('check_permission:edit_users')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_users')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData($request->all());
        $nationalities = Nationality::all();
        return view(self::DIRECTORY.".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Get data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($data)
    {
        $order       = $data['order'] ?? 'created_at';
        $sort        = $data['sort'] ?? 'desc';
        $perpage     = $data['perpage'] ?? \config('app.paginate');
        $start       = $data['start'] ?? null;
        $end         = $data['end'] ?? null;
        $word        = $data['word'] ?? null;
        $status      = $data['status'] ?? null;
        $nationality = $data['nationality'] ?? null;

        $data = User::with(['approvedContracts', 'contracts'])
        ->when($status != null, function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->when($nationality != null, function ($q) use ($nationality) {
            $q->where('nationality_id', $nationality);
        })
        ->when($word != null, function ($q) use ($word) {
            $q->where('name', 'like', '%'.$word.'%')
            ->orWhere('id_number', 'like', '%'.$word.'%')
            ->orWhere('phone1', 'like', '%'.$word.'%')
            ->orWhere('phone2', 'like', '%'.$word.'%')
            ->orWhere('address', 'like', '%'.$word.'%')
            ->orWhere('payment_number', 'like', '%'.$word.'%');
        })
        ->when($start != null, function ($q) use ($start) {
            $q->whereDate('created_at', '>=', $start);
        })
        ->when($end != null, function ($q) use ($end) {
            $q->whereDate('created_at', '<=', $end);
        })
        ->orderby($order, $sort)->paginate($perpage);

        return \get_defined_vars();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activeNationalities = Nationality::active()->get();
        return view(self::DIRECTORY.".create", get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $request->boolean('status') ? UserStatuses::ACTIVE->value : UserStatuses::INACTIVE->value ;
        foreach (User::UPLOADFIELDS as $field) {
            $data[$field] = isset($data[$field]) ? $this->uploadService->saveOriginalImage($data[$field], User::UPLOADPATH) : null;
        }
        User::create($data);
        return response()->json(['success'=>__('messages.sent')]);
    }

    /**
     * Store new user from contract.
     *
     * @param  \Illuminate\Http\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromContract(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = config('app.default_password') ;
        foreach (User::UPLOADFIELDS as $field) {
            $data[$field] = isset($data[$field]) ? $this->uploadService->saveOriginalImage($data[$field], User::UPLOADPATH) : null;
        }
        $user = User::create($data);
        return response()->json(['success'=>__('messages.new_user_added_msg'), 'user_id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view(self::DIRECTORY.".show", \get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $activeNationalities = Nationality::active()->get();
        return view(self::DIRECTORY.".edit", \get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();   
        if($data['password'] == null) unset($data['password']);
        $data['status'] = $request->boolean('status') ? UserStatuses::ACTIVE->value : UserStatuses::INACTIVE->value ;
        foreach (User::UPLOADFIELDS as $field) {
            if (isset($data[$field])) {
                $data[$field] = $this->uploadService->saveOriginalImage($data[$field], User::UPLOADPATH, $user->id_image);
            }
        }
        $user->update($data);
        return response()->json(['success'=>__('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->uploadService->deleteImage($user->id_image);
        $user->delete();
        return response()->json(['success'=>__('messages.deleted')]);
    }

    /**
     * Get User details.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        $id_number = $request->input('id_number');
        $user = User::with('contracts', 'approvedContracts')->where('id_number', $id_number)->first();
        if (!$user) return response()->json(['failed'=>__('messages.no_user_found')]);
        if ($user->status == UserStatuses::INACTIVE) return response()->json(['failed'=>__('messages.user_not-active')]);
        return response()->json(['success'=>$user]);
    }

    /**
     * Get User Or create new one in contract creation & updating details.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserFromContract(Request $request)
    {
        $id_number = $request->input('id_number');
        $user = User::with('contracts', 'approvedContracts')->where('id_number', $id_number)->first();
        if (!$user) return response()->json(['failedAndCreate'=>__('messages.no_user_found')]);
        if ($user->status == UserStatuses::INACTIVE) return response()->json(['failed'=>__('messages.user_not-active')]);
        return response()->json(['success'=>$user]);
    }
}
