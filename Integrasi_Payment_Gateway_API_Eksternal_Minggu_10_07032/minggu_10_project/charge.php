<?php
require_once 'config.php';

$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => 10000,
);

$item_details = array(
    array(
        'id' => 'a1',
        'price' => 10000,
        'quantity' => 1,
        'name' => "Produk Contoh"
    )
);

$customer_details = array(
    'first_name' => "Andi",
    'email' => "andi@example.com",
    'phone' => "08123456789",
);

$transaction = array(
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
    'customer_details' => $customer_details
);

$snapToken = \Midtrans\Snap::getSnapToken($transaction);
echo json_encode(['token' => $snapToken]);
?>
