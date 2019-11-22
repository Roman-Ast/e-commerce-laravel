<?php


$product = new Smartphone();

$product->category = 'smartphone';
$product->brand = 'samsung';
$product->model = 'Galaxy A50';
$product->price = 119790;
$product->colour = 'red';
$product->ram = '4Gb';
$product->capacity = '64Gb';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/f/c/fc2a17a5e6b8d6a1f890f126e364f7718213ce6d_15307304108062.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/9/3/9361c4b57f89a7c33f2e105d661132421fb1376a_15307305156638.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/3/a/3acb3e6d9ff221ec6f036d31e47fc06c3c7fef30_15307306205214.jpg';
$product->description = 'Датчик Холла, Акселерометр, Магнитный сенсор, Датчик приближения, Гироскоп, Освещенности, Считывание отпечатка пальца, Тройная камера, Смартфон с 4G, Смартфон с большим аккумулятором';

$product->save();