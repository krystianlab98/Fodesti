<?php
require_once 'Repository.php';
require_once __DIR__.'/../models/Category.php';

class CategoryRepository extends Repository
{
    public function getCategory(int $id): ?Category {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.categories WHERE id = :id
        ');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $category = $statement->fetch(PDO::FETCH_ASSOC);

        if($category == false) {
            return null;
        }

        return new Category(
            $category['id'],
            $category['title'],
            $category['imageName']
        );
    }

    public function addCategory(Category $category): void
    {

        $statement = $this->database->connect()->prepare('
            INSERT INTO categories(title, image_name)
            VALUES (?, ?)
        ');

        $statement->execute([
            $category->getTitle(),
            $category->getImageName(),

        ]);
    }

    public function getCategories(): array
    {
        $result = [];

        $statement = $this->database->connect()->prepare('
            SELECT * FROM categories;
        ');
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            $result[] = new Category(
                $category['title'],
                $category['image_name']
            );
        }
        return $result;
    }

    public function getCategoryIdByCategoryTitle($title){
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.categories WHERE title = :title
        ');

        $statement->bindParam(':title', $title);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $data['id'];

    }



}