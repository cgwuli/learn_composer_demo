<?php
require('vendor/autoload.php');
require('class/catetree.php');

use NoahBuscher\Macaw\Macaw;

// Macaw::get('/', function(){
//     echo 'here is root';
// });
// Macaw::get('/(:any)', function($slug) {
//     echo 'The slug is: ' . $slug;
//   });
// Macaw::get('/index', 'controllers\Test@index');
// // Macaw::get('view/(:num)', 'Controllers\demo@view');

// 图书管理应用案例
// 显示管理界面
Macaw::get('/', 'controllers\Home@index');
// 图书管理界面
Macaw::get('/booklist', 'controllers\Book@index');
Macaw::get('/booklist/(:num)', 'controllers\Book@index');
Macaw::get('/booklist/toadd', 'controllers\Book@toadd');
Macaw::post('/booklist/doadd', 'controllers\Book@doadd');
Macaw::get('/booklist/toupdate', 'controllers\Book@toupdate');
Macaw::post('/booklist/doupdate', 'controllers\Book@doupdate');
Macaw::get('/booklist/dodelete', 'controllers\Book@dodelete');

// 分类管理界面
Macaw::get('/catelist', 'controllers\Cate@index');
Macaw::post('/catelist', 'controllers\Cate@order');
Macaw::get('/catelist/toadd', 'controllers\Cate@toadd');
Macaw::post('/catelist/doadd', 'controllers\Cate@doadd');
Macaw::get('/catelist/toupdate', 'controllers\Cate@toupdate');
Macaw::post('/catelist/doupdate', 'controllers\Cate@doupdate');
Macaw::get('/catelist/dodelete', 'controllers\Cate@dodelete');
Macaw::dispatch();