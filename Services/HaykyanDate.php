<?php

/*
 * This file is part of the ArmenianLocaleBundle.
 * Symfony Framework Bundle
 *
 * @author Tigran Azatyan <tigran@azatyan.info>
 * @author Հանուման <http://ablog.gratun.am>
 * @link https://github.com/hanumanum/ArmHaykyanDate/blob/master/dateclass.php
 *
 * @copyright Tigran Azatyan  2013 - 2016
 */

namespace Azatyan\ArmenianLocaleBundle\Services;

/**
 * Class HaykyanDate.
 * 
 * Կառուցում է Բուն Հայկյան Տոմարով ամսաթվեր
 * Աշխատում է միայն մեր թվարկության ամսաթվերի համարՀԱՅԿԱՆ ՏՈՄԱՐԻ ՍԿԻԶԲԸ, ըստ տարբեր աղբյուրների
 * ՏԱՐԲԵՐԱԿ 1 մթա 2492 ,օգոստոսի 11 	աղբյուր https://hayaryakanch.wordpress.com/2011/06/29/%D5%B0%D5%A1%D5%B5%D5%B8%D6%81-%D5%B6%D5%A1%D5%AD%D5%A1%D6%84%D6%80%D5%AB%D5%BD%D5%BF%D5%B8%D5%B6%D5%A5%D5%A1%D5%AF%D5%A1%D5%B6-%D5%BF%D5%B8%D5%B4%D5%A1%D6%80%D5%AB-%D5%A4%D5%AB%D6%81%D5%A1%D5%AF/
 * ՏԱՐԲԵՐԱԿ 2 մթա 2341 ,հուլիսի 14 		աղբյուր https://www.youtube.com/watch?v=1UF6aNYk1qc
 * ստուգումներ կոնվերտեր http://haytomar.com/converter.php?l=am
 * ստուգումներ տարիների աղյուսակ http://ru.wikipedia.org/wiki/%D0%94%D1%80%D0%B5%D0%B2%D0%BD%D0%B5%D0%B0%D1%80%D0%BC%D1%8F%D0%BD%D1%81%D0%BA%D0%B8%D0%B9_%D0%BA%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80%D1%8C
 * ------------------------ՕԳՏԱԳՈՐԾՈՒՄ-----------------------
 * 1) $date = new HaykyanDate(1)
 * կառուցում է ամսաթվի օբյեկտը ներկա պահի համար
 * որտեղ պարամետրը ընդունում է 1 կամ 2 արժեքները, և հաշվարկները կատարվում են ՏԱՐԲԵՐԱԿ 1 կամ ՏԱՐԲԵՐԱԿ 2 -ին համապատասխան
 *
 * 2) $date = new HaykyanDate("2013-10-16 11:12:40",1)
 * որտեղ առաջին արգումենտը MySQL ֆորմատով ամսաթիվն է, երկրորդը՝ հաշվարկի տարբերակը
 * 3) $date = new HaykyanDate(2014,8,11,2,1);
 * որտեղ արգումենտնենրն են համապատասխանաբար տարեթիվ,ամիս,օր,ժամ և տարբերակ
 * 
 */
class HaykyanDate
{
    /**
     * օրանուններ
     */
    private $dayNames = [
        'Արէգ',
        'Հրանդ',
        'Արամ',
        'Մարգար',
        'Ահրանք',
        'Մազդեղ կամ Մազդեկան',
        'Աստղիկ',
        'Միհր',
        'Ձոպաբեր',
        'Մուրց',
        'Երեզկան կամ Երեզհան',
        'Անի',
        'Պարխար',
        'Վանատուր',
        'Արամազդ',
        'Մանի',
        'Ասակ',
        'Մասիս',
        'Անահիտ',
        'Արագած',
        'Գրգուռ',
        'Կորդուիք',
        'Ծմակ',
        'Լուսնակ',
        'Ցրոն կամ Սփյուռ',
        'Նպատ',
        'Վահագն',
        'Սիմ կամ Սեին',
        'Վարագ',
        'Գիշերավար',
    ];

    /**
     *  ժամանուններ
     */
    private $hourNames = [
        'Խաւարականն',
        'Աղջամուղջն',
        'Մթացեալն',
        'Շաղաւոտն',
        'Կամաւօտն',
        'Բաւականն',
        'Հաւթափեալն',
        'Գիզկան',
        'Լուսաճեմն',
        'Առաւոտն',
        'Լուսափայլն',
        'Փայլածումն',
        'Այգն',
        'Ծայգն',
        'Զօրացեալն',
        'Ճառագայթեալն',
        'Շառաւիղեալն',
        'Երկրատեսն',
        'Շանթակալն',
        'Հրակաթն',
        'Հուրթափեալն',
        'Թաղանթեալն',
        'Առաւարն',
        'Արփողն',
    ];

    /**
     * ամսանուններ
     */
    private $monthNames = [
        'Նավասարդ',
        'Հոռի',
        'Սահմի',
        'Տրե',
        'Քաղոց',
        'Արաց',
        'Մեհեկան',
        'Արէգ',
        'Ահեկան',
        'Մարերի',
        'Մարգաց',
        'Հրոտից',
        'Ավելյաց', ];

