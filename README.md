# Florms
## Easy Bootstrap Forms for Laravel

Florms is a Laravel package that enables you to quickly and easily add
Bootstrap 4 forms to your application. Input elements are automatically wrapped
in the standard containers (such as `<div class="form-group">`). Labels,
validation errors, input groups, and other decoration is automatically built
correctly, so you don't have to think about it. HTML attributes and class 
options are added via chained methods, and most inputs have sensible defaults,
so you can quickly and easily knock out your forms and get back to the more
important parts of your application.

## Installation

To install Florms, require the package with Composer by running the following
command in your console/terminal:
```
composer require "se7enet/florms" 
```

If you're using Laravel 5.5 or higher, that should be it, Laravel will automatically discover the Service Provider and 
Facade as part of the Composer install. 

However, if you are on a version lower than 5.5, or if you don't use Auto
Discovery, you'll need to add these yourself:

Add the Service Provider to the `providers` array in config/app.php:
```
Se7enet\Florms\FlormsServiceProvider::class,
```

And add the Facade to the `aliases` array in config/app.php:
```
'Florms' => Se7enet\Florms\FlormsFacade::class,
```

You can also optionally publish the config file, if you wish to make any skin customizations:
```
publish config command goes here
```

## Getting Started

To get started, simply open a new form. Normally this would be done inside a Blade template, but you can store it in a variable if you'd like. Note that because this inherently returns HTML, if you are using it in a Blade, you should use the `{!! ... !!}` to print the unescaped string.
```
{!! Florms::open()->action('/url/to/route.php')->post(); !!}
```
This will return the following:
```
<form action="/url/to/route.php" method="post">
<input type="hidden" name="_token" value="SOMECSRFTOKEN">
```

You can also use the `route()` method instead of `action()`, which accepts the same arguments as Laravel's `route()` helper function, and will automatically turn your route name into a complete URL:
```
{!! Florms::open()->route('route.name', [$model->id], true)->post() !!}
```

And you can use the `put()` or `patch()` or `delete()` methods, instead of `post()`, to use those as well. Because HTML doesn't actually support these methods, these will submit the form itself using the `post`, but will automatically add the necessary hidden input so that Laravel knows what to do for routing purposes.

If you want to prepopulate the default values of all fields on your form using an existing model, simply chain the `->model($model)` method onto your form declaration. The model gets attached to the form, and any inputs you create will automatically receive a `value` attribute by looking up the field's `name` from the model attributes.

For example, a `$user` model may have a `$user->first_name` attribute, with a value of "John". If you chain `->model($user)` to your form declaration, and then create a field using `Florms::text()->name('first_name')`, that field will automatically receive `value="John"` attribute.

## Adding Form Fields

Once you have opened the form, you can add a new field. For a plain text input, you could do something like the following:
```
{!! Florms::text()
    ->name('first_name')
    ->label('First Name') !!}
```

That would get you something like this:
```
<div class="form-group">
    <label for="first_name">First Name</label>
    <input type-"text" name="first_name" id="first_name" class="form-control">
</div>
```

As you can see, the field will be automatically wrapped inside a `form-group` div, and the standard Bootstrap classes for labels and inputs will be added for you as well.

You can make select boxes, too. By default, selects use Bootstrap's "custom" variation to allow for more styling options.
```
{!! Florms::select()
    ->name('selectname")
    ->options([1=>'One', 2=>'Two', 3=>'Three'])
    ->value(2)
    ->label('Label Goes Here') !!}
```
And you'll get:
```
<div class="form-group">
    <label for="selectname">Label Goes Here</label>
    <select name="selectname" id="selectname" class="custom-select">
        <option value="1">One</option>
        <option value="2" selected>Two</option>
        <option value="#">Three</option>
    </select>
</div>
```

Basically all `<input type="...">` values are supported by using the appropriate static method call from the `Florms` class (`Florms::number()`, `Florms::date()`, `Florms::color()`, etc.), as well as the additional input-related tags (`Florms::select()` and `Florms::textarea()`, for example).

