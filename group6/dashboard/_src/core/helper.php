<?php

function security($data)
{
    return htmlspecialchars(strip_tags($data));
}

function seoUrl($string)
{
    // Türkçe karakterleri İngilizce karşılıklarına dönüştürme
    $turkish = array('ş', 'Ş', 'ı', 'I', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'ç', 'Ç');
    $english = array('s', 's', 'i', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c');
    $string = str_replace($turkish, $english, $string);

    // Özel karakterleri kaldırma
    $string = preg_replace('/[^a-zA-Z0-9\s\-]/u', '', $string); // Harf, rakam, boşluk ve tire dışında her şeyi kaldırır.

    // Tüm karakterleri küçük harfe dönüştürme
    $string = strtolower($string);

    // Çoklu boşlukları tek boşluğa indirme
    $string = preg_replace('/\s+/', ' ', $string);

    // Boşlukları tire ile değiştirme
    $string = str_replace(' ', '-', $string);

    // Birden fazla tiri tek bir tireye düşürme
    $string = preg_replace('/-+/', '-', $string);

    // Baştaki ve sondaki gereksiz tırnak veya tireyi kaldırma
    $string = trim($string, '-');

    return $string;
}
