<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $this->view("block_home/header");
    ?>

</head>

<body>
    <?php
    $this->view("block_home/menu");

    $this->view($content, $sub);
    ?>
</body>

<?php
$this->view("block_home/inforfooter");

$this->view("block_home/footer");
?>
</body>

</html>