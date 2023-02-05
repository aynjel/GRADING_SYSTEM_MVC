<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->siteTitle(); ?>
    </title>

    <?= $this->favicon('favicon.ico'); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <?= $this->css('style.css'); ?>

    <?= $this->content('head'); ?>

</head>

<body>

    <?= $this->content('body'); ?>

    <?= $this->js('vendor/global/global.min.js'); ?>
    <?= $this->js('vendor/chart.js/Chart.bundle.min.js'); ?>
    <?= $this->js('vendor/jquery-nice-select/js/jquery.nice-select.min.js'); ?>
</body>

</html>