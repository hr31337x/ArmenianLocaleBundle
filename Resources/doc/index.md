Install
=======
```bash
php composer.phar require "armcoder/armenian-locale-bundle";
php composer.phar update;
```
Activate The Bundle in Symfony's  AppKernel.php file
```php
new ArmCoder\ArmenianLocaleBundle\ArmCoderArmenianLocaleBundle(),
```
Usage
=============
<p>1. Translit Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a> project for JS Logic.</p>
```php
$this->get("armcoder.locale.translit")->latinToArmenian("Barev");  // returns (string) "Բարև"
```
<p>2. Encoding Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a> project for JS Logic.</p>
```php
$this->get("armcoder.locale.encoding")->Unicode2Armscii("Barev");  // returns some with the Armscii encoding;
$this->get("armcoder.locale.encoding")->Armscii2Unicode("Barev");  // returns some with the Unicode encoding;
```

<p>2. Whois Service</p>
```php
$this->get("armcoder.locale.whois")->get("amnic.am");  // returns text whois data
```
