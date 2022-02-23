<?php

// Разбираем строку с ФИО на части

function getPartsFromFullname($separateFullName){    

    $keysFromArray = ['surname', 'name', 'patronomyc'];
    return (array_combine($keysFromArray,explode(' ', $separateFullName)));
}

// Собираем ФИО из частей в одну строку

function getFullnameFromParts($partSurname = " ", $partName = " ", $partPatronomyc = " "){

    return ($partSurname." ".$partName." ".$partPatronomyc);
}

// Составляем строку из имени и первой буквы фамилии

function getShortName($fullName){

    $shortName = getPartsFromFullname($fullName);
    $firstSymbolSurname = $shortName['surname'][0].$shortName['surname'][1]; // Из-за кодировки костыль, не нашел нормального решения
    return ($shortName['name']." ".$firstSymbolSurname.'.');
}

// Определяем пол пропо ФИО

function getGenderFromName($fullNameForGender){
    
    $gender = 0;
    $nameForGender = getPartsFromFullname($fullNameForGender);

    // Для женщин

    if (mb_strpos($nameForGender['surname'], 'ва', mb_strlen($nameForGender['surname'])-2))  $gender--;
    if (mb_strpos($nameForGender['name'], 'а', mb_strlen($nameForGender['name'])-1))  $gender--;
    if (mb_strpos($nameForGender['patronomyc'], 'вна', mb_strlen($nameForGender['patronomyc'])-3))  $gender--;

    // для мужчин

    if (mb_strpos($nameForGender['surname'], 'в', mb_strlen($nameForGender['surname'])-1))  $gender++;
    if (mb_strpos($nameForGender['name'], 'й', mb_strlen($nameForGender['name'])-1))  $gender++;
    if (mb_strpos($nameForGender['name'], 'н', mb_strlen($nameForGender['name'])-1))  $gender++;
    if (mb_strpos($nameForGender['patronomyc'], 'ич', mb_strlen($nameForGender['patronomyc'])-2))  $gender++;

    if ($gender > 0) return 1;
    if ($gender < 0) return -1;
    return 0;
}

// Определяем гендерный состав аудитории и выводим

function getGenderDescription($personsArray){

    $allPersons = count($personsArray);
    $numberMen = 0;
    $numberWomen = 0;

    // Основной способ по заданию
    $numberMen = count(array_filter($personsArray, function($partArray){
        $currentStep = getGenderFromName($partArray['fullname']);
    if ($currentStep == '1')
        return true;
    else 
        return false;
    }));
    $numberWomen = count(array_filter($personsArray, function($partArray){
        $currentStep = getGenderFromName($partArray['fullname']);
    if ($currentStep == '-1')
        return true;
    else 
        return false;
    }));

/*
    // Альтернативный способ подсчета, этот проще или основной способ не так задумывался, ИМХО
    
    foreach($personsArray as $elementArray){
        $temp = getGenderFromName($elementArray['fullname']);
        if ($temp == 1) $numberMen++;
            else
                if ($temp == -1) $numberWomen++;
        }     
    ;
*/
    $textGenderDescription = "Гендерный состав аудитории:<br/>---------------------------<br/>";
    $textGenderDescription .= "Мужчины - ".number_format(($numberMen / $allPersons)*100, 1, '.', '')."%<br/>";
    $textGenderDescription .= "Женщины - ".number_format(($numberWomen / $allPersons)*100, 1, '.', '')."%<br/>";
    $textGenderDescription .= "Не удалось определить - ".(100 - number_format((($numberMen + $numberWomen) / $allPersons)*100, 1, '.', ''))."%<br/>";
    return $textGenderDescription;
}

// Подбор пары

function getPerfectPartner($surnameFirstPartner, $nameFirstPartner, $patronomycFirstPartner, $personsArrayPartner){
    $surnameFirstPartner = mb_convert_case($surnameFirstPartner, MB_CASE_TITLE_SIMPLE);
    $nameFirstPartner = mb_convert_case($nameFirstPartner, MB_CASE_TITLE_SIMPLE);
    $patronomycFirstPartner = mb_convert_case($patronomycFirstPartner, MB_CASE_TITLE_SIMPLE);
    $fullNameFirstPartner = getFullnameFromParts($surnameFirstPartner, $nameFirstPartner, $patronomycFirstPartner);
    $genderFirstPartner = getGenderFromName($fullNameFirstPartner);

    if ($genderFirstPartner != 0){
        do {
            $randomElementArray = array_rand($personsArrayPartner, 1);
            $genderSecondPartner = getGenderFromName($personsArrayPartner[$randomElementArray]['fullname']);
        } while (($genderSecondPartner == 0) || ($genderFirstPartner == $genderSecondPartner));
        $fullNameSecondPartner = $personsArrayPartner[$randomElementArray]['fullname'];
        $PerfectPartner = getShortName($fullNameFirstPartner)." + ".getShortName($fullNameSecondPartner)." = ♡ Идеально на ".(mt_rand(5000, 10000)/100)." ♡";
    }
        else{
            $PerfectPartner = "Невозможно определить пол!";
        }
    return $PerfectPartner;
}
?>
