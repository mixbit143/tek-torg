<?php
$y = 3; //Жуки
$x = 8; //Камни
$i = 0;//для цикла
$left = 0;
$right =0;
$masiv = array_fill(1, $x, null); //Заполняем ячейки пустотой

function Proverka() //Проверка свободного места слева и справа от масива, и создание глобальной переменной
{
    global $masiv, $left, $right, $endStone;
    for($a=1;$a<=count($masiv);$a++){
        if($masiv[$a]){
             $left = $a - 1;
            break;
        }
    }
    for($b=count($masiv);$b>=1;$b--){
        if($masiv[$b]) {
            $endStone = $b; //Номер последней ячейки с жуком
            $right =count($masiv) - $b;
            break;
        }
    }
}

while ($i!=$y){ //Заполнение масива
    $stone = round($x/2);//заполнение первого камня
    if(!$masiv[$stone]){ //Если камень в центре есть, переходим дальше
        $masiv[$stone] = "Juke";
    }
    else
    {
        Proverka();//Запуск проверки свободного места
        if($left>=$right){  // Если места слева больше или равно, чем место справа, то выполняем заполнение по левой части масива
            $stone = round($left/2); //Делим количество свободного места на 2
            $masiv[$stone] = "Juke";
        }
        else{
            $stone = round(($right/2)+$endStone);//Делим количество свободного места на 2 прибавляем занчение к последней заполненой ячейке
            $masiv[$stone] = "Juke";
        }
    }
    $i++;
}

echo "последняя заполненая ячейка:".$stone."<br>";
for($a=$stone+1;$a<=count($masiv);$a++){
    if(!$masiv[$a]) $rightstone++;
    else break;
}

for($b=$stone-1;$b>=1;$b--){
    if(!$masiv[$b]) $leftstone++;
    else break;
}

echo "X=".$x.", Y=".$y."(".($leftstone).", ".$rightstone.")<br>";
print_r($masiv);
?>

