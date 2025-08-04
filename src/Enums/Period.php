<?php

namespace app\Enums;

enum Period: int
{
    case M1 = 1;
    case M3 = 3;
    case M5 = 5;
    case M15 = 15;
    case M30 = 30;
    case H1 = 60;
    case H4 = 240;
    case D1 = 1440;
    case D7 = 10080;
}
