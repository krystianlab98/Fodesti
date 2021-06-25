<?php
require_once 'AppController.php';
require_once __DIR__ .'/../models/Order.php';
require_once __DIR__ .'/../models/Dish.php';
require_once __DIR__.'/../repositories/OrderRepository.php';
require_once __DIR__.'/../controllers/UserController.php';

class OrderController extends AppController
{
    private Order $order;
    private array $dishes;
    private UserController $userController;
    private OrderRepository $orderRepository;
    private DishRepository $dishRepository;


    public function __construct()
    {
        parent::__construct();
        $this->userController = new UserController();
        $this->orderRepository = new OrderRepository();
        $this->dishRepository = new DishRepository();
        $this->order = new Order($this->userController->getUserFromSession(), array());
        $this->dishes = array();
    }

    public function cart(){

        $dish1 = $this->dishRepository->getDishById(2);
        $dish2 = $this->dishRepository->getDishById(3);
        $dish3 = $this->dishRepository->getDishById(4);

        $this->dishes[] = $dish1;
        $this->dishes[] = $dish2;
        $this->dishes[] = $dish3;
        $this->order->setDishes($this->dishes);

        $this->order->addPriceToTotalAmount($dish1->getPrice()+ $dish2->getPrice() + $dish3->getPrice());

        return $this->render('order', ['order' => $this->order]);
    }

    /**
     * @throws Exception
     */
    public function order(){
        if ($this->isPost()){
            $this->order->setAddress($_POST['address']);

        $dishQuantity= count($_POST['dishName']);

            for ($i = 0; $i < $dishQuantity; $i++)
                {
                        $id = (int)$_POST['dishId'][$i];
                        $name = $_POST['dishName'][$i];
                        $description = $_POST['description'][$i];
                        $price = (int)$_POST['price'][$i];
                        $imageName = $_POST['image-name'][$i];
                        $categoryId = (int) $_POST['categoryId'][$i];
                        $dish = new Dish($name,$imageName, $description, $price, $id, $categoryId);
                        $this->order->addDish($dish);
                        $this->order->addPriceToTotalAmount($price);
                }


            $this->orderRepository->saveOrder($this->order);
        }
        $this->order->setDishes(array());
        return $this->render("index");
    }

    public function orders() {
        $userId = $this->userController->getUserFromSession()->getId();
        $ordersDB = $this->orderRepository->getUserOrders($userId);
        $orders = $this->mapOrderFromDbToModel($ordersDB);

        return $this->render('orders', ['orders' => $orders] );
    }


    public function addDishToOrder(Dish $dish)
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header("Content-type: application/json");
            http_response_code(200);

            $this->order->addDish($dish);
            $this->order->addPriceToTotalAmount($dish->getPrice());
        }
    }


    public function removeDishFromOrder(Dish $dish){

        $this->order->setDishes(array_diff($this->order->getDishes(), (array)$dish));

    }

    private function mapOrderFromDbToModel($orders):array {
        $result = array();
        $dishes = array();
        foreach ($orders as $dbOrder){
            $dishes[] = $this->mapDishesFromDbToModel($this->orderRepository->getDishesByOrderId($dbOrder["id"]));
            $purchaser = $this->userController->getUserFromSession();
            $order = new Order($purchaser, $dishes, $dbOrder["address"], $dbOrder["id"], $dbOrder["totalAmount"]);
            $result[] = $order;
        }

        return $result;
    }

    private function mapDishesFromDbToModel($dishes):array {
        $result = array();

        foreach ($dishes as $dbDish){
            $dish = new Dish($dbDish["name"], $dbDish["image_name"], $dbDish["description"], $dbDish["price"], $dbDish["dish_id"], $dbDish["categories_id"]);
            $result[] = $dish;
        }
        return $result;
    }



}