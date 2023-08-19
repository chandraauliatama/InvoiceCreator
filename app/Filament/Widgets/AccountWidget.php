<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget as AccountWidgetOriginal;

class AccountWidget extends AccountWidgetOriginal
{
    protected int|string|array $columnSpan = 'full';
}
