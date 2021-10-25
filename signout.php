<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>MLL</title>
</head>
<body>
                        <?php 
                            include '../conns/mll/conn/conn.php';
                            include 'head.php';
                            mysqli_close($conn);
                            session_destroy();
                            echo '<script>location.replace("index.php")</script>';
                        ?>
</body>

</html>