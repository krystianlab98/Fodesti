<?php


class Order
{
    private ?int $id;
    private User $purchaser;
    private ?array $dishes;
    private ?string $address;
    private ?int $totalAmount;


    public function __construct(User $purchaser, ?array $dishes,?string $address, ?int $id, ?int $totalAmount )
    {
        $this->id = $id;
        $this->purchaser = $purchaser;
        $this->dishes = $dishes;
        $this->address = $address;
        $this->totalAmount = $totalAmount;
    }


    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    public function addPriceToTotalAmount($price){
        $this->setTotalAmount($this->getTotalAmount() + $price);
    }

    public function subtractPriceFromTotalAmount($price){
        $this->setTotalAmount($this->getTotalAmount() - $price);
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getPurchaser(): User
    {
        return $this->purchaser;
    }


    public function setPurchaser(User $purchaser): void
    {
        $this->purchaser = $purchaser;
    }


    public function getDishes(): array
    {
        return $this->dishes;
    }


    public function setDishes(array $dishes): void
    {
        $this->dishes = $dishes;
    }

    public function addDish($dish): void{
        array_push($this->dishes, $dish);
    }


}