<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        return view('users');
    }

    /**
     * Show User List
     *
     * @param Request $request
     * @return mixed
     */
    public function getUserList(Request $request): mixed
    {
        $data = User::get();
        $hasManageUser = Auth::user()->can('manage_user');

        return Datatables::of($data)
            ->addColumn('roles', function ($data) {
                $roles = $data->getRoleNames()->toArray();
                $badge = '';
                if ($roles) {
                    $badge = implode(' , ', $roles);
                }

                return $badge;
            })
            ->addColumn('permissions', function ($data) {
                $roles = $data->getAllPermissions();
                $badges = '';
                foreach ($roles as $key => $role) {
                    $badges .= '<span class="badge badge-dark m-1">' . $role->name . '</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) use ($hasManageUser) {
                $output = '';
                if ($data->name == 'Super Admin') {
                    return '';
                }
                if ($hasManageUser) {
                    $output = '<div class="table-actions">
                                <a href="' . url('user/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a class="delete-link" href="' . url('user/delete/' . $data->id) . '" id="delete-link"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                }

                return $output;
            })
            ->rawColumns(['roles', 'permissions', 'action'])
            ->make(true);
    }

    /**
     * User Create
     *
     * @return mixed
     */
    public function create(): mixed
    {
        try {
            $roles = Role::pluck('name', 'id');

            return view('create-user', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store User
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        try {
            // store user information
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($user) {
                // assign new role to the user
                $user->syncRoles($request->role);

                return redirect('users')->with('success', 'New user created!');
            }

            return redirect('users')->with('error', 'Failed to create new user! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Edit User
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id): mixed
    {

        // Check if the authenticated user has the permission to edit any user profile
        if (Auth::user()->can('edit_any_profile')) {
            try {
                $user = User::with('roles', 'permissions')->find($id);

                if ($user) {
                    $user_role = $user->roles->first();
                    $roles = Role::pluck('name', 'id');

                    return view('user-edit', compact('user', 'user_role', 'roles'));
                }

                return redirect('404');
            } catch (\Exception $e) {
                $bug = $e->getMessage();

                return redirect()->back()->with('error', $bug);
            }
        } else {
            // The user can only edit their own profile
            if ($id != Auth::id()) {
                // Unauthorized attempt to edit another user's profile
                abort(403, 'Unauthorized');
            } else {
                try {
                    $user = User::with('roles', 'permissions')->find($id);

                    if ($user) {
                        $user_role = $user->roles->first();
                        $roles = Role::pluck('name', 'id');

                        return view('user-edit', compact('user', 'user_role', 'roles'));
                    }

                    return redirect('404');
                } catch (\Exception $e) {
                    $bug = $e->getMessage();

                    return redirect()->back()->with('error', $bug);
                }
            }
        }

    }

    /**
     * Update User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::find($request->id);
        // update user info
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required | string ',
            'email' => 'required | email',
            'role' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'whatsapp' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'date|required',
            'tinggal_dimana' => 'required',
            'other_tinggal_dimana' => 'required_if:tinggal_dimana,Lainnya',
        ]);

        // check validation for password match
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed',
            ]);
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                // Delete the old profile image
                @unlink(public_path('uploads/user-image/' . $user->profile_image));
            }

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->messages()->first());
            }

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user-image/'), $imageName);

            // Update the user's profile image
            $user = Auth::user();
            $user->profile_image = $imageName;
            $user->save();
        }
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($user = User::find($request->id)) {
                $payload = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'profile_image' => $user->profile_image,
                    'whatsapp' => $request->whatsapp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'tinggal_dimana' => $request->tinggal_dimana,
                    'other_tinggal_dimana' => $request->other_tinggal_dimana,
                ];

                // update password if user input a new password
                if (isset($request->password) && $request->password) {
                    $payload['password'] = $request->password;
                }

                $update = $user->update($payload);
                // sync user role
                $user->syncRoles($request->role);
                $user->update(['profile_complete' => true]);
                return redirect()->back()->with('success-go-dashboard', 'Informasi Kamu berhasil di update!');
            }

            return redirect()->back()->with('error', 'Failed to update user! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Delete User
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        if ($user = User::find($id)) {
            $user->delete();

            return redirect('users')->with('success', 'User removed!');
        }

        return redirect('users')->with('error', 'User not found');
    }
}
