<?php

namespace App\Http\Controllers\admin\notify;

use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\emailRequest;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $email = Email::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index',compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.email.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request,Email $email)
    {
        $inputs = $request->all();

        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", strtotime('-1 hours'));
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $email = Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل شما با موفقیت ثبت شد');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", strtotime('-1 hours'));
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $result = $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل شما با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $result = $email->delete();
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل شما با موفقیت حذف گردید');
    }
    public function status(Email $email){

        $email->status = $email->status == 0 ? 1 : 0;
        $result = $email->save();
        if($result){
                if($email->status == 0){
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
