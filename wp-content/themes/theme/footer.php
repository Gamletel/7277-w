<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Company
 */

//$logo = wp_get_attachment_image_url(theme('logo'),'full');
//$phones = @settings('phones');
//$emails = @settings('emails');
//$socials = @settings('socials');
//$adress = @settings('adresses');

?>

<footer id="footer" class="site-footer">
    <div class="footer">
        <div class="container">
            <h2>Hello FOOTER!</h2>
        </div>
    </div>
</footer>

<div id="modal-callback" class="theme-modal">
    <div class="close-modal">×</div>
    <div class="form__holder"></div>
</div>

<div id="modal-success" class="theme-modal">
    <div class="close-modal">×</div>

    <h2 class="block-title">
        Спасибо!
    </h2>

    <h3>
        Ваша заявка отправлена
    </h3>
</div>

<div id="modal-error" class="theme-modal">
    <div class="close-modal">×</div>

    <h2 class="block-title">
        Ошибка!
    </h2>

    <h3>
        Во время отправки произошла ошибка, пожалуйста, попробуйте позже!
    </h3>
</div>

<?php wp_footer(); ?>

</body>
</html>