<html>
    <body>

        <?php
        $email = $_POST["email"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
          echo $emailErr;
        }
        ?>
    </body>
</html>
