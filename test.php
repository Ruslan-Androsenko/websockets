<?php
require_once __DIR__ . "/vendor/autoload.php";

use Workerman\Worker;

// Create a WebSocket server
$wsWorker = new Worker("websocket://0.0.0.0:8000");

// 4 processes
$wsWorker->count = 4;

// Emitted then new connection come
$wsWorker->onConnect = function ($connection) {
    echo "New connection \n";
};

// Emitted when data received
$wsWorker->onMessage = function ($connection, $data) {
    // Send hello data
    $connection->send("hello {$data} \n");
};

// Emitted when connection closed
$wsWorker->onClose = function ($connection) {
    echo "Connection closed \n";
};



// #### create socket and listen 1234 port ####
$tcpWorker = new Worker("tcp://0.0.0.0:1234");

// 4 processes
$tcpWorker->count = 4;

// Emitted then new connection come
$tcpWorker->onConnect = function ($connection) {
    echo "New connection \n";
};

// Emitted when data received
$tcpWorker->onMessage = function ($connection, $data) {
    // Send hello data
    $connection->send("hello {$data} \n");
};

// Emitted when connection closed
$tcpWorker->onClose = function ($connection) {
    echo "Connection closed \n";
};

// Run worker
Worker::runAll();