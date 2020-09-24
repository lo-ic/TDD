<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{

    public function testCommissionAmountIs10CentsFormDonationOf100CentsAndCommissionOf10Percent()
    {
        // Etant donné une donation de 100 et commission de 10%
        $donationFees = new \App\Support\DonationFee(100, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 10
        $expected = 10;
        $this->assertEquals($expected, $actual);
    }

    public function testCommissionAmountIs20CentsFormDonationOf200CentsAndCommissionOf10Percent()
    {
        // Etant donné une donation de 100 et commission de 10%
        $donationFees = new \App\Support\DonationFee(200, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 20
        $expected = 20;
        $this->assertEquals($expected, $actual);
    }
    public function testgetAmountCollected()
    {
        //Given
        $donationFees = new \App\Support\DonationFee(100, 10);

        //When
        $actual = $donationFees->getAmountCollected();

        //Then
        $expected = 40;
        $this->assertEquals($expected, $actual);
    }

    public function testgetComissionsPercentage()
    {
        $this->expectException('Exception');

        $donationFees = new \App\Support\DonationFee(100, 31);
 
    }

    public function testDonationInf100()
    {
        $this->expectException('Exception');

        $donationFees = new \App\Support\DonationFee(99, 10);
    }

    public function testMaximumTotalCommissionEquals500()
    {
        //given
        $donationFees = new \App\Support\DonationFee(10000, 10);

        //when
        $actual = $donationFees->getFixedAndComissionFeeAmount();

        //then
        $expected = 500;
        $this->assertEquals($expected, $actual);
    }

    public function testArraySummary()
    {
        //given
        $donationFees = new \App\Support\DonationFee(1000,10);

        //when
        $actual = $donationFees->getSummary();

        //then
        $expected = [
            'dotation'=> 1000,
            'fixedFee'=> 50,
            'commission'=>100,
            'fixedAndCommission'=>150,
            'amountCollected'=>850
        ];
        $this->assertEquals($expected, $actual);
    }
}
