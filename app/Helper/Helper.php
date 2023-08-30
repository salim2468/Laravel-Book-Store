
<?php

function getRandomISBN()
{
    $min = 1000000000000; // Smallest 13-digit number
    $max = 9999999999999; // Largest 13-digit number
    return (string) mt_rand($min, $max);
}
