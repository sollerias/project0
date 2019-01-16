<?php
//============Блок для вывода всех ошибок интерпретатора=========//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============Конец блока для вывода всех ошибок интерпретатора=========//
$cssFile =  'css/stylesheets/style.css';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?=$cssFile?>">
    <title>Login</title>
</head>
<body>
    <div class="main_box">
        <div class="body">
                <!-- <form action="../engine/login.php" method="post" class="login_form"> -->
                <p>
                <?php if (!empty($error)) 
                {
                    foreach ($error as $err) {
                        echo $err;
                    };}
                ?>
                </p>
                <form action="../engine/ClassUsers.php" method="post" class="login_form">
                    <h3>Вход</h3>
                    <hr>
                    <label for="login">Логин</label>
                    <input type="text" name="login" value="sollerij">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" value="012345">
                    <!-- <input type="submit" name="login_button" value="Войти"> -->
                    <input type="button" name="login_button" class="login_button" value="Войти">
                </form>
        </div>
        <!-- <div class="footer"></div> -->
    </div>
    <script>
    var dataObject = {};
    $(".login_button").on("click", function() {
        var formData = $(".login_form").find("input");
        console.log(formData);
        $.each(formData, function (index, value) { 
            var elemName = value["name"];
            var elemValue = value["value"];
            if (elemValue.length != 0) {
                console.log(elemName + " " + elemValue);
                dataObject[elemName] = elemValue;
            }
        });
        console.log(dataObject);
        var jsonData = JSON.stringify(dataObject);
        console.log(jsonData);
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            // dataType: "json",
            url: "../engine/ClassUsers.php",
            data: {loginData : jsonData},
            success: function (response) {
                console.log('Данные переданы.');
                // $(".test").append(response);
            },
            error: function(){
                console.log("Данные не переданы.");
                
            }
        });

    });
    </script>
</body>
</html>
