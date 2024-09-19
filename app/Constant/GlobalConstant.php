<?php

namespace App\Constant;

class GlobalConstant
{
    public const QUO_STATUS_OPTIONS = [
        self::QUO_STATUS_PENDING,
        self::QUO_STATUS_PROCESS,
        self::QUO_STATUS_FINISH,
        self::QUO_STATUS_CANCEL,
        self::QUO_STATUS_HOLD,
    ];

    public const QUO_STATUS_PENDING = 'PENDING';

    public const QUO_STATUS_PROCESS = 'PROCESS';

    public const QUO_STATUS_FINISH = 'FINISH';

    public const QUO_STATUS_CANCEL = 'CANCEL';

    public const QUO_STATUS_HOLD = 'HOLD';
}
