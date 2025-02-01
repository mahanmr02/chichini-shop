<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\CustomerUserRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerUsers = User::where('user_type',0)->get();
        return view('admin.user.customer-user.index',compact('customerUsers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer-user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerUserRequest $request,User $user,ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('profile_photo_path')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false){
                return redirect()->route('admin.user.customer-user.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }

        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        $user = User::create($inputs);
        $details = [
            'message'=>'یک کاربر جدید در سایت ثبت گردید!'
        ];
        $adminUser = User::find(1);
        $adminUser->notify(new NewUserRegistered($details));    
        return redirect()->route('admin.user.customer-user.index')->with('swal-success','کاربر مشتری جدید شما با موفقیت ثبت شد');
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
    public function edit(User $customer)
    {
        return view('admin.user.customer-user.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUserRequest $request, ImageService $imageService,User $customer)
    {
        $inputs = $request->all();
        if($request->hasFile('profile_photo_path')){
            if(!empty($customer->profile_photo_path)){
                $imageService->deleteImage($customer->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user');
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false){
                return redirect()->route('admin.user.customer-user.index')->with('swal-error','آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $customer->update($inputs);
        return redirect()->route('admin.user.customer-user.index')->with('swal-success','کاربر مشتری شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer)
    {
        $customer->forceDelete();
        return redirect()->route('admin.user.customer-user.index')->with('swal-success','کاربر مشتری شما با موفقیت حذف شد');
    }
    public function activation(User $customerUser){
        $customerUser->activation = $customerUser->activation == 0 ? 1 : 0;
        $result = $customerUser->save();
        if($result){
                if($customerUser->activation == 0){
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
    public function status(User $customerUser){
        $customerUser->status = $customerUser->status == 0 ? 1 : 0;
        $result = $customerUser->save();
        if($result){
                if($customerUser->status == 0){
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
