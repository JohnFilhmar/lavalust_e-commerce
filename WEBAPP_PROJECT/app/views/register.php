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
            <h3 class="text-3xl font-bold dark:text-white text-center card-header">Create an Account</h3><br>    
            <form action="/createaccount" method="post" class="card-body">
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Your new username
                    </label>
                    <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your username. . ." required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Your new password
                    </label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your password. . . (8 characters or more)" minlength="8" required>
                </div>
                <div class="mb-6">
                    <label for="secretkey" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Secret Key 
                    </label>
                    <input value="novalue" type="password" id="secretkey" name="secretkey" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter secret key. . ." required>
                    <span class="text-xs font-thin text-gray-400 font-serif tracking-tight">KEYS are provided by an administrator.</span>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <button type="submit" class="w-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create Account
                    </button>
                    <a class="w-100 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" href="/login">
                        Go Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url(); ?>/public/assets/flowbite.min.js"></script>
</body>

</html>
