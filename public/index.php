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
                <div class="errorText"></div>
                <form action="../engine/ClassUsers.php" method="post" class="login_form">
                    <h3>Вход</h3>
                    <hr>
                    <label for="login">Логин</label>
                    <input type="text" name="login" value="sollerij">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" value="012345">
                    <input type="button" name="login_button" class="login_button" value="Войти">
                </form>
        </div>
        <!-- <div class="footer"></div> -->
    </div>
    <script>
    var dataObject = {};
    var i = 0;
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
            url: "../engine/ClassUsers.php",
            data: {loginData : jsonData},
            success: function (response) {
                console.log('Данные переданы.');
                $(".errorText").append(response);
                i++;
                console.log(i);
                 
            },
            error: function(error){
                console.log("Данные не переданы.");
                console.log(error);
            }
        });
        // Затираю последующий вывод ошибки
        if (i > 1){
            $(".errorText").html('');
        }
        // var elem1 = document.getElementsByClassName("errorText");
        // console.log(elem1);
        
        // elem1.style.cssText="color: red !important; \
        // background-color: yellow; \
        // width: 100px; \
        // text-align: center; \
        // blabla: 5; \
        // ";
        // console.log(div.style.cssText);
    });
    
    
    </script>
</body>
</html>
