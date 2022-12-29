<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Enums\UserStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    const DIRECTORY = 'dashboard.users';    

    function __construct()
    {
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

        $data = User::relative()
        ->when($status != null, function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->when($word != null, function ($q) use ($word) {
            $q->where('name', 'like', '%'.$word.'%')
            ->orWhere('email', 'like', '%'.$word.'%');
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
        $admins = Admin::admin()->get();
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
        $data['admin_id'] = $request->has('admin_id') ? $request->admin_id : Auth::guard('admin')->user()->id ;
        User::create($data);
        return response()->json(['success'=>__('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->check($user);
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
        $this->check($user);
        $admins = Admin::admin()->get();
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
        $data['status'] = $request->boolean('status') ? UserStatuses::ACTIVE->value : UserStatuses::INACTIVE->value ;
        $data['admin_id'] = $request->has('admin_id') ? $request->admin_id : Auth::guard('admin')->user()->id ;
        if($data['password'] == null) unset($data['password']);
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
        $this->check($user);
        $user->delete();
        return response()->json(['success'=>__('messages.deleted')]);
    }

    /**
     * Check Authorization
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function check(User $user)
    {
        if (!super_admin_permission() && $user->admin_id != Auth::guard('admin')->user()->id) abort(403);
    }
    
    /**
     * Actions Logic
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function actions(User $user, $action)
    {
        $this->check($user);
        return view(self::DIRECTORY.".".$action, \get_defined_vars());
    }
}
