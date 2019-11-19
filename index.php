<?php

$数据 = json_decode(file_get_contents('./data.json'), true);
$名人名言 = $数据['famous']; //a 代表前面垫话，b代表后面垫话
$前面废话 = $数据['after'];//在名人名言前面弄点废话
$后面废话 = $数据['before'];//在名人名言后面弄点废话
$主要废话 = $数据['bosh'];//代表文章主要废话来源

function 另起一段() 
{
    $xx = ". ";
    $xx .= "\r\n";
    $xx .= "    ";
    return $xx;
}

function 来点名人名言()
{
    global $名人名言,$前面废话,$后面废话;
    $temp = $名人名言[array_rand($名人名言)];
    
    $temp = str_replace('a',$前面废话[array_rand($前面废话)],$temp);
    $temp = str_replace('b',$后面废话[array_rand($后面废话)],$temp);
    return $temp;
}

$主题 = empty($_GET['subject']) ? '啥也不是' : $_GET['subject'];
$文章 = '';
while (mb_strlen($文章) < 6000){
    $分支 = mt_rand(0, 100);
    if($分支 < 5){
        $文章 .= 另起一段();
    }elseif($分支 < 20){
        $文章 .= 来点名人名言();
    }else{
        $文章 .= $主要废话[array_rand($主要废话)];
    }
}
$文章 = str_replace('x',$主题,$文章);
echo $文章;