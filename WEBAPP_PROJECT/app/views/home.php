<?php
    include 'template/header.php';
?>
    <div class="flex justify-start w-full py-5 px-5 bg-gray-700 font-semibold text-3xl text-gray-200 mb-5">
        <h2>E-Shop</h2>
    </div>
    <div class="p-5 container mx-auto">
    <?php if (!isset($products) || empty($products)): ?>
        <div class="bg-white p-8 rounded-lg shadow-md text-center h-screen">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 19a8 8 0 100-16 8 8 0 000 16zM10 0a2 2 0 110 4 2 2 0 010-4zM6 10a4 4 0 118 0 4 4 0 01-8 0z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-600 mt-4 text-lg">No items available</p>
        </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 overflow-auto">
                <?php foreach($products as $product): if($product['quantity'] > 0): ?>
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="<?= base_url(); ?>/public/uploads/items/<?= (isset($product["id"]))? $product["image"] : "" ?>" alt='No image to show' />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 data-item-name="<?= (isset($product["id"])) ? $product["itemname"] : "" ?>" data-compatibility="<?= (isset($product["id"])) ? $product["compatibility"] : "" ?>" class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= (isset($product["id"]))? $product["itemname"] . " - " : "" ?><?= (isset($product["id"]))? $product["compatibility"] : "" ?></h5>
                            </a>
                            <p data-description="<?= (isset($product["id"])) ? $product["description"] : "" ?>" class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?= (isset($product["id"]))? $product["description"] : "" ?></p>
                            <p data-price="<?= (isset($product["id"])) ? $product["price"] : 0 ?>" class="mb-3 font-bold text-gray-700 dark:text-gray-400">Price : <?= (isset($product["id"]))? " ₱" . $product["price"] : "" ?></p>
                            <p data-quantity="<?= (isset($product["id"])) ? $product["quantity"] : 0 ?>" class="mb-3 font-bold text-gray-700 dark:text-gray-400">Available : <?= (isset($product["id"]))? $product["quantity"] . ($product['quantity'] > 1 ? "pcs" : "pc") : "" ?></p>
                            <a href="/addtocart/<?= (isset($product['id'])) ? $product['id'] : "" ?>" id="addToCart" data-product-id="<?= (isset($product["id"])) ? $product["id"] : 0 ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="m-2 w-6 h-6 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5h4m-2 2V3M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.938-11H17l-2 7H5m0 0L3 4m0 0h2M3 4l-.792-3H1"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php
    include 'template/footer.php';
?>