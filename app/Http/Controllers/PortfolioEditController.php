<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use Validator;
class PortfolioEditController extends Controller
{
    protected function execute(Portfolio $portfolio,Request $request){

        $opt=$portfolio->toArray();

        if($request->isMethod('delete')){

            $portfolio->delete();
            return redirect( 'admin/portfolios')->with('status','Запись удалена');
        }

        if($request->isMethod('post')){
            $input=$request->except('_token');

            $messages=[
                'required'=>'Поле :attribute обязательно к заполнению',
            ];

            $validator=Validator::make($input,[
                'name'=>'required|max:255',
                'filter'=>'required|max:20',
            ],$messages);

            if($validator->fails()){

                return redirect()->route('portfolioEdit',['portfolio'=>$input['id']])->withErrors($validator)->withInput();

            }

            if($request->hasFile('images')){

                $file=$request->file('images');
                $input['images']=$file->getClientOriginalName();
                $file->move(public_path('assets/img'),$input['images']);

            }else{
                $input['images']=$input['old_images'];
            }

            $portfolio->update( $input);

            if($portfolio->save()){
                return redirect()->route('portfolio')->with(['status'=>'Запись редактированая']);

            }


        }

        if(view()->exists('admin.portfolios_edit')){
            $data=[
                'title'=>'Редактирование страницы',
                'data'=>$opt
            ];
            return view('admin.portfolios_edit',$data);
        }
    }
}
