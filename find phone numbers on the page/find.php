<?php

$homepage = file_get_contents('http://www.avpmr.com/pages/page/contacts');
print_r ($homepage);

echo '<br>';
echo 'найденные номера телеофнов ';

preg_match_all('/[533]{3}(.)(.)[0-9](.)[0-9]{2}(.)[0-9]{2}/', $homepage, $matches);
echo '<pre>';
print_r($matches[0]);
echo '</pre>';


/* на выходе получил

найденные номера телеофнов
Array
(
    [0] => 533)-9-57-53
    [1] => 533) 9-55-60
    [2] => 533/ 9-43-31
    [3] => 533/ 5-00-40
    [4] => 533/ 2-10-48
    [5] => 555/ 4-14-09
)

*/