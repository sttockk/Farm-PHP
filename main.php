<?php

abstract class Animals
{
    protected $id;

    public abstract function getProduct();
}

class Chicken extends Animals
{
    public function __construct()
    {
        $this->id = substr(mt_rand(), 0 , 6);
    }

    public function getProduct():int
    {
        return rand(0,1);
    }
}

class Cow extends Animals
{
    public function __construct()
    {
        $this->id = substr(mt_rand(), 0 , 6);
    }

    public function getProduct():int
    {
        return rand(8, 12);
    }
}

class AnimalHouse
{
    public $cows;
    public $chickens;

    public function addCow(int $cow)
    {
        $this->cows += $cow;
    }

    public function addChicken(int $chicken)
    {
        $this->chickens += $chicken;
    }
}

class ProductHouse
{
    public $milk = 0;
    public $eggs = 0;

    public function addMilk(int $milk)
    {
        $this->milk += $milk;
    }

    public function addEggs(int $eggs)
    {
        $this->eggs += $eggs;
    }

    public function getMilk(): int
    {
        return $this->milk;
    }

    public function getEggs(): int
    {
        return $this->eggs;
    }
}

class AnimalFactory
{
    public static function createChicken(): chicken
    {
        return new chicken;
    }

    public static function createCow(): cow
    {
        return new cow;
    }
}
class Farm
{
    public $animals = [];
    private $productHouse;

    public function __construct(ProductHouse $productHouse)
    {
        $this->productHouse = $productHouse;
    }

    public function getAllMilk()
    {
        return $this->productHouse->getMilk();

    }

    public function getAllEggs()
    {
        return $this->productHouse->getEggs();
    }

    public function addAnimals($animal)
    {
        $this->animals[] = $animal;
    }
    public function getProducts()
    {
        foreach ($this->animals as $animal)
        {
            if ($animal instanceof Cow) {
                $countMilk = $animal->getProduct();
                $this->productHouse->addMilk($countMilk);
            }

            if ($animal instanceof Chicken) {
                $countEggs = $animal->getProduct();
                $this->productHouse->addEggs($countEggs);
            }
        }
    }

}

$animalHouse = new AnimalHouse();

$animalHouse->addChicken(10);
$animalHouse->addCow(20);

$productHouse = new ProductHouse();
$farm = new Farm($productHouse);


// creating cows
for($i=1;$i<=$animalHouse->cows;$i++){
    $farm->addAnimals(AnimalFactory::createCow());
}

// creating chickens
for($i=1;$i<=$animalHouse->chickens;$i++)
{
    $farm->addAnimals(AnimalFactory::createChicken());
}

$farm->getProducts();

echo 'Молока '.$farm->getAllMilk(). ' л.' . '<br>';
echo 'Яиц '.$farm->getAllEggs(). ' ш.' . '<br>';