Most HTML attributes are supported as well, using camel case. Methods chain onto each other and return the main input object, so you can build a complete input field. The `id` attribute will be automatically added based on the field's `name`, but you can override it with your own ID if you'd like. And you can add additional classes before or after the normal Bootstrap `form-control` class by using `appendClass(...)` or `prependClass(...)`.
```
{!! Florms::number()
    ->name('quantity')
    ->id('quantityId')
    ->label('Quantity')
    ->dataToggle('something')
    ->rel('last')
    ->max(100)
    ->min(0)
    ->step(1)
    ->appendClass('another-class') !!}
```
```
<div class="form-group">
    <label for="quantityId">
    <input type="number" id="quantityId" name="quantity" data-toggle="something" rel="last" max="100" min="0" step="1" class="form-control another-class">
</div>
```

Additionally, if it makes more sense for you, you can pass an array of options into the original method call, similar to how Laravel's built-in form builder used to work before it was removed from the framework. When using the array syntax, you should use spinal case rather than camel case. You can create the same field as above by using the following:
```
{!! Florms::number([
    'name' => 'quantity',
    'id' => 'quantityId',
    'label' => 'Quantity',
    'data-toggle' => 'something',
    'rel' => 'last',
    'max' => 100,
    'min' => 0,
    'step' => 1,
    'append-class' => 'another-class',
]) !!}
```

Like selects, checkboxes and radios use Bootstrap's "custom" style as well. The necessary wrappers to use this are handled for you. Florms also knows that labels come _after_ checkboxes and radios, rather than before like most other input types, and that they'll need their own custom class in here.
```
{!! Florms::checkbox()
    ->name('acknowledgement')
    ->value(1)
    ->label('I acknowledge this.') !!}
```
```
<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" name="acknowledgement" id="acknowledgement" value="1" class="custom-control-input">
        <label for="acknowledgement" class="custom-control-label">I acknowledge this.</label>
    </div>
</div>
```

## More Options

Input Groups are easy as well, using the `inputGroupAppend()` or `inputGroupPrepend()` methods. Simply pass the text or HTML you'd like to add into the method. You can even use both methods at the same time, and Florms will apply both inside a single outer `input-group` div.
```
{!! Florms::number()
    ->name('price')
    ->label('Price')
    ->max(999.99)
    ->min(0)
    ->step(0.01)
    ->inputGroupPrepend('$')
    ->inputGroupAppend('.00') !!}
```
```
<div class="form-group">
    <label for="price">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        <input type="number" name="price" id="price" max="999.99" min="0" step="0.01" class="form-control">
        <div class="input-group-append">
            <span class="input-group-text">.00</span>
        </div>
    </div>
</div>
```

If for some crazy reason you only want to create a plain input field without the standard `form-group` wrapper, you can chain `->formGroup(false)`

## In Closing

To close your form, after all fields have been created, it's about what you would expect:
```
Florms::close()
```

By closing your form, it will clear out any model attachments and other options, setting you back to a _tabula rasa_. Once the first form has been cleared out, you can create another form, with another action, another model, and different fields.

Note that the `close()` method is only called by itself; you cannot chain any additional methods to it as you would most other Florms methods, because it simply renders the `</form>` closing tag and returns it as a string.

## Coming Soon

Florms is still a work in progress. For one, I still need to build complete documentation. This readme really only scratches the surface of all the possible options and attributes you can use.

There are some additional features I'd like to build in as well. Right now, you can "chain" method names themselves to call methods on some of the helper elements - for example, `->formGroupAppendClass('another-class')` would call the `appendClass()` method on the field's `formGroup`, resulting in `<div class="form-group another-class">...</div>`.

What you can't do, yet, is chain even further. For example, Input Groups have several child elements inside them, and I'd like to let you use method chaining to go all the way down into them. An example would be something like `->inputGroupInputGroupAppendInputGroupTextPrependClass(...)`, to call the `prependClass(...)` method on the `input-group-text` span, which is inside the `input-group-append` div, which is inside the `input-group` div. I know that looks ridiculous, but right now there is no other way to add custom classes or other attributes onto these child elements, so I'd like to get something working for that.

## Contributing

If you'd like to contribute, I'm open to pull requests. This is my first Laravel package, so I'm kind of learning the ropes a little bit, so please bear with me while I get the hang of it.

## License

MIT License

Copyright (c) 2019 Jamin Blount

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.