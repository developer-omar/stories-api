<?php

namespace App\Enums;

enum UserStatusEnum: int {
    case LOGGED_IN = 1;
    case NOT_LOGGED_IN = 0;
}
