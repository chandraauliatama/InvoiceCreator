<?php

// namespace Filament\Widgets;

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AccountWidget extends Widget
{
    protected static ?int $sort = -3;

    protected int|string|array $columnSpan = 'full';

    protected static string $view = 'filament::widgets.account-widget';
}
