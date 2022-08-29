<?php

namespace MeiTuan;

use MeiTuan\Request\Act;
use MeiTuan\Request\Comment;
use MeiTuan\Request\Delivery;
use MeiTuan\Request\Goods;
use MeiTuan\Request\Im;
use MeiTuan\Request\Image;
use MeiTuan\Request\Medicine;
use MeiTuan\Request\Order;
use MeiTuan\Request\Poi;
use MeiTuan\Request\Retail;
use MeiTuan\Request\Shipping;
use MeiTuan\Request\Task;
use Exception;
use GuzzleHttp\Client;

/**
 * Class Application.
 *
 * @property Comment $comment
 * @property Act $act
 * @property Image $image
 * @property Medicine $medicine
 * @property Order $order
 * @property Poi $poi
 * @property Retail $retail
 * @property Shipping $shipping
 * @property Im $im
 * @property Goods $goods
 * @property Delivery $delivery
 * @property Task $task
 */
class Application
{
    private $config;

    public function __construct($config)
    {
        $this->config = new Config($config);
        $this->client = new Client();
    }

    public function setHttpClient($client)
    {
        $this->client = $client;

        return $this;
    }

    public function __get($name)
    {
        if (! isset($this->$name)) {
            $class_name = ucfirst($name);
            $application = "MeiTuan\\Request\\{$class_name}";
            if (! class_exists($application)) {
                throw new Exception($class_name.'不存在');
            }
            $this->$name = new $application($this->config, $this->client);
        }

        return $this->$name;
    }
}
