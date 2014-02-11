Installation
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
=======
<p>1. Translit Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a>).</p>
```php
$this->get("armcoder.locale.translit")->latinToArmenian("Barev");  // (string) "Բարև"
```
<p>2. Encoding Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a> ).</p>
```php
$this->get("armcoder.locale.encoding")->Unicode2Armscii("Barev");  // (string) with Armscii encoding;
$this->get("armcoder.locale.encoding")->Armscii2Unicode("Barev");  // (string) with Unicode encoding;
```
<p>3. Whois Service</p>
```php
$this->get("armcoder.locale.whois")->get("amnic.am");  //  (string) whois data
```