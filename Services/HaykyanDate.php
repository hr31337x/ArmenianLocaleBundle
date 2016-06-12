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
 * 
 * ------------------------ՕԳՏԱԳՈՐԾՈՒՄ-----------------------
 * 
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
        'Մարգաց',
        'Հրոտից',
        'Արէգ',
        'Ահեկան',
        'Մարերի',
        'Ավելյաց'
    ];

    /**
     * ավելյաց օրանուններ
     */
    private $avelyac = [
        'Լուծ',
        'Եղջերու',
        'Ծկրավորի',
        'Փառազնոտի',
        'Արտախույր'
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
                $this->setVariant($a[1]);
                $this->date = getdate(strtotime($a[0]));
                $this->createDate();
                break;

            case 5:
                $this->setVariant($a[4]);
                $this->date = getdate(mktime($a[0], 00, 00, $a[1], $a[2], $a[3]));
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
