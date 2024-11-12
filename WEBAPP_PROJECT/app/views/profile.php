<?php
    include 'template/header.php';
?>
<div class="container mx-auto mt-5 mb-5 h-full">
    <div class="flex flex-col lg:flex-row">
            <div class="grow pr-2 mr-2">
                <div class="container mx-auto flex flex-col">
                    <div class="p-5 grow w-full h-full bg-gray-500 rounded-lg">
                        <h3 class="text-2xl text-slate-700 font-bold">Order History</h3>
                    </div>
                    <div class="flex flex-col gap-5"  x-data="{ showButtons: true, selectedPayment: 'all' }">
                        <div class="rounded-md shadow-sm w-full flex justify-between text-center divide-x" role="group" x-show="showButtons">
                            <button  @click="selectedPayment = 'all'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
                                All
                            </button>
                            <button  @click="selectedPayment = 'processing'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
                                Processing
                            </button>
                            <button  @click="selectedPayment = 'processed'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
                                Processed
                            </button>
                            <button  @click="selectedPayment = 'completed'" type="button" class="py-2 px-5 grow bg-gray-100 active:bg-gray-200 hover:bg-gray-300 font-semibold">
                                Completed
                            </button>
                        </div>
                        <div class="grow w-full max-h-screen h-screen overflow-y-auto" x-show="selectedPayment === 'all'">
                            <?php foreach($receipts as $r): ?>
                                <div class="my-2 bg-gray-300 flex flex-col divide-y">
                                    <div class="flex justify-between p-2">
                                        <p class="text-lg font-bold">Receipt Number : <?= (isset($r['id']))? $r['id'] : "" ?>
                                        <p class="text-lg font-bold"><?= (isset($r['id']))? $r['status'] : "" ?>
                                    </div>
                                        <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                                            <div class="flex flex-row">
                                                <img class="basis-1/4 p-3 object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="<?= base_url(); ?><?= (isset($c)) ? '/public/uploads/items/' . $c['image'] : "" ?>" alt="No Image">
                                                <div class="flex flex-col gap-2 grow">
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                        <?= (isset($c['id']))? $c['itemname'] : "" ?>
                                                    </h5>
                                                    <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">
                                                    Compatibility :  <?= (isset($c['id']))? $c['compatibility'] : "" ?><br/>
                                                    x  <?= (isset($c['id']))? $c['quantity'] : "" ?><br/>
                                                    </p>
                                                </div>
                                                <div class="p-3 my-auto basis-1/2 flex ">
                                                    <!-- <p class="pr-4 line-through mb-3 font-thin text-md text-gray-700 dark:text-gray-400">
                                                        ₱ old price
                                                    </p> -->
                                                    <p class="mb-3 font-semibold text-lg text-gray-700 dark:text-gray-400">
                                                        ₱<?= (isset($c['price']))? $c['price'] : "" ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; endforeach; ?>
                                        <div class="p-3 flex justify-between">
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Payment : <?= strtoupper((isset($r['id'])) ? $r['payment_method'] : "") ?>
                                            </p>
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Total : ₱<?= (isset($r['id'])) ? $r['total_amount'] : "" ?>
                                            </p>
                                        </div>
                                    <div class="flex justify-between">
                                        <!-- buttons -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="grow w-full max-h-screen h-screen overflow-y-auto" x-show="selectedPayment === 'processing'">
                            <?php foreach($receipts as $r): if($r['status'] == 'PROCESSING'):  ?>
                                <div class="my-2 bg-gray-300 flex flex-col divide-y">
                                    <div class="flex justify-between p-2">
                                        <p class="text-lg font-bold">Receipt Number : <?= (isset($r['id']))? $r['id'] : "" ?>
                                        <p class="text-lg font-bold"><?= (isset($r['id']))? $r['status'] : "" ?>
                                    </div>
                                        <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                                            <div class="flex flex-row">
                                                <img class="basis-1/4 p-3 object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="<?= base_url(); ?><?= (isset($c)) ? '/public/uploads/items/' . $c['image'] : "" ?>" alt="No Image">
                                                <div class="flex flex-col gap-2 grow">
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                        <?= (isset($c['id']))? $c['itemname'] : "" ?>
                                                    </h5>
                                                    <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">
                                                    Compatibility :  <?= (isset($c['id']))? $c['compatibility'] : "" ?><br/>
                                                    x1<br/>
                                                    </p>
                                                </div>
                                                <div class="p-3 my-auto basis-1/2 flex ">
                                                    <!-- <p class="pr-4 line-through mb-3 font-thin text-md text-gray-700 dark:text-gray-400">
                                                        ₱ old price
                                                    </p> -->
                                                    <p class="mb-3 font-semibold text-lg text-gray-700 dark:text-gray-400">
                                                        ₱<?= (isset($c['price']))? $c['price'] : "" ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; endforeach; ?>
                                        <div class="p-3 flex justify-between">
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Payment : <?= strtoupper((isset($r['id'])) ? $r['payment_method'] : "") ?>
                                            </p>
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Total : ₱<?= (isset($r['id'])) ? $r['total_amount'] : "" ?>
                                            </p>
                                        </div>
                                    <div class="flex justify-between">
                                        <!-- buttons -->
                                    </div>
                                </div>
                            <?php endif; endforeach; ?>
                        </div>
                        <div class="grow w-full max-h-screen h-screen overflow-y-auto" x-show="selectedPayment === 'processed'">
                            <?php foreach($receipts as $r): if($r['status'] == 'PROCESSED'):  ?>
                                <div class="my-2 bg-gray-300 flex flex-col divide-y">
                                    <div class="flex justify-between p-2">
                                        <p class="text-lg font-bold">Receipt Number : <?= (isset($r['id']))? $r['id'] : "" ?>
                                        <p class="text-lg font-bold"><?= (isset($r['id']))? $r['status'] : "" ?>
                                    </div>
                                        <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                                            <div class="flex flex-row">
                                                <img class="basis-1/4 p-3 object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="<?= base_url(); ?><?= (isset($c)) ? '/public/uploads/items/' . $c['image'] : "" ?>" alt="No Image">
                                                <div class="flex flex-col gap-2 grow">
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                        <?= (isset($c['id']))? $c['itemname'] : "" ?>
                                                    </h5>
                                                    <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">
                                                    Compatibility :  <?= (isset($c['id']))? $c['compatibility'] : "" ?><br/>
                                                    x1<br/>
                                                    </p>
                                                </div>
                                                <div class="p-3 my-auto basis-1/2 flex ">
                                                    <!-- <p class="pr-4 line-through mb-3 font-thin text-md text-gray-700 dark:text-gray-400">
                                                        ₱ old price
                                                    </p> -->
                                                    <p class="mb-3 font-semibold text-lg text-gray-700 dark:text-gray-400">
                                                        ₱<?= (isset($c['price']))? $c['price'] : "" ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; endforeach; ?>
                                        <div class="p-3 flex justify-between">
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Payment : <?= strtoupper((isset($r['id'])) ? $r['payment_method'] : "") ?>
                                            </p>
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Total : ₱<?= (isset($r['id'])) ? $r['total_amount'] : "" ?>
                                            </p>
                                        </div>
                                    <div class="flex justify-between">
                                        <!-- buttons -->
                                    </div>
                                </div>
                            <?php endif; endforeach; ?>
                        </div>
                        <div class="grow w-full max-h-screen h-screen overflow-y-auto" x-show="selectedPayment === 'completed'">
                            <?php foreach($receipts as $r): if($r['status'] == 'COMPLETED'):  ?>
                                <div class="my-2 bg-gray-300 flex flex-col divide-y">
                                    <div class="flex justify-between p-2">
                                        <p class="text-lg font-bold">Receipt Number : <?= (isset($r['id']))? $r['id'] : "" ?>
                                        <p class="text-lg font-bold"><?= (isset($r['id']))? $r['status'] : "" ?>
                                    </div>
                                        <?php foreach($cart as $c): if($c['receipt_number'] == $r['id']): ?>
                                            <div class="flex flex-row">
                                                <img class="basis-1/4 p-3 object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="<?= base_url(); ?><?= (isset($c)) ? '/public/uploads/items/' . $c['image'] : "" ?>" alt="No Image">
                                                <div class="flex flex-col gap-2 grow">
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                        <?= (isset($c['id']))? $c['itemname'] : "" ?>
                                                    </h5>
                                                    <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">
                                                    Compatibility :  <?= (isset($c['id']))? $c['compatibility'] : "" ?><br/>
                                                    x1<br/>
                                                    </p>
                                                </div>
                                                <div class="p-3 my-auto basis-1/2 flex ">
                                                    <!-- <p class="pr-4 line-through mb-3 font-thin text-md text-gray-700 dark:text-gray-400">
                                                        ₱ old price
                                                    </p> -->
                                                    <p class="mb-3 font-semibold text-lg text-gray-700 dark:text-gray-400">
                                                        ₱<?= (isset($c['price']))? $c['price'] : "" ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; endforeach; ?>
                                        <div class="p-3 flex justify-between">
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Payment : <?= strtoupper((isset($r['id'])) ? $r['payment_method'] : "") ?>
                                            </p>
                                            <p class="mb-3 font-bold text-lg text-gray-700 dark:text-gray-400">
                                                Total : ₱<?= (isset($r['id'])) ? $r['total_amount'] : "" ?>
                                            </p>
                                        </div>
                                    <div class="flex justify-between">
                                        <!-- buttons -->
                                    </div>
                                </div>
                            <?php endif; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <div class="basis-1/2">
            <div class="container mx-auto flex">
                <div class="p-5 grow w-full h-full bg-gray-500 rounded-lg">
                    <h3 class="text-2xl text-slate-700 font-bold">User Profile</h3>
                </div>
            </div>
            <div class="flex justify-center">
                <img class="mt-5 mb-5 w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" src="<?= base_url(); ?>/public/<?= isset($userImage) ? "uploads/users/" . $userImage : "profile.png" ?>" alt="<?= base_url(); ?>/public/profile.png">
            </div>
            <form class="px-3 py-5 border-4 w-full h-full container mx-auto text-center gap-4" action="/profileEdit/<?= (isset($userId)) ? $userId : "" ?>" enctype="multipart/form-data" method="post">
                <div class="relative z-0 w-full mb-5 group">
                    <input autocomplete="true" maxlength="255" value="<?= (isset($userName)) ? $userName : "" ?>" type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <label for="username" class="peer-focus:font-medi   um absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Username
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input autocomplete="true" placeholder="<?= (isset($userEmail)) ? '' : 'Add an email' ?>" maxlength="255" value="<?= (isset($userEmail)) ? $userEmail : "" ?>" type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                    <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email
                    </label>
                </div>
                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="avatar">Upload file</label>
                    <input required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="avatar" name="avatar" type="file">
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="avatar">A profile picture to add an avatar to your account</div>
                </div>
                <button type="submit" class="col-span-2 mt-5 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
    include 'template/footer.php';
?>