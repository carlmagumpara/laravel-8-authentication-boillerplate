<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\{ User };
use App\Http\Requests\{ UserRequest, UserUpdateRequest };
use Hash;
use App\Helpers\Utils;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        $roleId = [
            'admins' => 1,
            'staffs' => 2,
            'users' => 3,
        ];

        $data = User::withTrashed()->where(['role_id' => $roleId[$type]])->orderBy('id', 'DESC');

        if ($request->ajax() || ($request->has('search') && $request->search !== '')) {

            $searchValues = preg_split('/\s+/', $request->search, -1, PREG_SPLIT_NO_EMPTY);
        
            $searchList = User::withTrashed()->where(function ($query) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $query->orWhere('first_name', 'like', "%{$value}%");
                    $query->orWhere('last_name', 'like', "%{$value}%");
                    $query->orWhere('middle_name', 'like', "%{$value}%");
                }
            })->where(['role_id' => $roleId[$type]]);

            return view('user.list', [
                'type' => $type,
                'list' => $searchList->orderBy('id', 'DESC')->paginate(10),
            ])->render();
        }

        return view('user.index', [
            'type' => $type,
            'list' => $data->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {
        if (! empty($request->password)) {
            $request->merge([
                'photo' => asset('/images/avatars/tile'.Utils::generateRandomNumbersByRange(0, 15).'.png'),
                'is_active' => true,
                'status' => 'Pending',
                'password' => Hash::make($request->password),
            ]);
        }

        User::create($request->all());

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'User Created Successfully.',
            'success' => true,
        ], 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);

        return view('user.show', [
            'user' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if (! empty($request->password)) {
            $request->merge([
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->request->remove('password');
        }

        User::find($id)->update($request->all());

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'User Updated Successfully.',
            'success' => true,
        ], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);

        if ($user && $user->delete()) {
            return response()->json([
                'redirect_url' => redirect()->back()->getTargetUrl(),
                'message' => 'Successfully Deleted',
                'success' => true,
            ], 200);
        }

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'Theres an error deleting this item.',
            'success' => true,
        ], 200);
    }

    public function restore(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        
        $user->delete();

        if ($user && $user->restore()) {
            return response()->json([
                'redirect_url' => redirect()->back()->getTargetUrl(),
                'message' => 'Successfully Restored',
                'success' => true,
            ], 200);
        }

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'Theres an error deleting this item.',
            'success' => true,
        ], 200);
    }
}
