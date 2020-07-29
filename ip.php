<?php
$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
if ($query && $query['status'] == 'success') {
echo 'Hey user from ' . $query['country'] . ', ' . $query['city'] . '!';
}

print_r($query);
foreach ($query as $data) {
    echo $data . "<br>";
}
?>

