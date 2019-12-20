<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
}

/*$product = new Product();

$product->category = 'smartphones';
$product->brand = 'samsung';
$product->model = 'Galaxy Note 10';
$product->price = 399990;
$product->colour = 'Черный';
$product->ram = 'GB';
$product->capacity = '256GB';
$product->diagonal = '6.3';
$product->screen = 'OLED';
$product->resolution = '2436×1125';
$product->os = 'Andriod One';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/9/e/9e54e55c45e4af0d0f847bc1c792e24038c84dc1_15525775474718.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/2/1/21b769e2118d45d17ee6a225d010ac59bbb9188d_15525776523294.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/f/9/f93dcabfff0df10fdc3a20915226c57d5b787ab7_15525777571870.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/8/2/825dc14febd4e6a16b801f38f4ea1a95e0c9c48a_15525779144734.jpg';
$product->description = 'HDR, Режим замедленной съёмки, Режим таймера, Режим серийной съемки, Контроль экспозиции, Панорама, Десятикратное увеличение, Геотегинг, Оптический зум 2x';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();


$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Apple';
$product->model = 'Apple iPhone 11 Pro Max';
$product->price = 614890;
$product->colour = 'Space Gray';
$product->ram = '4GB';
$product->capacity = '64GB';
$product->diagonal = '6.5';
$product->screen = 'OLED';
$product->resolution = '2688x1242';
$product->os = 'iOS 13';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/7/9/792fc4963417bcb86eaf04f01fcb437fd4f35e2f_16493424902174.jpg';
$product->description = 'Шестилинзовый объектив, Ночной режим, Эффект боке, Режим таймера, Режим серийной съемки, Контроль экспозиции, Режим замедленной съёмки, HDR, Портретный режим, Тач-фокус, Оптический зум 2x, Пятилинзовый объектив, Цифровой зум 10x, Геотегинг';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();


$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Apple';
$product->model = 'Apple iPhone 11 Pro';
$product->price = 749890;
$product->colour = 'зеленый';
$product->ram = '4GB';
$product->capacity = '512GB';
$product->diagonal = '5.8';
$product->screen = 'OLED';
$product->resolution = '1125x2436';
$product->os = 'iOS 13';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/0/f/0f91c5d8733224b9a5fc1a3b00ff3b79ffb125d5_16493064945694.jpg';
$product->description = 'Портретный режим, Оптический зум 2x, Пятилинзовый объектив, Цифровой зум 10x, Шестилинзовый объектив, Тач-фокус, Ночной режим, Эффект боке, Панорама, HDR, Геотегинг, Режим серийной съемки, Контроль экспозиции, Режим таймера, Режим замедленной съёмки';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();


$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Huawei';
$product->model = 'P30 Pro';
$product->price = 349990;
$product->colour = 'Aurora';
$product->ram = '8GB';
$product->capacity = '256GB';
$product->diagonal = '6.5';
$product->screen = 'OLED';
$product->resolution = '1125x2436';
$product->os = 'Android-9.0Pie';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/a/9/a94eb885b21298b9b8178fb06a88984a1e15b676_15274383212574.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/b/4/b4a1c4a9b3efea1eb634bd9eabb4aca46ccdd901_15274388062238.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/4/1/41c04fee94b49c1874e6f7bd568bda9d032500eb_15274429284382.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/d/8/d8ba51fc9944bf5d6035098869403d7810f31525_15274442850334.jpg';
$product->description = 'Обнаружение лица, Гибридный зум 10x, Master AI, AI HDR+, Геотегинг, Цифровой зум 50x, Панорама, Режим таймера, Режим замедленной съёмки, Тач-фокус, HUAWEI AIS, Режим серийной съемки, Оптический зум 3x, HDR';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();



$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Huawei';
$product->model = 'Mate 10';
$product->price = 219890;
$product->colour = 'Черный';
$product->ram = '6GB';
$product->capacity = '256GB';
$product->diagonal = '6';
$product->screen = 'OLED';
$product->resolution = '1080x2160';
$product->os = 'Android-8.0 Oreo';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/5/5/55a414119474ab8ef45c0b0ec483ead9bad98254_15499876007966.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/c/c/cc723014cc2149eeae1130ff9ca9ccdea0fbd65c_15499876532254.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/6/a/6a7cd348e8129176d4fe3c55817cdd9cfe70326a_15499878629406.jpg';
$product->description = 'Барометр, Считывание отпечатка пальца, Акселерометр, Освещенности, Компас, Гироскоп, Датчик приближения. Безрамочный, Смартфон с двумя SIM-картами, Лучшая камера, NFC, Смартфон с 4G';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();



$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Meizu';
$product->model = '15 Lite';
$product->price = 87990;
$product->colour = 'Черный';
$product->ram = '4GB';
$product->capacity = '64GB';
$product->diagonal = '5.5';
$product->screen = 'OLED';
$product->resolution = '1920x1080';
$product->os = 'Android-7.1-Nougat';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/a/2/a2ab3000669fde09add6f5161008d6c8135914ba_15497754968094.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/a/d/add4462fa3c31a5b73455c722ef7df324c89be31_15497755492382.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/0/1/01d58be2a61455f1013eabc93763f49fb1828c9b_15497757065246.jpg';
$product->description = 'Face Unlock, Считывание отпечатка пальца, Акселерометр, Гироскоп, Гироскоп, Смартфон с двумя SIM-картами, Смартфон с 4G';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();



$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Samsung';
$product->model = 'GalaxyS10+';
$product->price = 479990;
$product->colour = 'CeramicBlack';
$product->ram = '12GB';
$product->capacity = '1000GB';
$product->diagonal = '6.3';
$product->screen = 'OLED';
$product->resolution = 'дисплея1440x3040';
$product->os = 'Android-9.0-(Pie)';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/8/1/81cc51789df1855cf3ca0bf44f7b0e3104be4c03_15275549229086.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/c/d/cdc2efa938f03761005befc960397d34258fdb33_15275549753374.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/4/7/47e6d3e4c8fae1c3686c9d1efcfd6d241c1dc21f_15275551326238.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/b/a/ba1cb30201a89cec6bee9ca61c92e286f7a39b8b_15275551916062.jpg';
$product->description = 'Пыле- /влагозащита, NFC, Смартфон с двумя SIM-картами, Безрамочный, Двойная фронтальная камера, Тройная камера, Смартфон с большим аккумулятором, Гироскоп, Смартфон с 4G, SpO2, Компас, Датчик сердечного ритма, Считывание отпечатка пальца, Акселерометр, Барометр, Гироскоп';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();


$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Samsung';
$product->model = 'Galaxy S10e';
$product->price = 279990;
$product->colour = 'Зеленый';
$product->ram = '6GB';
$product->capacity = '128GB';
$product->diagonal = '5.8';
$product->screen = 'OLED';
$product->resolution = '1080x2280';
$product->os = 'Android 9.0 Pie';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/f/5/f54f04aaeccc187eb9c8e38848464e9a0fb25263_15275545559070.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/c/5/c5ac486936a4d41bad800f4a7f3487a8cf98ec17_15275546083358.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/5/8/585faad4e1c7831494389c88c81acbdbf470ac1d_15275547656222.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/a/4/a49c690300a0de567aa4386742ab09ed943f5653_15275548704798.jpg';
$product->description = 'Режим таймера, Обнаружение лица, Панорама, Геотегинг, Режим серийной съемки, HDR, Режим замедленной съёмки';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();


$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Samsung';
$product->model = 'Galaxy Note 9';
$product->price = 254890;
$product->colour = 'Черный';
$product->ram = '6GB';
$product->capacity = '128GB';
$product->diagonal = '6.4';
$product->screen = 'OLED';
$product->resolution = '1440x2960';
$product->os = 'Android 9.0 Pie';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/5/9/594df7be03fb46fb9441dc77188ac1c523a5256c_11890842599454.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/f/5/f5c1e3830230b3b4a0b74f77b65dfeb1bdd10897_11890843582494.jpg,https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/f/9/f9a34d95dd1aabf3273935124655362795856904_11890844958750.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/9/f/9f9aea429347d0688ec2e92cb0667f432f32c958_11890845679646.jpg';
$product->description = 'Режим серийной съемки, Геотегинг, Обнаружение улыбки, Тач-фокус, Панорама, Двухкратное увеличение, Режим замедленной съёмки';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();


$product = new Product();

$product->category = 'smartphones';
$product->brand = 'Oppo';
$product->model = 'Reno 10X Zoom';
$product->price = 349990;
$product->colour = 'Jet Black';
$product->ram = '6GB';
$product->capacity = '256GB';
$product->diagonal = '6.6';
$product->screen = 'OLED';
$product->resolution = '1080x2340';
$product->os = 'Android 9.0 Pie';
$product->image = 'https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/8/c/8caa50f3813226c6e95d6a916cabfb1dc6f85b92_15276461948958.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/4/1/41f735aa7e70a195a0bb7e21a4e4d08ad8ba210f_15276466929694.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/a/4/a41a89de7f54c5114b51850fad7c956346a1b7d3_15276481806366.jpg, https://www.technodom.kz/media/catalog/product/cache/1366e688ed42c99cd6439df4031862c6/a/5/a54bc4fd3671988d095548dd4dc22b25305fde96_15276486852638.jpg';
$product->description = 'Десятикратное увеличение, HDR, Панорама, Быстрый макияж, Режим замедленной съёмки, Двухтоновая вспышка';
$product->onsale = 'no';
$product->discount_persentage = 0;

$product->save();*/