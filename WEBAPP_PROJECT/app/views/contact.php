<?php
    include 'template/header.php';
?>
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Contact Us!</h1>
            <h2 class="text-center">Welcome to <span id="W_Name" class="text-purple-600">JMS E-Shop</span>!</h2>
            <p class="text-lg mt-4">Please email us if you have any queries about the site, advertising, or anything else.</p>

            <div class="mt-8">
                <img alt="contact-us" height="87" src="<?= base_url(); ?>/public/emailus.png" width="320" class="mx-auto">
                
                <p class="mt-4">
                    <i class="fas fa-envelope-open-text text-gray-700 text-lg"></i>
                    <b><i><span id="W_Email"><a href="mailto:jo1102.business@gmail.com" class="text-purple-600">jo1102.business@gmail.com</a></span></i></b>
                </p>

                <p>
                    <i class="fab fa-whatsapp-square text-green-500 text-lg"></i>
                    <b><span id="W_whatsapp"><a href="tel:" class="text-purple-600"></a></span></b>
                </p>

                <h3 class="text-purple-700 mt-4">We will revert to you as soon as possible...!</h3>
                <p class="text-purple-700">You can also contact us at this number : 09279901863</p>
                <p class="text-purple-700">Thank you for contacting us!<br><b>Have a great day</b></p>
            </div>
        </div>
    </div>
<?php
    include 'template/footer.php';
?>