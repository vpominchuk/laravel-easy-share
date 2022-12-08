# laravel-easy-share
Laravel EasyShare is a fully customized and easy to use social share buttons component.

It is as easy as count to four

## 1. Install
```shell
$ composer require vpominchuk/laravel-easy-share
```

## 2. Publish sample config file
```shell
$ php artisan vendor:publish --tag=easy-share-config
```

## 3. Add a component to your view.
```html
<x-easy-share />
```

## 4. Add some CSS styles:
```css
.easy-share {
    display: flex;
}

.easy-share li {
    margin-right: 1.5rem;
}
```
and you are ready to go!

## Available social networks
* Facebook
* Twitter
* LinkedIn
* Whatsapp
* Viber
* Telegram

## Managing social networks

You can easily add/remove/enable/disable available social networks.
Just open `config/easy-share.php` file and add any social network you like.

### Configuration options

|Option name|Description|
|-----------|-----------|
| `url`     | Social network share url. It should include following keys: `{url}` - will be replaced with your. `{title}` - may be overwritten with your page title. `{summary}` - used for LinkedIn only, ok, let it be...|
| `allowed` | To Enable / Disable |
| `class`   | Add any custom class to current share link |
| `content` | To be placed as a content for `<a href=''>$content</a>` tag. Can be used to display any SVG icon or other text or even HTML |
| `title`   | To be placed as `title` attribute for `<a href='' title='$title'>...`|

### Using SVG icons

To use your own SVG icons just put content of your SVG icon file into `content` key of configuration file for the necessary icon.

### Using Fontawesome or other icons library

The same as with SVG, just put `<i class="fa-brands fa-twitter"></i>` into `content` key of the config file.

## Component parameters

By default, you can use `<x-easy-share />` without any attributes, it will detect current url of the page, but **will not** detect page title.

|Option name|Description|
|-----------|-----------|
| `url`     | Page URL to be shared. Example: `<x-easy-share url="https://example.com/" />`|
| `title`   | Page title. Use `:title="$title"` to pass title from variable or `title="My page title"` to pass as text |
| `summary` | Page summary. Used for LinkedIn only. |
| `allow`   | Allows you to enable disabled social links. Pass multiple social links via comma: `allow="pinterest,reddit"` |
| `disable` | Disable some social links. Pass multiple social links via comma: `disable="pinterest,reddit"` |

Custom attributes can be passed to custom template.

## Using custom view (template)

To use custom template, just create a folder `easy-share` under `resources/views/` and put your custom template in it.
```html
<ul class="easy-share">
    @foreach($services as $name => $service)
    <li class="easy-share-{{$name}} {{$service['class'] ?? ''}}">
        <a href="{{$service['url'] ?? '#'}}" target="_blank" title="{{$service['title']}}">{!! $service['content'] ?? '' !!}</a>
    </li>
    @endforeach
</ul>
```
Custom attributes in `<x-easy-share />` component will be passed to your custom template.

All Kebab Cased and Snake Cased attributes will be transformed to Camel Case, for example:

```html
<x-easy-share my-first-attribute="1" my_second_attribute="2" />
``` 
will be transformed to `{{$myFirstAttribute}}` and `{{$mySecondAttribute}}`.

## Getting share links as a PHP array

You can use `EasyShare` facade to get plain PHP array of share links. Example:
```php
use Illuminate\Support\Facades\URL;
use \VPominchuk\EasyShare\Facades\EasyShare;

$url = URL::current();
$easyShare = EasyShare::setUrl($url);
$array = $easyShare
    ->setTitle($pageTitle)
    ->setSummary($summary)
    ->getServices();
```

There are two additional methods:

| Method | Description |
|--------|-------------|
| `setAllowed(array)` | Enable some social share links. `$easyShare->setAllowed(["reddit", "pinterest"]);`|
| `disable(array)` | Disable some social share links. `$easyShare->setAllowed(["reddit", "pinterest"]);`|

## Security

If you discover any security related issues, please use the issue tracker.

## Credits

- [Vasyl Pominchuk](https://vpominchuk.com/)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
