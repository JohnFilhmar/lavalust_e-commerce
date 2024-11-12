<?php
    include 'template/header.php';
?>
<div class="container mx-auto p-8 font-sans h-screen max-h-screen overflow-y-auto" x-data="{ buttons: true, selectedOrders: 'all' }">
    <h1 class="text-2xl font-bold mb-8">Order Processing</h1>

    <div class="rounded-md shadow-sm w-full flex justify-between text-center divide-x" role="group" x-show="buttons">
        <button  @click="selectedOrders = 'all'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
            All
        </button>
        <button  @click="selectedOrders = 'processing'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
            Processing
        </button>
        <button  @click="selectedOrders = 'processed'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
            Processed
        </button>
        <button  @click="selectedOrders = 'completed'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
            Completed
        </button>
    </div>

    <div x-show="selectedOrders === 'all'">
        <!-- Order Details -->
        <?php foreach($receipts as $r): ?>
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-4">Receipt Number : <?= isset($r['id'])? $r['id'] : "" ?></h2>
            <!-- Product List -->
            <ul class="divide-y">
                <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                <li class="flex justify-between items-center mb-2">
                    <div class="flex items-center space-x-4">
                        <img src="<?= base_url() . '/public/uploads/items/' . $c['image'] ?>" alt="Product 1" class="w-16 h-16 object-cover rounded">
                        <div>
                            <p class="font-bold text-xl"><?= isset($c['itemname'])? $c['itemname'] : "" ?></p>
                            <p class="text-gray-600">x<?= isset($c['quantity'])? $c['quantity'] . ($c['quantity'] > 1 ? " pcs" : " pc") : "" ?></p>
                            <p class="text-gray-600">₱<?= isset($c['price'])? $c['price'] : "" ?></p>
                        </div>
                    </div>
                    <p class="font-semibold">₱<?= isset($c['total'])? $c['total'] : "" ?></p>
                </li>
                <?php endif; endforeach; ?>
            </ul>

            <!-- Order Total -->
            <div class="flex justify-end mt-4">
                <p class="text-xl font-bold">
                    Total: ₱<?= isset($r['total_amount'])? $r['total_amount'] : "" ?><br/>
                    Payment Method: <?= isset($r['payment_method'])? strtoupper($r['payment_method']) : "" ?>
                </p>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Order Status</h2>
            <!-- Status Steps -->
            <div class="flex justify-between flex-row space-x-4">
                <div class="flex flex-row gap-5">
                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSING', 'PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processing</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processed</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && $r['status'] == 'COMPLETED' ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Completed</p>
                </div>
                <a <?= $r['status'] != 'COMPLETED'? 'href="/changestatus/' . $r['id'] . '"' : 'href="#"' ?>>
                    <button type="button" class="text-white bg-<?= $r['status'] == 'COMPLETED'? "green" : "blue" ?>-700 hover:bg-<?= $r['status'] == 'COMPLETED'? "green" : "blue" ?>-800 focus:ring-4 focus:outline-none focus:ring-<?= $r['status'] == 'COMPLETED'? "green" : "blue" ?>-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-<?= $r['status'] == 'COMPLETED'? "green" : "blue" ?>-600 dark:hover:bg-<?= $r['status'] == 'COMPLETED'? "green" : "blue" ?>-700 dark:focus:ring-<?= $r['status'] == 'COMPLETED'? "green" : "blue" ?>-800">
                        <?= isset($r['id']) ? (
                            match ($r['status']) {
                                'PROCESSING' => 'Process',
                                'PROCESSED'  => 'Complete',
                                default      => 'Order Completed'
                            }
                        ) : '' ?>
                        <?php if($r['status'] != 'COMPLETED'): ?>
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                        <?php endif; ?>
                    </button>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div x-show="selectedOrders === 'processing'">
        <!-- Order Details -->
        <?php foreach($receipts as $r):  if($r['status'] == 'PROCESSING'): ?>
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-4">Receipt Number : <?= isset($r['id'])? $r['id'] : "" ?></h2>
            <!-- Product List -->
            <ul class="divide-y">
                <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                <li class="flex justify-between items-center mb-2">
                    <div class="flex items-center space-x-4">
                        <img src="<?= base_url() . '/public/uploads/items/' . $c['image'] ?>" alt="Product 1" class="w-16 h-16 object-cover rounded">
                        <div>
                            <p class="font-bold text-xl"><?= isset($c['itemname'])? $c['itemname'] : "" ?></p>
                            <p class="text-gray-600">x<?= isset($c['quantity'])? $c['quantity'] . ($c['quantity'] > 1 ? " pcs" : " pc") : "" ?></p>
                            <p class="text-gray-600">₱<?= isset($c['price'])? $c['price'] : "" ?></p>
                        </div>
                    </div>
                    <p class="font-semibold">₱<?= isset($c['total'])? $c['total'] : "" ?></p>
                </li>
                <?php endif; endforeach; ?>
            </ul>

            <!-- Order Total -->
            <div class="flex justify-end mt-4">
                <p class="text-xl font-bold">
                    Total: ₱<?= isset($r['total_amount'])? $r['total_amount'] : "" ?><br/>
                    Payment Method: <?= isset($r['payment_method'])? strtoupper($r['payment_method']) : "" ?>
                </p>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Order Status</h2>
            <!-- Status Steps -->
            <div class="flex justify-between flex-row space-x-4">
                <div class="flex flex-row gap-5">
                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSING', 'PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processing</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processed</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && $r['status'] == 'COMPLETED' ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Completed</p>
                </div>
                <a href="/changestatus/<?= $r['id']; ?>">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= isset($r['id']) ? (
                            match ($r['status']) {
                                'PROCESSING' => 'Process',
                                'PROCESSED'  => 'Complete',
                                default      => 'Modify'
                            }
                        ) : '' ?>
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
        <?php endif; endforeach; ?>
    </div>
    <div x-show="selectedOrders === 'processed'">
        <!-- Order Details -->
        <?php foreach($receipts as $r):  if($r['status'] == 'PROCESSED'): ?>
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-4">Receipt Number : <?= isset($r['id'])? $r['id'] : "" ?></h2>
            <!-- Product List -->
            <ul class="divide-y">
                <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                <li class="flex justify-between items-center mb-2">
                    <div class="flex items-center space-x-4">
                        <img src="<?= base_url() . '/public/uploads/items/' . $c['image'] ?>" alt="Product 1" class="w-16 h-16 object-cover rounded">
                        <div>
                            <p class="font-bold text-xl"><?= isset($c['itemname'])? $c['itemname'] : "" ?></p>
                            <p class="text-gray-600">x<?= isset($c['quantity'])? $c['quantity'] . ($c['quantity'] > 1 ? " pcs" : " pc") : "" ?></p>
                            <p class="text-gray-600">₱<?= isset($c['price'])? $c['price'] : "" ?></p>
                        </div>
                    </div>
                    <p class="font-semibold">₱<?= isset($c['total'])? $c['total'] : "" ?></p>
                </li>
                <?php endif; endforeach; ?>
            </ul>

            <!-- Order Total -->
            <div class="flex justify-end mt-4">
                <p class="text-xl font-bold">
                    Total: ₱<?= isset($r['total_amount'])? $r['total_amount'] : "" ?><br/>
                    Payment Method: <?= isset($r['payment_method'])? strtoupper($r['payment_method']) : "" ?>
                </p>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Order Status</h2>
            <!-- Status Steps -->
            <div class="flex justify-between flex-row space-x-4">
                <div class="flex flex-row gap-5">
                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSING', 'PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processing</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processed</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && $r['status'] == 'COMPLETED' ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Completed</p>
                </div>
                <a href="/changestatus/<?= $r['id']; ?>">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= isset($r['id']) ? (
                            match ($r['status']) {
                                'PROCESSING' => 'Process',
                                'PROCESSED'  => 'Complete',
                                default      => 'Modify'
                            }
                        ) : '' ?>
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
        <?php endif; endforeach; ?>
    </div>
    <div x-show="selectedOrders === 'completed'">
        <!-- Order Details -->
        <?php foreach($receipts as $r):  if($r['status'] == 'COMPLETED'): ?>
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-4">Receipt Number : <?= isset($r['id'])? $r['id'] : "" ?></h2>
            <!-- Product List -->
            <ul class="divide-y">
                <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                <li class="flex justify-between items-center mb-2">
                    <div class="flex items-center space-x-4">
                        <img src="<?= base_url() . '/public/uploads/items/' . $c['image'] ?>" alt="Product 1" class="w-16 h-16 object-cover rounded">
                        <div>
                            <p class="font-bold text-xl"><?= isset($c['itemname'])? $c['itemname'] : "" ?></p>
                            <p class="text-gray-600">x<?= isset($c['quantity'])? $c['quantity'] . ($c['quantity'] > 1 ? " pcs" : " pc") : "" ?></p>
                            <p class="text-gray-600">₱<?= isset($c['price'])? $c['price'] : "" ?></p>
                        </div>
                    </div>
                    <p class="font-semibold">₱<?= isset($c['total'])? $c['total'] : "" ?></p>
                </li>
                <?php endif; endforeach; ?>
            </ul>

            <!-- Order Total -->
            <div class="flex justify-end mt-4">
                <p class="text-xl font-bold">
                    Total: ₱<?= isset($r['total_amount'])? $r['total_amount'] : "" ?><br/>
                    Payment Method: <?= isset($r['payment_method'])? strtoupper($r['payment_method']) : "" ?>
                </p>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Order Status</h2>
            <!-- Status Steps -->
            <div class="flex justify-between flex-row space-x-4">
                <div class="flex flex-row gap-5">
                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSING', 'PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processing</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && in_array($r['status'], ['PROCESSED', 'COMPLETED']) ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Processed</p>

                    <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 <?= isset($r['status']) && $r['status'] == 'COMPLETED' ? 'bg-blue-500' : 'bg-gray-300' ?> rounded-full"></div>
                    </div>
                    <p class="text-gray-600">Completed</p>
                </div>
                <a <?= $r['status'] != 'COMPLETED'? 'href="/changestatus/' . $r['id'] . '"' : 'href="#"' ?>>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <?= isset($r['id']) ? (
                            match ($r['status']) {
                                'PROCESSING' => 'Process',
                                'PROCESSED'  => 'Complete',
                                default      => 'Order Complete'
                            }
                        ) : '' ?>
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
        <?php endif; endforeach; ?>
    </div>
</div>
<?php
    include 'template/footer.php';
?>