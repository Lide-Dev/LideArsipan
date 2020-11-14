<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debugging</title>
</head>

<body>
    <p>Function Name: <?= $this->security->xss_clean(__METHOD__) ?></p>
    <?php foreach ($params as $key => $value) : ?>
        <pre>
        <?php
        if ($method === 1) print_r($value);
        else var_dump($value);
        ?>
        </pre>
    <?php endforeach; ?>
</body>

</html>