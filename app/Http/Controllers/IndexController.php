<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;
use App\Service;
use App\Portfolio;
use App\People;

use Mail;

use DB;

class IndexController extends Controller
{


    public function execute(Request $request){

        if($request->isMethod('post')) {

            $messages = [

                'required' => "Поле :attribute обязательно к заполнению",
                'email' => "Поле :attribute должно соответствовать email адресу"

            ];

            $this->validate($request,[

                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'

            ], $messages);



                return redirect()->route('home')->with('status', 'Email is send');




        }

        $pages= Page::all();
        $services=Service::where('id','<',20)->get();
        $peoples=People::take(3)->get();
        $portfolios  =Portfolio::get(['name','filter','images']);

        $menu=[];
        foreach ($pages as $page){
            $item=['title'=>$page->name,'alias'=>$page->alias];
            array_push($menu,$item);
        }

        $item=['title'=>'Services','alias'=>'service'];
        array_push($menu,$item);

        $item=['title'=>'Portfolio','alias'=>'Portfolio'];
        array_push($menu,$item);

        $item=['title'=>'Team','alias'=>'team'];
        array_push($menu,$item);

        $item=['title'=>'Contact','alias'=>'contact'];
        array_push($menu,$item);

        $tags=DB::table('portfolios')->distinct()->pluck('filter')->all();


        return view('site.index',
            ['menu'=>$menu,
                'pages'=>$pages,
                'services'=>$services,
                'peoples'=>$peoples,
                'portfolios'=>$portfolios,
                'tags'=>$tags
        ]);

    }
}
