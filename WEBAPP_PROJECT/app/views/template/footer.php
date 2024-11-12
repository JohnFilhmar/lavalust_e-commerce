<footer class="bg-white rounded-lg shadow dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="<?= base_url(); ?>/public/jms.png" class="w-20 h-20" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Shop</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="/about" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="/policies" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="/licensing" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="/contact" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="/" class="hover:underline">AmpelDevs™</a>. All Rights Reserved.</span>
        </div>
    </footer>
    <?php if ($message != null) : ?>
        <div id="alert-container" class="fixed top-0 left-0 w-full h-full flex items-center justify-center pointer-events-none">
            <div class="flex items-center p-4 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 alert-fade" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium"><?= $message ?></span>
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const alertContainer = document.getElementById('alert-container');
                alertContainer.classList.add('alert-fade-out');
                alertContainer.addEventListener('animationend', () => {
                    alertContainer.remove();
                });
            }, 3000);
        </script>
    <?php endif; ?>
    <script src="<?= base_url(); ?>/public/assets/flowbite.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/alpine.min.js"></script>
</body>
</html>