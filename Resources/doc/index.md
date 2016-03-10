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
$this->get("azatyan.locale.translit")->latinToArmenian("Barev");  // (string) "Բարև"
```
<p>2. Encoding Service (thanks to <a target="_blank" href="http://hayeren.am/">www.hayeren.am</a> ).</p>
```php
$this->get("azatyan.locale.encoding")->unicodeToArmscii("Barev");  // (string) with Armscii encoding;
$this->get("azatyan.locale.encoding")->armsciiToUnicode("Barev");  // (string) with Unicode encoding;
```
<p>3. WhoIs Service</p>
```php
$this->get("azatyan.locale.whois")->get("amnic.am");  //  (string) whois data
```
