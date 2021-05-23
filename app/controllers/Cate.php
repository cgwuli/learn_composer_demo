<?php
namespace controllers;

use models\Cates;
use lmonkey\CatTree as CT;
class Cate extends BaseControllers
{
    public function index()
    {
        $cate = new Cates();

        $data = $cate->select('catelist', ['id','catename','pid','oid']);

        $ntree = CT::getList($data);
       
    
        $this->assign('catelist', $ntree);
         $this->display("cate/list");
        
    }
    public function order()
    {
        // 接收所有数据
        //dd($_POST);
        $cate = new Cates();
        foreach ($_POST['id'] as $key=>$val) {
            $cate->update('catelist', ['oid'=>$val],['id'=>$key]);
        }
        $this->success("/catelist", "__排序成功__");
    }
    public function toadd()
    {
        $cate = new Cates();

        $data = $cate->select('catelist', ['id','catename','pid','oid']);

        $ntree = CT::getList($data);
       
    
        $this->assign('catelist', $ntree);
         $this->display("cate/add");
    }
    public function doadd()
    {
        $cate = new Cates();
        unset($_POST['submit']);
        
        $data = $cate->insert('catelist',$_POST);
        
        if($data->rowCount() >0 ) {
            $this->success("/catelist", "__添加成功__");
        }else {
            $this->error("/catelist", "__添加失败__");
        }
    }
    public function toupdate()
    {
       

        $cate = new Cates();

        $data = $cate->select('catelist', ['id','catename','pid','oid']);

        $ntree = CT::getList($data);
       
        // 获取一条要修改的一条语句
        $cur  =$cate->get('catelist', ['id','catename','pid','oid'], ['id'=>$_GET['id']]);

        $this->assign('cur', $cur);
        $this->assign('catelist', $ntree);
         $this->display("cate/update");
    }
    public function doupdate()
    {
        $cate = new Cates();
      
        unset($_POST['submit']);
        $id = $_POST['id'];
        unset($_POST['id']);

        // 不能修改到他的子类下
        $treeList = $cate->select('catelist', ['id','catename','pid','oid']);
        $ntree = CT::getList($treeList);
        $selftree = $ntree[$id];
        // dd(in_array($_POST['pid'], explode(",",$selftree['childs'])));
        if(in_array($_POST['pid'], explode(",",$selftree['childs']))){
            $this->success("/catelist", "__不能将分类修改到自己的子类下面__");
        }else{
            $data = $cate->update('catelist',$_POST,['id'=>$id]);
            if($data->rowCount() >0 ) {
                $this->success("/catelist", "__更新成功__");
            }else {
                $this->error("/catelist", "__更新失败__");
            }
        }
    }
    public function dodelete()
    {
       
        $id = $_GET['id'];
        $cate = new Cates();
        // 如果当前删除有子分类就禁止删除
        $treeList = $cate->select('catelist', ['id','catename','pid','oid']);
        $ntree = CT::getList($treeList);
        $selftree = $ntree[$id];
        if(!empty($selftree['childs'])){
            $this->success("/catelist", "如果当前删除有子分类就禁止删除");
        }else{
            $data = $cate->delete('catelist', ['id'=>$_GET['id']]);

            if($data->rowCount() >0 ) {
                $this->success("/catelist", "__删除成功__");
            }else {
                $this->error("/catelist", "__删除失败__");
            }
        }
       
    }
}
