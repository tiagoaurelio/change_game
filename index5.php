<?php

$a = array(1,2,3);
$b = $a;
$c = &$a;

echo "Array de inteiros<br/>";
print_r($a);
echo "<br/>";
echo "<br/>";

$a[0] = 5;

echo "Array de inteiros com a alteração<br/>";
print_r($a);
echo "<br/>";
echo "<br/>";
echo "Array passado por valor<br/>";
print_r($b);
echo "<br/>";
echo "<br/>";
echo "Array passado por referencia<br/>";
print_r($c);

?>