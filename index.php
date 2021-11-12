<?php

function get_users(int $page): mixed
{
    $url = sprintf('https://reqres.in/api/users?page=%d', $page);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true);
}

?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Задание АЭБ</title>
</head>
<body>
<table>
    <tr>
        <th>№</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>E-Mail</th>
    </tr>
    <?php
    $page = htmlspecialchars($_GET['page'] ?? '0');
    $result = get_users(intval($page) + 1);
    $users = $result['data'];
    foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['first_name']; ?></td>
            <td><?php echo $user['last_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
