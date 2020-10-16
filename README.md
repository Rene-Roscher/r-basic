## About Advanced Laravel - R-Services
- [Telegram-Bot-SDK](https://packagist.org/packages/irazasyed/telegram-bot-sdk) - irazasyed/telegram-bot-sdk
- [Agent-Parser](https://packagist.org/packages/jenssegers/agent) - jenssegers/agent
- [Human Regex](https://packagist.org/packages/mpociot/human-regex) - mpociot/human-regex
- [Countries Laravel](https://packagist.org/packages/pragmarx/countries-laravel) - pragmarx/countries-laravel
- [Encryption Cast](https://packagist.org/packages/roelofr/laravel-encryption-cast) - roelofr/laravel-encryption-cast
- Spatie:
    - [Array to XML](https://packagist.org/packages/spatie/array-to-xml) - spatie/array-to-xml
    - [Blade Javascript](https://packagist.org/packages/spatie/laravel-blade-javascript) - spatie/laravel-blade-javascript
    - [Media Library](https://packagist.org/packages/spatie/laravel-medialibrary) - spatie/laravel-medialibrary
    - [Model States](https://packagist.org/packages/spatie/laravel-model-states) - spatie/laravel-model-states - (not compatible with yajra-datatables package 😪)
    - [Permission](https://packagist.org/packages/spatie/laravel-permission) - spatie/laravel-perrmission
    - [Sitemap](https://packagist.org/packages/spatie/laravel-sitemap) - spatie/laravel-sitemap
    - [Sluggable](https://packagist.org/packages/spatie/laravel-sluggable) - spatie/laravel-sluggable
    - [Tags](https://packagist.org/packages/spatie/laravel-lags) - spatie/laravel-tags
    - [Validation Rules](https://packagist.org/packages/spatie/laravel-validation-rules) - spatie/laravel-validation-rules
- [yajra/laravel-datatables-fractal](https://packagist.org/packages/yajra/laravel-datatables-fractal) - yajra/laravel-datatables-fractal
- [yajra/laravel-datatables-oracle](https://packagist.org/packages/yajra/laravel-datatables-oracle) - yajra/laravel-datatables-oracle

## Todo

- Laravel Mail Viewer https://github.com/themsaid/laravel-mail-preview 
- BotMan (Bot-Manager) https://github.com/botman/botman


## Methods Todo
- Select2 Blade Directive (@select2(route('ajax.source'), 'name', 'LabelName')
- Macros for Blueprint (->default()|uuid,softdeletes usw)

## CRUD
Do you want to using the Create-Read-Update-Delete System?

- Use the FormContract trait in your Model
- Fill the $formFields and $dataTablesFields

## Crud Example

    ```php
    
    public static $formFields = [
        'name:name|type:text',
        'name:email|type:email',
        'name:password|type:text|only:create',
        'name:state|type:select|options:PENDING:Pending,DONE:Finished',
    ];

    public static $dataTablesFields = [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'E-Mail'
    ];
    ```
## Available form-field-types
- name
- type (all input-types: text,number,checkbox,range,select) | If using select is options required!
- min
- max
- step
- only (if the input should be there for only one | create,update)
- placeholder
- value
- label
- options | type=select is required! - (VALUE:TITLE or TITLE)

## dataTables-fields
- 'data-key-query' => 'Table Name',
-> 'user.name' => 'Username',

## Crud Routing
- Route::crud(\RServices\User::class);

Here we worked with kebab and plural of the model name.
Example for this UserItem Model:
-> where the url would look like this /user-items