    /**
     * ավելյաց օրանուններ
     */
    private $avelyac = [
        'Լուծ',
        'Եղջերու',
        'Ծկրավորի',
        'Արտախույր',
        'Փառազնոտի'
    ];


    /**
     * @var
     * Հայկյան տոմարի տարբերությունը մեր թվարկության համակարգինց տարիներով
     */
    private $epYr;

    /**
     * @var
     * ամանորի ամիսը
     */
    private $yrM;

    /**
     * @var
     * ամանորի օրը
     */
    private $yrD;

    /**
     * @var
     * Կոնվերտացվող ամսաթիվը
     */
    private $date;

    /**
     * @var
     * Ամսվա համարը
     */
    private $monthNum;

    /**
     * @var
     * Օրվա համարը
     */
    private $dayNum;

    /**
     * @var
     * Տարին
     */
    private $yearNum;

    /**
     * @var
     * Տվյալ տրավա համար տարվա սկզիբը
     */
    private $startOfThisYear;

    /**
     * @var
     * Հայկյան ժամանուն
     */
    public $armHourName;

    /**
     * @var
     * Հայկյան օրանուն
     */
    public $armDayName;

    /**
     * @var
     * Հայկյան ամսանուն
     */
    public $armMonthName;

    /**
     * @var
     * Հայկյան տարի
     */
    public $armYear;

    /**
     * HaykyanDate
     */
    public function create()
    {
        $a = func_get_args();
        $i = func_num_args();
        switch($i) {
            case 2:
                $this->setVariant($a[0]);
                $this->date = getdate(strtotime($a[1]));
                $this->createDate();
                break;

            case 5:
                $this->setVariant($a[0]);
                $this->date = getdate(mktime($a[1], 00, 00, $a[2], $a[3], $a[4]));
                $this->createDate();
                break;
            default:
                $this->setVariant($a[0]);
                $this->date = getdate();
                $this->createDate();
                break;
        }

        return $this;

    }

    /**
     * @param $variant
     * Ընտրում է հաշվարկների տարբերակներից, տես սքրիփթի սկիզբը
     */
    private function setVariant($variant)
    {
        if ($variant == 1) {
            //Տարբերակ 1 -ի համար
            $this->epYr = 2492; //մթա
            $this->yrM = 8;
            $this->yrD = 11;
        } else {
            //Տարբերակ 2 -ի համար
            $this->epYr = 2341; //մթա
            $this->yrM = 7;
            $this->yrD = 14;
        }
        
        return $this;
    }

    /**
     * @return $this
     */
    private function createDate()
    {
        //Բուն Հայկյան ժամը
        $h = $this->date;
        $this->armHourName = $this->hourNames[$h['hours']];

        //Տարվա առաջին օրվա որոշումը
        $this->monthNum = $h['mon'];
        $this->dayNum = $h['mday'];

        $this->startOfThisYear = getdate(mktime(00, 00, 00, $this->yrM, $this->yrD, $h['year']));

        //Օրերի քանակը, որը անցել է սկսած Օգոստոսի 11-ից, կարող է լինել նաև բացասական
        $daysleft = floor(($this->date[0] - $this->startOfThisYear[0]) / 60 / 60 / 24);

        //Բուն Հայկյան Տարի և անցած օրերի ճշտում բացասականի դեպքում
        $this->armYear = $this->EpYr + $h['year'] + 1;
        if ($daysleft < 0) {
            $this->armYear = $this->armYear - 1;
            $this->startOfThisYear = getdate(mktime(00, 00, 00, $this->yrM, $this->yrD, $h['year'] - 1));
            $daysleft = floor(($this->date[0] - $this->startOfThisYear[0]) / 60 / 60 / 24);
        }

        //Բուն Հայկյան Ամսանուն
        // @TODO դզել հաշվի առնելով բացասական օրերի հարցը և վերջին ամսվա հավելյալ 5 օրերը
        $monthsleft = floor($daysleft / 30);
        $this->armMonthName = $this->monthNames[$monthsleft];

        //Բուն Հայկյան Օրանուններ
        if ($daysleft - 30 * 12 > 0) {
            // ավելյաց ամսվա օրանունները

            $avOr = $daysleft - 30 * 12;
            $this->armDayName = $this->avelyac[$avOr];
        } else {
            $daynmbr = $daysleft - floor($daysleft / 30) * 30;
            $this->armDayName = $this->dayNames[$daynmbr];
        }
        
        return $this;
    }

    /**
     * @return array
     */
    public function get()
    {
        return [
            'y' => $this->armYear,
            'm' => $this->armMonthName,
            'd' => $this->armDayName,
            'h' => $this->armHourName 
        ]
    }
    
    /**
     * @return string
     */
    public function getProperties()
    {
        /* @TODO: whats this doing.? */
        return '<br>ArmYear='.$this->armYear.
        '<br>ArmMonthName='.$this->armMonthName.
        '<br>ArmDayName='.$this->armDayName.
        '<br>ArmHourName='.$this->armHourName;
    }
}
