[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](Resources/meta/LICENSE)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/da6b8260-237c-4b08-bbbc-dfb8613fd388/mini.png)](https://insight.sensiolabs.com/projects/da6b8260-237c-4b08-bbbc-dfb8613fd388)
[![Build Status](https://travis-ci.org/azatyan/ArmenianLocaleBundle.svg?branch=master)](https://travis-ci.org/azatyan/ArmenianLocaleBundle) [![Total Downloads](https://poser.pugx.org/azatyan/armenian-locale-bundle/downloads.svg)](https://packagist.org/packages/azatyan/armenian-locale-bundle) [![Latest Stable Version](https://poser.pugx.org/azatyan/armenian-locale-bundle/v/stable.svg)](https://packagist.org/packages/azatyan/armenian-locale-bundle)
[![HHVM Status](https://img.shields.io/hhvm/azatyan/armenian-locale-bundle.svg?style=flat-square)](http://hhvm.h4cc.de/package/azatyan/armenian-locale-bundle)


Armenian Locale Bundle / Հայկական Ֆունկցիաներ
====================

Հայկական և հայամետ ֆունկցիաներ՝ Symfony ֆրեյմվորքի համար և ոչ միայն

Armenian Localisation methods/functions integrate to Symfony Web Framework as Bundle

Installation  / Տեղադրում 
=======
```bash
composer require "azatyan/armenian-locale-bundle";
```
Activate The Bundle in Symfony's  AppKernel.php file
```php
new Azatyan\ArmenianLocaleBundle\AzatyanArmenianLocaleBundle(),
```
Usage / Օգտագործում
=======
<p>0. PHP ում կլասները կարելի է օգտագործել ուղիղ կերպով՝ առանց սերվիսների</p>
<p>1.  Տրանսլիտից հայատառ փոփոխում / Translit Service</p>
```php
$this->get("armenian.locale.translit")->latinToArmenian("Barev");  // (string) "Բարև"
```
<p>2.  Կոդավորման փոփոխում / Encoding Service</p>
```php
$this->get("armenian.locale.encoding")->unicodeToArmscii("Barev");  // (string) with Armscii encoding;
$this->get("armenian.locale.encoding")->armsciiToUnicode("Barev");  // (string) with Unicode encoding;
```
<p>3. Հայկական .հայ և .am դոմեյնային գոտիների հարցում / WhoIs Service</p>
```php
$this->get("armenian.locale.whois")->get("amnic.am");  //  (string) whois data
```
<p>4. Հայկյան օրացույցով ամսաթվի ստացում /  Haykyan Date</p>
```php
$this->get("armenian.locale.date.hayk")->create(1)->get(); // See Azatyan\ArmenianLocaleBundle\Services\HaykyanDate class for details
```

<p>5. Այլ / Helper</p>
* Այբուբեն / Alphabet
```php
$this->get("armenian.locale.helper")->getAlphabet($capital=true);  //  (array) armenian alphabet
```





Կոդը հանդիսանում է Symfony Հայաստան նախագծի մաս
This Code is Part Of <a href="https://www.symfony.am">Symfony Armenia</a>

Point 1 and 2 are converted from JavaSctipt algoritm (source: http://hayeren.am/)
