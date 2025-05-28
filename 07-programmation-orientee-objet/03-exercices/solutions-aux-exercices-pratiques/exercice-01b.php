<?php

class Person {
    private $firstName;
    private $lastName;
    private $age;
    private $email;

    public function __construct($firstName, $lastName, $age, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function getFullName() {
        return "{$this->firstName} {$this->lastName}";
    }

    public function isAdult() {
        return $this->age >= 18;
    }

    public function getEmailDomain() {
        $parts = explode('@', $this->email);

        if (count($parts) == 2) {
            return $parts[1];
        }

        return '';
    }
}

$janeDoe = new Person('Jane', 'Doe', 25, 'jane.doe@example.com');
$johnSmith = new Person('John', 'Smith', 17, 'john.smith');

echo "Full Name: " . $janeDoe->getFullName() . "<br>";
echo "Is Adult: " . ($janeDoe->isAdult() ? 'Yes' : 'No') . "<br>";
echo "Email: " . $janeDoe->getEmail() . "<br>";

$janeDoeEmailDomain = $janeDoe->getEmailDomain();

if (empty($janeDoeEmailDomain)) {
    $janeDoeEmailDomain = 'Invalid';
}
echo "Email Domain: " . $janeDoeEmailDomain . "<br>";

echo "Full Name: " . $johnSmith->getFullName() . "<br>";
echo "Is Adult: " . ($johnSmith->isAdult() ? 'Yes' : 'No') . "<br>";
echo "Email: " . $johnSmith->getEmail() . "<br>";

$johnSmithEmailDomain = $johnSmith->getEmailDomain();

if (empty($johnSmithEmailDomain)) {
    $johnSmithEmailDomain = 'Invalid';
}
echo "Email Domain: " . $johnSmithEmailDomain . "<br>";
