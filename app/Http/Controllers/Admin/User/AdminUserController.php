<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\AdminUserRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('user_type',1)->get();
        return view('admin.user.admin-user.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request,ImageService $imageService){
        $inputs = $request->all();
        if($request->hasFile('profile_photo_path')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false){
                return redirect()->route('admin.user.admin-user.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }

        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        $adminUser = User::create($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','کاربر ادمین جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, ImageService $imageService,User $admin)
    {
        $inputs = $request->all();
        if($request->hasFile('profile_photo_path')){
            if(!empty($admin->profile_photo_path)){
                $imageService->deleteImage($admin->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false){
                return redirect()->route('admin.user.admin-user.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','کاربر ادمین شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->forceDelete();
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','کاربر ادمین شما با موفقیت حذف شد');
    }
    public function activation(User $admin){
        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();
        if($result){
                if($admin->activation == 0){
                    return response()->json(['activation' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['activation' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['activation' => false]);
        }
    }
    public function status(User $admin){
        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();
        if($result){
                if($admin->status == 0){
                    return response()->json(['status' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['status' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['status' => false]);
        }
    }
}
