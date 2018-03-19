<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function execute(){
        $portfolio=Portfolio::all();

        if(view()->exists('admin.portfolio')){

            $data=[
                'title'=>'Портфолио',
                'portfolios'=>$portfolio
            ];
            return view('admin.portfolio',$data);
        }

    }
}
