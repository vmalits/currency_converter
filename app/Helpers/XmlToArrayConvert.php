<?php

declare(strict_types=1);

namespace App\Helpers;

use Mtownsend\XmlToArray\XmlToArray;

trait XmlToArrayConvert
{
    public function xmlToArray(string $xml): array
    {
        return XmlToArray::convert($xml);
    }
}
