<?php

$redirect_to = '../counter.php';

// header("Location {$redirect_to}");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0;url=<?= $redirect_to ?>">
    <label>Counter</label>
</head>
<body>
<script type="text/javascript">
window.location.href = "<?= $redirect_to ?>"
</script>
</body>
</html>
