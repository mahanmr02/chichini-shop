<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;

class CategoryValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index',compact('categoryAttribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create',compact('categoryAttribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValueRequest $request,CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value'=>$request->value,'price_increase'=>$request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value = CategoryValue::create($inputs);
        return redirect()->route('admin.market.property.value.index',$categoryAttribute->id)->with('swal-success','مقدار فرم کالای شما با موفقیت ایجاد شد.');
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
    public function edit(CategoryAttribute $categoryAttribute,CategoryValue $categoryValue)
    {
        return view('admin.market.property.value.edit',compact('categoryAttribute','categoryValue'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValueRequest $request,CategoryAttribute $categoryAttribute,CategoryValue $categoryValue)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value'=>$request->value,'price_increase'=>$request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $categoryValue->update($inputs);
        return redirect()->route('admin.market.property.value.index',$categoryAttribute->id)->with('swal-success','مقدار فرم کالای شما با موفقیت ایجاد شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $categoryAttribute,CategoryValue $categoryValue)
    {
        $result = $categoryValue->delete();
       return redirect()->route('admin.market.property.value.index',$categoryAttribute->id)->with('swal-success', 'فرم کالای شما با موفقیت حذف گردید');
    }
}
