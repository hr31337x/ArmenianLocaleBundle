<?php

/*
 * This file is part of the ArmenianLocaleBundle.
 * Symfony Framework Bundle
 *
 * @author Tigran Azatyan <tigran@azatyan.info>
 *
 * @copyright Tigran Azatyan  2013 - 2016
 */

namespace Azatyan\ArmenianLocaleBundle\Services;

/**
 * Class HaykyanDate.
 * 
 * Կառուցում է Բուն Հայկյան Տոմարով ամսաթվեր
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

    /*
     *  ժամանուններ
     */
    private $hourNames = ['Խաւարականն',  //գիշերվա 00
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
        'Փառազնոտի', ];

    private $epYr; //Հայկյան տոմարի տարբերությունը մեր թվարկության համակարգինց տարիներով
    private $yrM;  //ամանորի ամիսը
    private $yrD;  //ամանորի օրը

    private $date;              //Կոնվերտացվող ամսաթիվը
    private $monthNum;      //Ամսվա համարը
    private $dayNum;          //Օրվա համարը
    private $yearNum;          //Տարին
    private $startOfThisYear; //Տվյալ տրավա համար տարվա սկզիբը

    public $armHourName;      //Հայկյան ժամանուն
    public $armDayName;          //Հայկյան օրանուն
    public $armMonthName;      //Հայկյան ամսանուն
    public $armYear;          //Հայկյան տարի

    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();

        // @TODO: whats this? :/
        if (method_exists($this, $f = '__init'.$i)) {
            call_user_func_array([$this, $f], $a);
        }
    }

    public function __init1($tarb)
    {
        $this->setVariant($tarb);
        $this->Date = getdate();
        $this->createArmDate();
    }

    public function __init2($dateMySql, $tarb)
    {
        $this->setVariant($tarb);
        $this->Date = getdate(strtotime($dateMySql));
        $this->createArmDate();
    }

    public function __init5($year, $month, $day, $hour, $tarb)
    {
        $this->setVariant($tarb);
        $this->Date = getdate(mktime($hour, 00, 00, $month, $day, $year));
        $this->createArmDate();
    }

    /**
     * @param $tarb
     * Ընտրում է հաշվարկների տարբերակներից, տես սքրիփթի սկիզբը
     */
    private function setVariant($tarb)
    {
        if ($tarb == 1) {
            //Տարբերակ 1 -ի համար
            $this->EpYr = 2492; //մթա
            $this->YrM = 8;
            $this->YrD = 11;
        } else {
            //Տարբերակ 2 -ի համար
            $this->EpYr = 2341; //մթա
            $this->YrM = 7;
            $this->YrD = 14;
        }
    }

    private function createArmDate()
    {
        //Բուն Հայկյան ժամը
        $h = $this->date;
        $this->armHourName = $this->HourNames[$h['hours']];

        //Տարվա առաջին օրվա որոշումը
        $this->monthNum = $h['mon'];
        $this->dayNum = $h['mday'];

        $this->dtartOfThisYear = getdate(mktime(00, 00, 00, $this->yrM, $this->yrD, $h['year']));

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
        //TODO դզել հաշվի առնելով բացասական օրերի հարցը և վերջին ամսվա հավելյալ 5 օրերը
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
    }

    public function getArmHaykyanDate()
    {
        return [
            'y' => $this->armYear,
            'm' => $this->armMonthName,
            'd' => $this->armDayName,
            'h' => $this->armHourName 
        ]
    }

    public function getPropertyes()
    {
        return '<br>ArmYear='.$this->armYear.
        '<br>ArmMonthName='.$this->armMonthName.
        '<br>ArmDayName='.$this->armDayName.
        '<br>ArmHourName='.$this->armHourName;
    }
}
