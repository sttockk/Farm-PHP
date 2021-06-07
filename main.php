<?php

abstract class Animals
{
    protected $id;

    abstract public function getProduct();
}

class Chicken extends Animals
{
    public function __construct()
    {
        $this->id = substr(mt_rand(), 0 , 6);
    }

    public function getProduct(): int
    {
        return rand(0, 1);
    }
}

class Cow extends Animals
{
    public function __construct()
    {
        $this->id = substr(mt_rand(), 0 , 6);
    }

    public function getProduct(): int
    {
        return rand(8, 12);
    }
}

class AnimalHouse
{
    public const COUNT_OF_COWS = 10;
    public const COUNT_OF_CHICKENS = 20;
}

class Farm
{
    private $eggs;
    private $milk;

    public function getEggs(): int
    {
        for ($i = 1; $i < AnimalHouse::COUNT_OF_CHICKENS; $i++)
        {
            $chicken = new Chicken();
            $this->eggs += $chicken->getProduct();
        }
        return $this->eggs;
    }

    public function getMilk(): int
    {
        for ($i = 1; $i < AnimalHouse::COUNT_OF_COWS; $i++)
        {
            $cow = new Cow();
            $this->milk += $cow->getProduct();
        }
        return $this->milk;
    }
}

$farm = new Farm();

echo 'Яиц: ' . $farm->getEggs() . ' ш.' . '<br>';
echo 'Молока: ' . $farm->getMilk() . ' л.' .'<br>';
