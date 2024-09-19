<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $this->view("block_home/headerAdmin");
    ?>

</head>

<body>
    <?php
    $this->view("block_home/menu");
    $this->view("block_home/menuAdmin");

    $this->view($content, $sub);
    ?>
</body>

<?php
$this->view("block_home/footerAdmin");
?>
</body>

</html>