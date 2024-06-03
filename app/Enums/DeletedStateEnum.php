<?php

namespace App\Enums;

enum DeletedStateEnum: int {
    case NOT_DELETED = 0;
    case DELETED = 1;
}
