<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $this->view("block_home/header");

    $validUrls = ['/chon-thuc-an.html', '/chon-thuc-an-.html', '/pay.html', '/pay-.html', '/chon-ghe.html'];
    $warningUrl = ['/chon-ghe'];


    $parsedUrl = parse_url(strtok(_URL_, '?'), PHP_URL_PATH);
    $cleanUrl = preg_replace('/-\d+\.html/', '', $parsedUrl);


    if (!in_array(strtok(_URL_, '?'), $validUrls)) {
        if (!in_array($cleanUrl, $warningUrl)) {
            $this->view("home/holdTicket");
        }
    }

    if (in_array($cleanUrl, $warningUrl)) {
        $this->view("home/warningTicket");
    }

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