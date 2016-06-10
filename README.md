Armenian Locale Bundle
====================

Armenian Localisation methods/functions integrate to Symfony Web Framework as Bundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/da6b8260-237c-4b08-bbbc-dfb8613fd388/big.png)](https://insight.sensiolabs.com/projects/da6b8260-237c-4b08-bbbc-dfb8613fd388)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](Resources/meta/LICENSE)
[![Build Status](https://travis-ci.org/azatyan/ArmenianLocaleBundle.svg?branch=master)](https://travis-ci.org/azatyan/ArmenianLocaleBundle) [![Total Downloads](https://poser.pugx.org/azatyan/armenian-locale-bundle/downloads.svg)](https://packagist.org/packages/azatyan/armenian-locale-bundle) [![Latest Stable Version](https://poser.pugx.org/azatyan/armenian-locale-bundle/v/stable.svg)](https://packagist.org/packages/azatyan/armenian-locale-bundle)
[![HHVM Status](https://img.shields.io/hhvm/azatyan/armenian-locale-bundle.svg?style=flat-square)](http://hhvm.h4cc.de/package/azatyan/armenian-locale-bundle)


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
<p>1. Translit Service</p>
```php
$this->get("armenian.locale.translit")->latinToArmenian("Barev");  // (string) "Բարև"
```
<p>2. Encoding Service</p>
```php
$this->get("armenian.locale.encoding")->unicodeToArmscii("Barev");  // (string) with Armscii encoding;
$this->get("armenian.locale.encoding")->armsciiToUnicode("Barev");  // (string) with Unicode encoding;
```
<p>3. WhoIs Service</p>
```php
$this->get("armenian.locale.whois")->get("amnic.am");  //  (string) whois data
```
<p>4. Helper</p>
* Alphabet
```php
$this->get("armenian.locale.helper")->getAlphabet($capital=true);  //  (array) armenian alphabet
```

This Bundle Is Part Of <a href="https://www.symfony.am">Symfony Armenia Project</a>

Point 1 and 2 are converted from JavaSctipt algoritm ( Thanks to http://hayeren.am/ Project)

Feedback email: tigran@azatyan.info
