<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectFactory
{
    private $title;
    private $createdAtTime;
    private $contractedAt;
    private $deadline;
    private $isChain;
    private $hasOutsource;
    private $hasInvestors;
    private $isOnTime;
    private $workerCount;
    private $serviceCount;
    private $comment;
    private $effectiveValue;
    private $paymentFirstStep;
    private $paymentSecondStep;
    private $paymentThirdStep;
    private $paymentFourthStep;

    /**
     * @param $title
     * @param $createdAtTime
     * @param $contractedAt
     * @param $deadline
     * @param $isChain
     * @param $hasOutsource
     * @param $hasInvestors
     * @param $isOnTime
     * @param $workerCount
     * @param $serviceCount
     * @param $comment
     * @param $effectiveValue
     * @param $paymentFirstStep
     * @param $paymentSecondStep
     * @param $paymentThirdStep
     * @param $paymentFourthStep
     */
    public function __construct($title, $createdAtTime, $contractedAt, $deadline, $isChain, $hasOutsource, $hasInvestors, $isOnTime, $workerCount, $serviceCount, $comment, $effectiveValue, $paymentFirstStep, $paymentSecondStep, $paymentThirdStep, $paymentFourthStep)
    {
        $this->title = $title;
        $this->createdAtTime = $createdAtTime;
        $this->contractedAt = $contractedAt;
        $this->deadline = $deadline;
        $this->isChain = $isChain;
        $this->hasOutsource = $hasOutsource;
        $this->hasInvestors = $hasInvestors;
        $this->isOnTime = $isOnTime;
        $this->workerCount = $workerCount;
        $this->serviceCount = $serviceCount;
        $this->comment = $comment;
        $this->effectiveValue = $effectiveValue;
        $this->paymentFirstStep = $paymentFirstStep;
        $this->paymentSecondStep = $paymentSecondStep;
        $this->paymentThirdStep = $paymentThirdStep;
        $this->paymentFourthStep = $paymentFourthStep;
    }


    /**
     * @return mixed
     */
    public static function make($row)
    {
        return new self(
            $row['naimenovanie'],
            Date::excelToDateTimeObject($row['data_sozdaniia']),
            isset($row['podpisanie_dogovora']) ? Date::excelToDateTimeObject($row['podpisanie_dogovora']) : null,
            Date::excelToDateTimeObject($row['dedlain']) ?? null,
            $row['setevik'] ? self::getBoolean($row['setevik']) : null,
            $row['nalicie_autsorsinga'] ? self::getBoolean($row['nalicie_autsorsinga']) : null,
            $row['nalicie_investorov'] ? self::getBoolean($row['nalicie_investorov']) : null,
            $row['sdaca_v_srok'] ? self::getBoolean($row['sdaca_v_srok']) : null,
            $row['kolicestvo_ucastnikov'],
            $row['kolicestvo_uslug'],
            $row['kommentarii'],
            $row['znacenie_effektivnosti'],
            $row['vlozenie_v_pervyi_etap'],
            $row['vlozenie_vo_vtoroi_etap'],
            $row['vlozenie_v_tretii_etap'],
            $row['vlozenie_v_cetvertyi_etap'],
        );
    }

    private static function getBoolean($item): bool
    {
        return $item == 'Да';
    }

    public function getValues(): array
    {
        $props = get_object_vars($this);
        $res = [];
        foreach ($props as $prop => $value) {
            $res[Str::snake($prop)] = $value;
        }
        return $res;
    }
}
