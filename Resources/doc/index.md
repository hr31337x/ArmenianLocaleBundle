Installation
=======
```bash
composer require "azatyan/armenian-locale-bundle";
```
Activate The Bundle in Symfony's  AppKernel.php file
```php
new Azatyan\ArmenianLocaleBundle\AzatyanArmenianLocaleBundle(),
```
Usage
=======
<p>1. Translit Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a>).</p>
```php
$this->get("armenian.locale.translit")->latinToArmenian("Barev");  // (string) "Բարև"
```
<p>2. Encoding Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a> ).</p>
```php
$this->get("armenian.locale.encoding")->unicodeToArmscii("Barev");  // (string) with Armscii encoding;
$this->get("armenian.locale.encoding")->armsciiToUnicode("Barev");  // (string) with Unicode encoding;
```
<p>3. WhoIs Service</p>
```php
$this->get("armenian.locale.whois")->get("amnic.am");  //  (string) whois data
```
<p>3. Helper</p>
* Alphabet
```php
$this->get("armenian.locale.helper")->getAlphabet($capital=true);  //  (array) armenian alphabet
```
