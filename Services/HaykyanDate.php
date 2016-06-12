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
 * 
 * // Կլաս, որը կառուցում է Բուն Հայկյան Տոմարով ամսաթվեր
 */
class HaykyanDate
{
    //Մասիվներ
    //օրանուններ
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

    //ժամանուններ
    private $HourNames = ['Խաւարականն',  //գիշերվա 00
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

    //ամսանուններ
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

    //ավելյաց օրանուններ
    private $avelyac = [
        'Լուծ',
        'Եղջերու',
        'Ծկրավորի',
        'Արտախույր',
        'Փառազնոտի', ];

    private $EpYr; //Հայկյան տոմարի տարբերությունը մեր թվարկության համակարգինց տարիներով 
    private $YrM;  //ամանորի ամիսը
    private $YrD;  //ամանորի օրը

    private $Date;              //Կոնվերտացվող ամսաթիվը
    private $monthNum;      //Ամսվա համարը
    private $dayNum;          //Օրվա համարը
    private $yearNum;          //Տարին
    private $StartOfThisYear; //Տվյալ տրավա համար տարվա սկզիբը

    public $ArmHourName;      //Հայկյան ժամանուն
    public $ArmDayName;          //Հայկյան օրանուն
    public $ArmMonthName;      //Հայկյան ամսանուն
    public $ArmYear;          //Հայկյան տարի

    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
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

    public function __init2($DateMySql, $tarb)
    {
        $this->setVariant($tarb);
        $this->Date = getdate(strtotime($DateMySql));
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
        $h = $this->Date;
        $this->ArmHourName = $this->HourNames[$h['hours']];

        //Տարվա առաջին օրվա որոշումը
        $this->monthNum = $h['mon'];
        $this->dayNum = $h['mday'];

        $this->StartOfThisYear = getdate(mktime(00, 00, 00, $this->YrM, $this->YrD, $h['year']));

        //Օրերի քանակը, որը անցել է սկսած Օգոստոսի 11-ից, կարող է լինել նաև բացասական
        $daysleft = floor(($this->Date[0] - $this->StartOfThisYear[0]) / 60 / 60 / 24);

        //Բուն Հայկյան Տարի և անցած օրերի ճշտում բացասականի դեպքում
        $this->ArmYear = $this->EpYr + $h['year'] + 1;
        if ($daysleft < 0) {
            $this->ArmYear = $this->ArmYear - 1;
            $this->StartOfThisYear = getdate(mktime(00, 00, 00, $this->YrM, $this->YrD, $h['year'] - 1));
            $daysleft = floor(($this->Date[0] - $this->StartOfThisYear[0]) / 60 / 60 / 24);
        }

        //Բուն Հայկյան Ամսանուն
        //TODO դզել հաշվի առնելով բացասական օրերի հարցը և վերջին ամսվա հավելյալ 5 օրերը
        $monthsleft = floor($daysleft / 30);
        $this->ArmMonthName = $this->monthNames[$monthsleft];

        //Բուն Հայկյան Օրանուններ
        if ($daysleft - 30 * 12 > 0) {
            // ավելյաց ամսվա օրանունները

            $avOr = $daysleft - 30 * 12;
            $this->ArmDayName = $this->avelyac[$avOr];
        } else {
            $daynmbr = $daysleft - floor($daysleft / 30) * 30;
            $this->ArmDayName = $this->dayNames[$daynmbr];
        }
    }

    public function getArmHaykyanDate()
    {
        return [
            'y' => $this->ArmYear,
            'm' => $this->ArmMonthName,
            'd' => $this->ArmDayName,
            'h' => $this->ArmHourName 
        ]
    }

    public function getPropertyes()
    {
        return '<br>ArmYear='.$this->ArmYear.
        '<br>ArmMonthName='.$this->ArmMonthName.
        '<br>ArmDayName='.$this->ArmDayName.
        '<br>ArmHourName='.$this->ArmHourName;
    }
}
