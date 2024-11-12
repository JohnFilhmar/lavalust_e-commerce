<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Cart
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <?php if($filteredcart): ?>
                <div class="p-4 md:p-5 space-y-4 h-96 overflow-y-auto">
                    <?php foreach($cart as $item): if($item['receipt_number'] == null): ?>
                        <div class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="<?= base_url(); ?>/public/uploads/items/<?= (isset($item)) ? $item['image'] : "" ?>" alt="No Image">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= (isset($item))? $item['itemname'] : "" ?></h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Compatibility : <?= (isset($item))? $item['compatibility'] : "" ?><br/>
                                Price : ₱<?= (isset($item))? $item['price'] : "" ?><br/>
                                x<?= (isset($item) && isset($item['quantity'])) ? ($item['quantity'] > 1 ? $item['quantity'] . " pcs" : $item['quantity'] . " pc") : ""; ?><br/>
                                Total : ₱<?= (isset($item))? $item['total'] : "" ?>
                                </p>
                            </div>
                            <a class="absolute p-5 top-0 right-0 hover:cursor-pointer" href="/removefromcart/<?= (isset($item['id'])) ? $item['id'] : "" ?>">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                            </a>
                            <a class="absolute p-5 bottom-0 right-0 hover:cursor-pointer" href="/changecheck/<?= (isset($item['id'])) ? $item['id'] : "" ?>">
                                <div class="flex items-center justify-center border-2 border-double rounded-md border-gray-200 bg-gray-100 w-8 h-8">
                                    <?php if($item['checked'] == true): ?>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endif; endforeach; ?>
                </div>
            <?php else: ?>
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 19a8 8 0 100-16 8 8 0 000 16zM10 0a2 2 0 110 4 2 2 0 010-4zM6 10a4 4 0 118 0 4 4 0 01-8 0z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-gray-600 mt-4 text-lg">Add an item to the cart</p>
                </div>
            <?php endif; ?>
            <!-- Modal footer -->
            <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <?php if($filteredcart): ?>
                <button data-modal-target="payment-method" data-modal-toggle="payment-method" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Proceed to payment
                </button>
                <?php endif; ?>
                <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Back</button>
            </div>
        </div>
    </div>
</div>
        
<div id="payment-method" tabindex="-1" aria-hidden="true" class="hidden bg-gray-300 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Select Payment Method <span class="text-sm font-thin text-slate-400">Choose your payment method</span>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="payment-method">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form x-data="{ showButtons: true, selectedPayment: 'cash_on_site' }" action="/checkout" method="post">
                <div class="flex flex-row divide-x">
                    <div class="basis-1/2 p-5" x-show="showButtons">
                        <label class="my-2 flex items-center p-4 bg-gray-200 rounded-md cursor-pointer">
                            <button type="button" @click="selectedPayment = 'cash_on_site'">Cash On Site</button>
                        </label>
                        <label class="my-2 flex items-center p-4 bg-gray-200 rounded-md cursor-pointer">
                            <button type="button" @click="selectedPayment = 'paypal'">Paypal</button>
                        </label>
                        <label class="my-2 flex items-center p-4 bg-gray-200 rounded-md cursor-pointer">
                            <button type="button" @click="selectedPayment = 'paymaya'">Paymaya</button>
                        </label>
                        <label class="my-2 flex items-center p-4 bg-gray-200 rounded-md cursor-pointer">
                            <button type="button" @click="selectedPayment = 'card'">Card</button>
                        </label>
                        <label class="my-2 flex items-center p-4 bg-gray-200 rounded-md cursor-pointer">
                            <button type="button" @click="selectedPayment = 'gcash'">Gcash</button>
                        </label>
                    </div>
                    <div class="grow p-5">
                        <div x-show="selectedPayment === 'cash_on_site'" class="cash_on_site">
                            <p class="text-lg font-semibold py-3">CASH UPON PICKUP</p>
                        </div>
                        <div x-show="selectedPayment === 'gcash'" class="gcash">
                            <p class="text-lg font-semibold py-3">GCASH</p>
                        </div>
                        <div x-show="selectedPayment === 'paypal'" class="paypal">
                            <p class="text-lg font-semibold py-3">PAYPAL</p>
                        </div>
                        <div x-show="selectedPayment === 'paymaya'" class="paymaya">
                            <p class="text-lg font-semibold py-3">PAYMAYA</p>
                        </div>
                        <div x-show="selectedPayment === 'card'" class="card">
                            <p class="text-lg font-semibold py-3">CARD</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <input type="hidden" name="payment" value="This is the hidden value" x-bind:value="selectedPayment">
                    <button type="submit" class="mt-8 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                        Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>    