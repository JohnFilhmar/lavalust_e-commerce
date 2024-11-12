<?php
    include 'template/header.php';
?>
    <div class="rounded-lg container mx-auto h-screen max-h-screen overflow-y-auto">
            <p class="text-2xl font-bold p-5 m-5">User Accounts</p>
            <div class="relative overflow-x-auto shadow-md text-center">
                <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                User Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date Created
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): if($user['role'] != 'ADMIN'): ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <?= (isset($user['id']) ? $user['id'] : "" ); ?>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= (isset($user['id']) ? $user['username'] : "" ); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= ($user['email'] != null ? $user['email'] : "<span class='text-red-600'>No Email</span>" ); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= (isset($user['id']) ? $user['datetime_created'] : "" ); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= (isset($user['id']) ? $user['role'] : "" ); ?>
                                </td>
                                <td class="px-6 py-4 flex gap-2 justify-between">
                                    <a href="/toggleaccess/<?= (isset($user['id'])? $user['id'] : "" ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <?php if($user['status'] == 'UP'): ?>
                                            <svg class="w-6 h-6 hover:text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7 7.674 1.3a.91.91 0 0 0-1.348 0L1 7"/>
                                            </svg>
                                        <?php elseif($user['status'] == 'DOWN'): ?>
                                            <svg class="w-6 h-6 hover:text-red-900 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
                                            </svg>
                                        <?php endif; ?>
                                    </a>
                                    <a href="/deleteuser/<?= (isset($user['id'])? $user['id'] : "" ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <svg class="w-4 h-4 hover:text-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    include 'template/footer.php';
?>