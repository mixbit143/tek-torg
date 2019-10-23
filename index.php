<form action="" method="POST">
    <p>Введите количество камней (X):<br>
        <input type="text" name="x"/></p>
    <p>Введите количество жуков (Y): <br>
        <input type="text" name="y"/></p>
    <input type="submit" value="Готово">
</form>

<?php
/* Проверка на корректность*/
if (!empty($_POST['x']) && !empty($_POST['y'])) {
    $y = htmlentities($_POST['y']); //Жуки
    $x = htmlentities($_POST['x']); //Камни
    if (!is_numeric($y) || !is_numeric($x)) die('Введите число!');
    if ($y >= $x) die('Количество жуков больше количества камней!');
}
else {
   die('Введите количество камней и жуков<br>');
}

$i = 1;//для цикла
$interval = $x;//максимальное растояние
$startPos = 0;
$masiv = array_fill(1, $x, null); //Заполняем ячейки пустотой
$masiv[$x+1] = "end";//обозначение конца масива

while ($i<=$y){ //Заполнение масива
    $right = floor($interval/2);//свободное место справа
    $left = $interval-$right-1;//получаем свободное место слева
    $posJuke = round(($interval/2))+$startPos;//Значение масимального интервала делим на 2 и прибавляем к нему стартовую позицию
    $masiv[$posJuke] = "Juke";//заполняем точку
    $oldPos = 0; //отчка отсчета для нахождения дистанции
    $maxInterval = 0;// Максимальный интервал среди всех
    foreach ($masiv as $key => $value)
    {
        if($value){//Проверяем нахождение жука на камне
            $interval1=$key-$oldPos-1;//высчитываем интервал
            if($interval1>$maxInterval){//проверяем больше ли он максимального
                $maxInterval = $interval1;//Если да то указываем его число максимальным
                $startPos = $oldPos;//И позицию от которой она начинается
            }
            $oldPos =$key;//Обновляем значение старого ключа для интерации
        }
    }
    $interval = $maxInterval;//указываем максимальный интервал
    $i++;//Переход к следующему жуку
}
echo "X=".$x.", Y=".$y."У последнего жука свободно слева:".$left.", справа:".$right."<br>";
?>

