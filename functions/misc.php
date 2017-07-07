<?php

function get_snippet($text, $length=64, $tail="") {
    $text = trim($text);
    $text = strip_tags($text);
    $txtl = strlen($text);
    if ($txtl > $length) {
        for ($i = 1; $text[$length - $i] != " "; $i++) {
            if ($i == $length) {
                return substr($text, 0, $length) . $tail;
            }
        }
        $text = substr($text, 0, $length - $i + 1) . $tail;
    }
    return $text;
}

function to_url_string($string) {

    $string = str_replace(' ', '-', $string);
    $string = str_replace('!', '', $string);
    $string = str_replace('@', '', $string);
    $string = str_replace('#', '', $string);
    $string = str_replace('$', '', $string);
    $string = str_replace('%', '', $string);
    $string = str_replace('^', '', $string);
    $string = str_replace('&', '', $string);
    $string = str_replace('*', '', $string);
    $string = str_replace('(', '', $string);
    $string = str_replace(')', '', $string);
    $string = str_replace('{', '', $string);
    $string = str_replace('}', '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace("'", '', $string);
    $string = str_replace('&', '', $string);
    $string = str_replace('.', '', $string);
    $string = str_replace(',', '', $string);
    $string = strtolower($string);

    return $string;
}

function sanitize($conn, $data) {

//remove spaces from the input

    $data = trim($data);

//convert special characters to html entities
//most hacking inputs in XSS are HTML in nature, so converting them to special characters so that they are not harmful

    $data = htmlspecialchars($data);

//sanitize before using any MySQL database queries
//this will escape quotes in the input.

    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

function money($amount, $separator=true, $simple=false) {
    return
            (true === $separator ?
                    (false === $simple ?
                            number_format($amount, 2, '.', ',') :
                            str_replace('.00', '', money($amount))
                    ) :
                    (false === $simple ?
                            number_format($amount, 2, '.', '') :
                            str_replace('.00', '', money($amount, false))
                    )
            );
}
