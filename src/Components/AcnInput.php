<?php

namespace Joshluongo\FilamentAbnAcn\Components;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Support\Facades\Lang;

class AcnInput
{
    /**
     * Make a new ACN input field.
     *
     * This will validate and mask the input.
     */
    public static function make(string $name): TextInput
    {
        return TextInput::make($name)
            ->label(Lang::get('filament-abn-acn::filament-abn-acn.acn.name'))
            ->numeric()
            ->mask(fn (Mask $mask) => $mask->pattern('000 000 000'))
            ->rules([new \Joshluongo\FilamentAbnAcn\Rules\Acn()]);
    }
}
