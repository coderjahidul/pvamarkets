<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <?php
            $redirectUrl = $viserData['redirectUrl'];
        ?>
        <h3 style="color:red">The payment is failed. You will redirect soon to the targeted page...</h3>
        <script>
            setInterval(() => {
                window.parent.location.href = "<?php echo $redirectUrl ?>"; 
            }, 3000);
        </script>
    </body>
    </html>