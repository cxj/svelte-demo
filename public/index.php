<?php
/**
 * Front controller.
 */
declare(strict_types=1);

namespace Cxj;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$getLogos = new AllLogos();

echo $getLogos->get12Logos();
