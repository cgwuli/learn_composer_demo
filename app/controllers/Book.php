<?php
namespace controllers;

use Intervention\Image\ImageManagerStatic as Image;
use JasonGrimes\Paginator;
use lmonkey\CatTree as CT;
use models\Books;
use Slince\Upload\UploadHandlerBuilder as UF;

class Book extends BaseControllers
{
    public function index($num = 1)
    {
        $book = new Books();

        $data = $book->select('catelist', ['id', 'bookname', 'pid', 'oid']);

        $ntree = CT::getList($data);

        $totalItems = $book->count('booklist');
        $itemsPerPage = 1;
        $currentPage = $num;
        $urlPattern = '/booklist/(:num)';

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

        $this->assign('fpage', $paginator);
        $start = ($currentPage - 1) * $itemsPerPage;
        $booklist = $book->select('booklist', '*', ['LIMIT' => [$start, $itemsPerPage]]);
        $this->assign('booklist', $booklist);
        $this->assign('catelist', $ntree);
        $this->display("book/list");

    }

    public function toadd()
    {
        $cate = new Books();

        $data = $cate->select('catelist', ['id', 'catename', 'pid', 'oid']);

        $ntree = CT::getList($data);

        $this->assign('catelist', $ntree);
        $this->display("book/add");
    }
    public function doadd()
    {
        $book = new Books();
        unset($_POST['submit']);

        // 上传路径
        $path = dirname(dirname(__DIR__)) . "/uploads";

        $builder = new UF(); //create a builder.

        $handler = $builder
        //add constraints

            ->allowExtensions(['jpg', 'png'])
            ->allowMimeTypes(['image/*'])
            ->saveTo($path) //save to local
            ->getHandler();

        $files = $handler->handle();

        $filename = $files['filename']->getUploadedFile()->getClientOriginalName(); // original name

        // 图像处理加水印
        // open an image file
        Image::configure(array('driver' => 'imagick'));
        $img = Image::make($path . '/' . $filename);

        // resize image instance
        $img->resize(320, 240);

        // insert a watermark
        $img->insert($path . '/' . 'watermark.png');

        // save image in desired format
        $img->save($path . '/pre_' . $filename);

        $_POST['filename'] = 'pre_' . $filename;

        // 提交到数据库
        $data = $book->insert('booklist', $_POST);

        if ($data->rowCount() > 0) {
            $this->success("/booklist", "__添加成功__");
        } else {
            $this->error("/booklist", "__添加失败__");
        }
    }
    public function toupdate()
    {

        $book = new Books();

        $data = $book->select('booklist', ['id', 'bookname', 'pid', 'oid']);

        $ntree = CT::getList($data);

        // 获取一条要修改的一条语句
        $cur = $book->get('booklist', ['id', 'bookname', 'pid', 'oid'], ['id' => $_GET['id']]);

        $this->assign('cur', $cur);
        $this->assign('booklist', $ntree);
        $this->display("book/update");
    }
    public function doupdate()
    {
        $book = new Books();

        unset($_POST['submit']);
        $id = $_POST['id'];
        unset($_POST['id']);

        // 不能修改到他的子类下
        $treeList = $book->select('booklist', ['id', 'bookname', 'pid', 'oid']);
        $ntree = CT::getList($treeList);
        $selftree = $ntree[$id];
        // dd(in_array($_POST['pid'], explode(",",$selftree['childs'])));
        if (in_array($_POST['pid'], explode(",", $selftree['childs']))) {
            $this->success("/booklist", "__不能将分类修改到自己的子类下面__");
        } else {
            $data = $book->update('booklist', $_POST, ['id' => $id]);
            if ($data->rowCount() > 0) {
                $this->success("/booklist", "__更新成功__");
            } else {
                $this->error("/booklist", "__更新失败__");
            }
        }
    }
    public function dodelete()
    {

        $id = $_GET['id'];
        $book = new Books();
        // 如果当前删除有子分类就禁止删除
        $treeList = $book->select('booklist', ['id', 'bookname', 'pid', 'oid']);
        $ntree = CT::getList($treeList);
        $selftree = $ntree[$id];
        if (!empty($selftree['childs'])) {
            $this->success("/booklist", "如果当前删除有子分类就禁止删除");
        } else {
            $data = $book->delete('booklist', ['id' => $_GET['id']]);

            if ($data->rowCount() > 0) {
                $this->success("/booklist", "__删除成功__");
            } else {
                $this->error("/booklist", "__删除失败__");
            }
        }

    }
}
