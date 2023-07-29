<?php

namespace App\Enums;

enum FrequencyEnum: int
{
    case MONTHLY = 1;
    case QUARTERLY = 2;
    case YEARLY = 3;
    case BI_WEEKLY = 4;
}
