<?php

namespace App\Common;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class RabbitMQ
{
    private $host = '127.0.0.1';
    private $port = 5672;
    private $user = 'guest';
    private $password = 'guest';
    private $vhost = '/';
    protected $connection;
    protected $channel;

    /**
     * RabbitMQ constructor.
     */
    public function __construct()
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password, $this->vhost);
        $this->channel    = $this->connection->channel();
    }

    /**
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param $exchangeName
     * @param $type
     * @param $passive
     * @param $durable
     * @param $autoDelete
     */
    public function createExchange($exchangeName, $type, $passive = false, $durable = false, $autoDelete = false)
    {
        $this->channel->exchange_declare($exchangeName, $type, $passive, $durable, $autoDelete);
    }

    /**
     * @param $queueName
     * @param $passive
     * @param $durable
     * @param $exclusive
     * @param $autoDelete
     */
    public function createQueue($queueName, $passive = false, $durable = false, $exclusive = false, $autoDelete = false, $nowait = false, $arguments = [])
    {
        $this->channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $nowait, $arguments);
    }

    /**
     * @param $exchangeName
     * @param $queue
     * @param string $routing_key
     * @param bool $nowait
     * @param array $arguments
     * @param null $ticket
     */
    public function bindQueue($queue, $exchangeName, $routing_key = '',
                              $nowait = false,
                              $arguments = array(),
                              $ticket = null)
    {
        $this->channel->queue_bind($queue, $exchangeName, $routing_key, $nowait, $arguments, $ticket);
    }

    /**
     * 生成信息
     * @param $message
     */
    public function sendMessage($message, $routeKey, $exchange = '', $properties = [])
    {
        $data = new AMQPMessage(
            $message, $properties
        );
        $this->channel->basic_publish($data, $exchange, $routeKey);
    }

    /**
     * 消费消息
     * @param $queueName
     * @param $callback
     * @throws \ErrorException
     */
    public function consumeMessage($queueName, $callback, $tag = '', $noLocal = false, $noAck = false, $exclusive = false, $noWait = false)
    {
        //只有consumer已经处理并确认了上一条message时queue才分派新的message给它
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume($queueName, $tag, $noLocal, $noAck, $exclusive, $noWait, $callback);
        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    /**
     * @throws \Exception
     */
    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * 创建延时队列
     * @param $ttl
     * @param $delayExchange
     * @param $delayQueue
     * @param $queue
     */
    public function createDelayQueue($ttl, $delayExchange, $delayQueue, $queue)
    {
        $args = new AMQPTable([
            'x-dead-letter-exchange'    => $delayExchange,
            'x-dead-letter-routing-key' => $queue, // 默认死信路由键名是队列名称
            'x-message-ttl'             => $ttl, //队列消息存活时间，如果设置了expiration，以小的时间为准
        ]);
        $this->channel->queue_declare($queue, false, true, false, false, false, $args);
        $this->channel->queue_declare($delayQueue, false, true, false, false);
        $this->channel->exchange_declare($delayExchange, AMQPExchangeType::DIRECT, false, true, false);
        
        // 绑定死信路由键->延时交换机->延时队列
        $this->channel->queue_bind($delayQueue, $delayExchange, $queue, false);
    }

    /**
     * 测试延时队列生产者
     * @throws \ErrorException
     */
    public function testDelayProducer()
    {
        $ttl           = 10000; // 10s后超时
        $delayExchange = 'delay_order_exchange';// 超时exchange
        $delayQueue    = 'delay_order_queue'; // 超时queue，实际消费的队列
        $deadQueue     = 'dead_order_queue'; // 订单死信queue

        $this->createDelayQueue($ttl, $delayExchange, $delayQueue, $deadQueue);

        for ($i = 1; $i <= 10; $i++) {
            // x-message-ttl
//            $data = ['order_id' => $i];
//            $this->sendMessage(json_encode($data), $queue);
//            sleep(2);

            // 或者自定义每个消息的存活时间
            $data = ['ttl' => $i * 3 * 1000];

            $properties = [
                'content-type'  => 'application/json',
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                'expiration'    => $i * 3 * 1000, // ttl
            ];
            $this->sendMessage(json_encode($data), $deadQueue, '', $properties);
        }
    }

    /**
     * 测试延时队列消费者
     * @throws \ErrorException
     */
    public function testDelayConsumer()
    {
        $delayQueue = 'delay_order_queue';
        $this->channel->queue_declare($delayQueue, false, true, false, false);
        $this->consumeMessage($delayQueue, function (AMQPMessage $message) {
            var_dump(json_decode($message->body, true));
            $ret = true;
            if ($ret) {
                $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
            } else {
                $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);
            }
            //sleep(1);
        });
    }
}
