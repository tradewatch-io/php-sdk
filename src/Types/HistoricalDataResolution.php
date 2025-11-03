<?php

namespace Tradewatch\Types;

enum HistoricalDataResolution: string
{
    case Value5 = "5";
    case Value10 = "10";
    case Value30 = "30";
    case Value60 = "60";
    case Value600 = "600";
    case Value1800 = "1800";
    case Value3600 = "3600";
    case Value14400 = "14400";
    case Value43200 = "43200";
    case Value86400 = "86400";
}
