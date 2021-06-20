<?php
require_once 'Repository.php';
require_once __DIR__.'/../models/Dish.php';

class DishRepository extends Repository
{

    public function findDishesByCategoryId(int $categoryId): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.dishes 
                        WHERE categories_id = :categoryId'
        );

        $statement->bindParam(':categoryId', $categoryId);
        $statement->execute();
        $dishes = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dishes as $dish) {
            $result[] = new Dish(
                $dish['name'],
                $dish['image_name'],
                $dish['description'],
                $dish['price']
            );
        }
        return $result;
    }

    public function addDish($dish, $categoryId)
    {
        $statement = $this->database->connect()->prepare('
            INSERT INTO public.dishes(name, image_name, description, price, categories_id)
            VALUES (?, ?, ?, ?, ?)
        ');

        $statement->execute([
            $dish->getName(),
            $dish->getImageName(),
            $dish->getDescription(),
            $dish->getPrice(),
            $categoryId
        ]);
    }

}