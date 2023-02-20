<?php
function asDollars($value)
{
    if (!is_numeric($value)) return $value; // Return the value as-is if it is not numeric
    if ($value < 0) return "-" . asDollars(-$value);
    return '$' . number_format($value, 2);
}

function presentPrice($price)
{

    return asDollars($price);
}

function setActiveCategory($category, $output = "active")
{
    return request()->category == $category ? $output : '';
}

function setActiveHeader($header, $output = "active")
{
    return request()->routeIs($header) == $header ? $output : '';
}
function numberFrmt($price)
{

    $var = str_replace('.', '', $price);
    return $var;
}
