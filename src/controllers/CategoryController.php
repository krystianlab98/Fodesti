<?php
require_once 'AppController.php';
require_once __DIR__ .'/../models/Category.php';
require_once __DIR__.'/../repositories/CategoryRepository.php';

class CategoryController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024 * 4;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private array $messages = [];
    private array $categories = [];
    private CategoryRepository $categoryRepository;


    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = new CategoryRepository();
    }


    public function addCategoryView(){
        $this->render("add-category");
    }

    public function categories(){
        $this->render('categories', [
            'categories' => $this->categoryRepository->getCategories()
        ]);
    }


    public function addCategory(){
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $category = new Category($_POST['title'], $_FILES['file']['name']);
            $this->categoryRepository->addCategory($category);

            $this->categories[] = $this->categoryRepository->getCategories();

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/categories");
        }

        return $this->render("add-category", ['messages' => $this->messages]);
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