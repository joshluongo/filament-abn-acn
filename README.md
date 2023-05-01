# filament-abn-acn
Australian Business Number and Australian Company Number inputs for [Filament](https://filamentphp.com). 

The fields will have the correct label, input masking and input validation automatically.

## Usage

With your form schema use `AbnInput` or `AcnInput`.

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            AbnInput::make("abn"),
            AcnInput::make("acn")
        ]);
}
```

## Credits

- [Paul Ferrett for the ABN/ACN validation code](https://gist.github.com/paulferrett/8141303)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
