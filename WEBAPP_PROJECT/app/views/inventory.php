<?php
    include 'template/header.php';
?>
    <div class="p-4 container mx-auto">
        <div class="overflow-y-auto max-h-96 h-96 rounded-lg bg-gray-200 container mx-auto mb-5">
            <div class="flex justify-between">
                <p class="text-2xl font-bold p-5 m-5">Inventory</p>
                <a href="#additem" class="text-2xl font-bold p-5 m-5 text-blue-900 bg-blue-300 rounded-lg">Add An Item</a>
            </div>
            <div class="relative overflow-x-auto shadow-md text-center">
                <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Compatibility
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date Added
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
                            </th>
                            <?php if($role == 'ADMIN'): ?>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <?= (isset($product['id']) ? $product['id'] : "" ); ?>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= (isset($product['id']) ? $product['itemname'] : "" ); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= (isset($product['id']) ? $product['compatibility'] : "" ); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= (isset($product['id']) ? $product['description'] : "" ); ?>
                                </td>
                                <td class="px-6 py-4">
                                    ₱<?= (isset($product['id']) ? $product['price'] : "" ); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= (isset($product['id']) ? $product['date_added'] : "" ); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="<?= $role == 'ADMIN' ? 'flex justify-between' : 'text-center' ?>">
                                        <?php if($role == 'ADMIN'): ?>
                                        <a href="/plusproduct/<?= $product['id']; ?>">
                                            <svg class="w-4 h-4 hover:text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                            </svg>
                                        </a>
                                        <?php endif; ?>
                                        <span>
                                            <?= (isset($product['id']) ? $product['quantity'] : "" ); ?>
                                        </span>
                                        <?php if($role == 'ADMIN'): ?>
                                        <a <?= ($product['quantity'] < 1) ? 'class="disabled:opacity-75 pointer-events-none"' : '' ?> href="/minusproduct/<?= $product['id']; ?>">
                                            <svg class="w-4 h-4 hover:text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                            </svg>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <?php if($role == 'ADMIN'): ?>
                                <td class="px-6 py-4 flex gap-2 justify-between">
                                    <a href="/edititem/<?= (isset($product['id'])? $product['id'] : "" ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <svg class="w-4 h-4 hover:text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                            <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                        </svg>
                                    </a>
                                    <a href="/deleteitem/<?= (isset($product['id'])? $product['id'] : "" ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <svg class="w-4 h-4 hover:text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                        </svg>
                                    </a>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="additem" class="rounded-lg pb-4">
            <p class="text-2xl font-bold my-5 py-5"><?= (isset($toedit['id'])) ? "Edit Item" : "Add Item" ?></p>
            <form class="mx-auto mb-5" action="<?= (isset($toedit['id'])) ? "/submitedit/" . $toedit['id'] : "/createitem" ?>" method="post" enctype="multipart/form-data">
                <div class="relative z-0 w-full mb-5 group">
                    <input maxlength="255" value="<?= (isset($toedit['id'])) ? $toedit['itemname'] : "" ?>" required type="text" name="itemname" id="itemname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="itemname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Item Name
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input maxlength="255" value="<?= (isset($toedit['id'])) ? $toedit['compatibility'] : "" ?>" required type="text" name="compatibility" id="compatibility" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="compatibility" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Compatibility
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add am item description..."><?= (isset($toedit['id'])) ? $toedit['description'] : "" ?></textarea>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <input maxlength="10" value="<?= (isset($toedit['id'])) ? $toedit['price'] : "" ?>" required type="number" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Price
                        </label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input maxlength="10" value="<?= (isset($toedit['id'])) ? $toedit['quantity'] : "" ?>" required type="number" name="quantity" id="quantity" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="quantity" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Quantity
                        </label>
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                        Upload file
                    </label>
                    <input required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image_help" name="image" id="image" type="file" accept="image/*">
                    <?php if (isset($toedit['id'])): ?>
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">
                            Current file: <?= $toedit['image'] ?>
                        </div>
                    <?php else: ?>
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">
                            Add an appropriate image of the item. Must be a valid image.
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
<?php
    include 'template/footer.php';
?>