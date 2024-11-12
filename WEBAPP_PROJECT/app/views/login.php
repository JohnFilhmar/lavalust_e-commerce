<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JMS</title>
    <link href="<?= base_url(); ?>/public/assets/flowbite.min.css"  rel="stylesheet" />
</head>

<body>
    <div class="flex items-center justify-center min-h-screen" style="margin-top: 200px; margin-left: 20px; margin-right: 20px;">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 mt-8">
            <h3 class="text-3xl font-bold dark:text-white text-center card-header">Login</h3><br>    
            <form action="/auth" method="post" class="card-body">
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                    <input type="username" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your username. . ." required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your password. . . (8 characters or more)" minlength="8" required>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <button type="submit" class="w-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    <a class="w-100 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" href="/register">Register</a>
                </div>
                <a href="/shop" class="flex justify-center mt-3">
                    <button type="button" class="w-fit focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <div class="flex flex-row gap-3">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z"/>
                            </svg>
                            <p>
                                Browse Shop
                            </p>
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z"/>
                            </svg>
                        </div>
                    </button>
                </a>
                <?= (isset($fail) && !isset($success))? 
                
                "<div id='alert-border-2' class=' mt-2 rounded flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800' role='alert'>
                    <svg class='flex-shrink-0 w-4 h-4' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 20 20'>
                    <path d='M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z'/>
                    </svg>
                    <div class='ms-3 text-sm font-medium'>
                    " . $fail . "
                    </div>
                    <button type='button' class='ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700'  data-dismiss-target='#alert-border-2' aria-label='Close'>
                        <span class='sr-only'>Dismiss</span>
                        <svg class='w-3 h-3' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 14 14'>
                            <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'/>
                        </svg>
                    </button>
                </div>"

                : "" ?>
                <?= (isset($success) && !isset($fail))? 
                
                "<div id='alert-border-3' class='mt-2 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800' role='alert'>
                <svg class='flex-shrink-0 w-4 h-4' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 20 20'>
                <path d='M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z'/>
                </svg>
                <div class='ms-3 text-sm font-medium'>
                " . $success . "
                </div>
                <button type='button' class='ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700'  data-dismiss-target='#alert-border-3' aria-label='Close'>
                <span class='sr-only'>Dismiss</span>
                <svg class='w-3 h-3' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 14 14'>
                    <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'/>
                </svg>
                </button>
                </div>"

                : "" ?>
            </form>
        </div>
    </div>
    <script src="<?= base_url(); ?>/public/assets/flowbite.min.js"></script>
</body>

</html>
