<?php
namespace App\Http\Controllers;

use App\Models\productModel;
use Illuminate\Http\Request;
class QRCodeController extends Controller
{
    public function list(){
        $data['getRecord']=productModel::get();
        return view('admin.qrcode.list',$data); 
    }
    public function add_qrcode(){
        return view('admin.qrcode.add');
    }
    public function store_qrcode(Request $request){
        $number = mt_rand(100000, 999999);
        $save=new productModel;
        $save->title=trim($request->title);
        $save->price=trim($request->price);
        $save->description=trim($request->description);
        $save->product_code=$number;
        $save->save();
        return redirect('/admin/qrcode')->with('success','Product Added Successfully');
    }
    public function qrcode_edit($id){
        $data['getRecord']=productModel::find($id);
        return view('admin.qrcode.edit',$data);
    }
    public function qrcode_update($id, Request $request){
        $number = mt_rand(100000, 999999);
        $save=productModel::find($id);
        $save->title=trim($request->title);
        $save->price=trim($request->price);
        $save->product_code=$number;
        $save->description=trim($request->description);
        $save->save();
        return redirect('/admin/qrcode')->with('success','Product Updated Successfully');
    }
    public function qrcode_delete($id){
        $delete=productModel::find($id);
        $delete->delete();
        return redirect('/admin/qrcode')->with('success','Product Deleted Successfully');
    }
}