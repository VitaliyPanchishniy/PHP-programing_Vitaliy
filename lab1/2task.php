<?php
$stringVar = "Have a nice day!"; 
$intVar = 42;                
$floatVar = 3.14;           
$boolVar = true;              

echo "Рядок: " . $stringVar . "<br>";
echo "Ціле число: " . $intVar . "<br>";
echo "Число з плаваючою комою: " . $floatVar . "<br>";
echo "Булеве значення: " . ($boolVar ? 'true' : 'false') . "<br><br>";

echo "\$stringVar: ";
var_dump($stringVar);
echo "<br>";

echo "\$intVar: ";
var_dump($intVar);
echo "<br>";

echo "\$floatVar: ";
var_dump($floatVar);
echo "<br>";