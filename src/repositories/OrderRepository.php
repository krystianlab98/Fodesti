<?php
require_once 'Repository.php';
require_once __DIR__.'/../models/Order.php';

class OrderRepository extends Repository
{

    public function getUserOrders($userId): array
    {
        $statement = $this->database->connect()->prepare('
           SELECT o.id, password, user_id, address, date_of_order,email, "totalAmount"
                FROM orders as o
                INNER JOIN users u on u.id = o.user_id
                WHERE user_id = :userId;
        ');
        $statement->bindParam(':userId', $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @throws Exception
     */
    public function saveOrder(Order $order)
    {
        try {
            $this->database->connect()->beginTransaction();
            $statement = $this->database->connect()->prepare('
            INSERT INTO public.orders(user_id, address,"totalAmount", date_of_order)
            VALUES (?,?,?,NOW())
        ');

            $statement->execute([
                $order->getPurchaser()->getId(),
                $order->getAddress(),
                $order->getTotalAmount()
            ]);

            $order->setId($this->getLastOrderId());

            $statement = $this->database->connect()->prepare('
            INSERT INTO public.orders_dishes(order_id, dish_id)
            VALUES (?, ?)');

            $dishes = $order->getDishes();
            foreach ($dishes as $dish) {
                $statement->execute([
                    $order->getId(),
                    $dish->getId(),
                ]);
            }
            $this->database->connect()->inTransaction();
        }  catch (PDOException $exception) {
            $this->database->connect()->rollBack();
            throw new Exception("transaction error insert user");
        }

    }

    public function getDishesByOrderId($orderId): array{


            $statement = $this->database->connect()->prepare('
            SELECT dish_id, name, image_name, description, price, categories_id FROM orders_dishes as od
                  INNER JOIN dishes d on d.id = od.dish_id
                  WHERE od.order_id = :id    
            ');
            $statement->bindParam(':id', $orderId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastOrderId(): int{
        $statement = $this->database->connect()->prepare('
            SELECT id FROM public.orders ORDER BY id DESC LIMIT 1
        ');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['id'];
    }
}