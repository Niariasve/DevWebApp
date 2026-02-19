<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevWebCamp - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php if (!empty($_ENV['VITE_DEV']) && $_ENV['VITE_DEV'] == true): ?>
        <link rel="stylesheet"
            href="http://localhost:5173/src/scss/app.scss">
    <?php elseif ($css = vite_css()): ?>
        <link rel="stylesheet" href="<?= $css ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=BAA5YlZwbmwqboF-0WpmMaBcRr1kCHyjg53oG9K_DhWa28R8wvlbWBSjZ3l0Pxe34BdanO5j2LsEhery60&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>
</head>

<body>
    <?php
    include_once __DIR__ . '/templates/header.php';
    echo $contenido;
    include_once __DIR__ . '/templates/footer.php';
    ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true
        });
    </script>
    <?php if (isset($script) && !empty($script)): ?>
        <?php foreach ($script as $src): ?>
            <script src="<?= $src ?>" type="module"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>