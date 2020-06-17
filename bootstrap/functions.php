<?php
/**
 * Created by PhpStorm.
 * User: Slavi
 * Date: 12.8.2019 г.
 * Time: 14:29
 */
function pr($mixed_data = array())
{
    print "<pre style='color: green;'>";
    print_r($mixed_data);
    print "</pre>";
}

function calcPriceBGN($euroPrice, $fixing) {
  return $euroPrice * $fixing;
}

function months_translate($locale){
    $translated = [];
    $months = array(
        'en' => array(
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ),
        'bg' => array(
            '01' => 'Януари',
            '02' => 'Февруари',
            '03' => 'Март',
            '04' => 'Април',
            '05' => 'Май',
            '06' => 'Юни',
            '07' => 'Юли',
            '08' => 'Август',
            '09' => 'Септември',
            '10' => 'Октомври',
            '11' => 'Ноември',
            '12' => 'Декември'

        ),
        'de' => array(
            '01' => 'Januar',
            '02' => 'Februar',
            '03' => 'März',
            '04' => 'April',
            '05' => 'Mai',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'August',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Dezember'

        ),
        'ru' => array(
            '01' => 'Январь',
            '02' => 'Февраль',
            '03' => 'Март',
            '04' => 'Апрель',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Август',
            '09' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь'

        ),
    );
    if(isset($months[$locale])){
        $translated = $months[$locale];

    }

    return $translated;
}