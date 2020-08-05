<?php

function sampleWithoutReplacement(
    int $populationSize,    // size of set sampling from
    int $sampleSize,        // size of each sample
    array &$samples         // output, zero-offset indices to selected items
): void
{
    // Use Knuth's variable names

    $total    = 0; // total input records dealt with
    $selected = 0; // number of items selected so far

    while ($selected < $sampleSize) {
        $random = getUniform(); // call a uniform(0,1) random number generator

        if (($populationSize - $total) * $random >= $sampleSize - $selected) {
            $total++;
        }
        else {
            $samples[$selected] = $total;
            $total++;
            $selected++;
        }
    }
}

function getUniform(): float
{
    return (float)(mt_rand(0, 9999) / 10000.0);
}

mt_srand(crc32(microtime()));
$sample = [];
sampleWithoutReplacement(16, 12, $sample);
print_r($sample);
