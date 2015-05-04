<?php require "require.php";
head("Portfolio");
cssPortfolio();
require "menu.php";
?>

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br>
            <br>

            <h1 class="header center orange-text">Portfolio</h1>

            <div class="row center">
                <h5 class="header col s12 light">Toutes les images postées sur le site sont ici !</h5>
            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="parallax">
        <img src="media/background1.jpg" alt="Unsplashed background img 2">
    </div>
</div>
<div id="grid-gallery" class="grid-gallery">
    <section class="grid-wrap">
        <ul class="grid">
            <li class="grid-sizer"></li><!-- for Masonry column width -->
            <?php getImagesAAfficher(); ?>
        </ul>
    </section><!-- // grid-wrap -->
    <section class="slideshow">
        <ul>
            <?php getSlidersAAfficher(); ?>
        </ul>
        <nav>
            <span class="icon nav-prev"></span>
            <span class="icon nav-next"></span>
            <span class="icon nav-close"></span>
        </nav>
        <div class="info-keys icon">Navigate with arrow keys</div>
    </section><!-- // slideshow -->
</div><!-- // grid-gallery -->
</div>
</div>

<?php require "footer.php"; ?>

<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpGridGallery.js"></script>
<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>