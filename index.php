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

                <div class="fullname">
                    <?php echo getFullnameFromParts('Семенов', 'Семен', 'Семенович')."<br/>"; ?>
                    <?php print_r(getPartsFromFullname('Иванов Иван Иванович')); echo "<br/>"; ?>
                    <?php echo getShortName('Семенова Анна Ивановна')."<br/>"; ?>
                    <?php getGenderFromName('Иванов Ирин Арсеньевна')."<br/>"; ?>
                    <?php echo getGenderDescription($example_persons_array);?>
                    <?php echo getPerfectPartner('СемеНов', 'СЕМЁН', 'СеменовиЧ', $example_persons_array);?>
                </div>

    </div>

</body>
</html>