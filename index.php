<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>12_6_Vladimir_Belyak</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php require_once 'functions.inc.php' ?>
    <?php require_once 'example_persons_array.inc.php' ?>
    <div class="flex-container">

        <div>
            <?php

                echo 'Результат выполнения функции <strong>getFullnameFromParts("Семенов", "Семен", "Семенович")</strong>:<br/>';  
                echo getFullnameFromParts("Семенов", "Семен", "Семенович")."<br/>"; 

            ?>
            <?php

                echo 'Результат выполнения функции <strong>print_r(getPartsFromFullname("Иванов Иван Иванович"))</strong>:<br/>';
                print_r(getPartsFromFullname("Иванов Иван Иванович")); echo "<br/>"; 

            ?>
            <?php

                echo 'Результат выполнения функции <strong>getShortName("Семенова Анна Ивановна")</strong>:<br/>';
                echo getShortName("Семенова Анна Ивановна")."<br/>";

            ?>
            <?php

                echo 'Результат выполнения функции <strong>getGenderFromName("Иванова Ирина Арсеньевна")</strong>:<br/>';
                echo getGenderFromName("Иванова Ирина Арсеньевна")."<br/>";

            ?>
            <?php

                echo 'Результат выполнения функции <strong>getGenderDescription($example_persons_array)</strong>:<br/>';
                echo getGenderDescription($example_persons_array)."<br/>";

            ?>
            <?php

                echo 'Результат выполнения функции <strong>getPerfectPartner("СемеНов", "СЕМЁН", "СеменовиЧ", $example_persons_array)</strong>:<br/>';
                echo getPerfectPartner("СемеНов", "СЕМЁН", "СеменовиЧ", $example_persons_array)."<br/>";

            ?>
        </div>

    </div>

</body>
</html>