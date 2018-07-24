<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //questo metodo mapperà la vie 'about'
    protected $data = [
        [
            'name'=>"Frank", 'lastname'=>'Leto'
        ],
        [
            'name'=>"James", 'lastname'=>'Bond'
        ],
        [
            'name'=>"Carl", 'lastname'=>'Pippo'
        ]
    ];
    public function about(){
        return view('about');
    }

    public function blog(){

        return view('blog')
            ->with('title','MyBlog');
    }

    public function staff(){

/*        return view('staff',
            [
                'title'=>'Our staff',
                'staff'=>$this->data
            ]
        );
*/        
/*
    return view('staff')
        ->with('staff', $this->data)
        ->with('title','Our STAFF');
*/
/*        
        return view('staff')
            ->withStaff($this->data)
            ->withTitle('Our StaFF');

            //metodo magico php, assegna il name direttamente nel with
*/
        $title ='Nostro staff';
        $staff=$this->data;
        return view('staffb',compact('title','staff'));
        //cerca e assegna le variabili dichiarate nel compact
    }
}
