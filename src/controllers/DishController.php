<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Dish.php';
require_once __DIR__.'/../repositories/CategoryRepository.php';
require_once __DIR__.'/../repositories/DishRepository.php';

class DishController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024 * 4;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private CategoryRepository $categoryRepository;
    private DishRepository $dishRepository;
    private array $messages = [];

    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = new CategoryRepository();
        $this->dishRepository = new DishRepository();
    }

    public function addDishView(){
        $this->render('add-dish', [
            'categories' => $this->categoryRepository->getCategories()
        ]);
    }

    public function dishes() {
        $url = "http://";
        $url.= $_SERVER['HTTP_HOST'];
        $url.= $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $categoryTitle = $params['title'];

//        $categoryTitle = $_GET('title');
        $categoryId = $this->categoryRepository->getCategoryIdByCategoryTitle($categoryTitle);
//
        $dishes = $this->dishRepository->findDishesByCategoryId($categoryId);
        $this->render('dishes', ['dishes' => $dishes]);

    }

    public function addDish() {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );


            $dish = new Dish($_POST['name'], $_FILES['file']['name'], $_POST['description'], $_POST['price']);
            $categoryId = $this->categoryRepository->getCategoryIdByCategoryTitle($_POST['title']);
            $this->dishRepository->addDish($dish, $categoryId);

            return $this->render('dishes', [
                'messages' => $this->message,
                'dishes' => $this->dishRepository->findDishesByCategoryId($categoryId)
            ]);
        }

        return $this->render('add-dish', ['messages' => $this->message, 'categories' => $this->categoryRepository->getCategories() ]);
    }
    private function validate($file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = "File is too large for destination file system ";
            return false;
        }
        if(!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = "File type is not supported";
            return false;
        }
        return true;
    }

}