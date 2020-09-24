<?php

namespace App\Support;

use Exception;

class DonationFee
{

    private $donation;
    private $commissionPercentage;
    private const FIXEDFEE = 50;

    public function __construct(int $donation, int $commissionPercentage)
    {
        if ($commissionPercentage < 0 || $commissionPercentage > 30)         
        {             
            throw new Exception("Commission percentage invalid");         
        }         
        else $this->commissionPercentage = $commissionPercentage;


        if ($donation <100)
        {
            throw new Exception("Donation number invalid");
        }
        else $this->donation = $donation;

    }

    public function getCommissionAmount()
    {   //Fix getcomissionamount
        return $this->donation*$this->commissionPercentage/100;

    }

    public function getAmountCollected()
    {
        return $this->donation-$this->getFixedAndComissionFeeAmount();
    }

    public function getFixedAndComissionFeeAmount()
    {
        $total = self::FIXEDFEE+$this->getCommissionAmount();
        if ($total>500){
            $total =500;

        }
        return $total;
    }

    public function getSummary()
    {
        $summary=array();
        $summary['dotation']=$this->donation;
        $summary['fixedFee']=self::FIXEDFEE;
        $summary['commission']=$this->getCommissionAmount();
        $summary['fixedAndCommission']=$this->getFixedAndComissionFeeAmount();
        $summary['amountCollected']=$this->getAmountCollected();

        return $summary;
    }
}
