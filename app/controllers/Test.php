<?php
namespace controllers;

use models\Users;

class Test extends BaseControllers
{
    public function index()
    {

        $user = new Users();

        $data = $user->select('fx', '*');

    
        $this->assign('userlist', $data);
        //     $this->assign(array("name"=>"mike"));
        //     // dd($this->data);
         $this->display("home");
    }
    public function hello()
    {
        echo 'this is hello fun';
    }
}
