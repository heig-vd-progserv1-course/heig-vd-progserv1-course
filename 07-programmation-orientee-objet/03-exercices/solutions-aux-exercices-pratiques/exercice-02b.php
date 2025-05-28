<?php
class Vehicle {
    private $numberOfWheels;
    private $color;
    private $brand;
    private $model;

    public function __construct($numberOfWheels, $color, $brand, $model) {
        $this->numberOfWheels = $numberOfWheels;
        $this->color = $color;
        $this->brand = $brand;
        $this->model = $model;
    }

    public function getNumberOfWheels() {
        return $this->numberOfWheels;
    }

    public function setNumberOfWheels($numberOfWheels) {
        $this->numberOfWheels = $numberOfWheels;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getDescription() {
        return "$this->brand $this->model, $this->color, $this->numberOfWheels wheels";
    }

    public function type() {
        if ($this->numberOfWheels == 2) {
            return "Motorcycle";
        } elseif ($this->numberOfWheels == 4) {
            return "Car";
        } elseif ($this->numberOfWheels > 4) {
            return "Truck";
        } else {
            return "Unknown";
        }
    }
}

$toyota = new Vehicle(4, 'Red', 'Toyota', 'Corolla');
$yamaha = new Vehicle(2, 'Black', 'Yamaha', 'MT-07');
$volvo = new Vehicle(6, 'Blue', 'Volvo', 'FH16');
$ufo = new Vehicle(0, 'Green', 'UFO', 'X-2000');

echo $toyota->getDescription() . " - Type: " . $toyota->type() . "<br>";
echo $yamaha->getDescription() . " - Type: " . $yamaha->type() . "<br>";
echo $volvo->getDescription() . " - Type: " . $volvo->type() . "<br>";
echo $ufo->getDescription() . " - Type: " . $ufo->type() . "<br>";
