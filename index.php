<?php require "require.php"; head( "Street Art in Aix"); require "menu.php"; ?>
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br>
            <br>
            <h1 class="header center orange-text">Street Art in Aix</h1>
            <div class="row center">
                <h5 class="header col s12 light">Tout ce qui concerne le Street Art à Aix-en-Provence et ses alentours</h5>
            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="parallax">
        <img src="media/background1.jpg" alt="Unsplashed background img 2">
    </div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 m6">
                <div class="icon-block">
                    <h2 class="mdi-notification-event-available center orange-text"></h2>
                    <h5 class="center">Les deux prochains évènements à venir</h5>
                    <?php Evenement::_affEvenementsAVenir(2); ?>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="icon-block">
                    <h2 class="mdi-notification-event-busy center orange-text"></h2>
                    <h5 class="center">Les deux derniers évènements passés</h5>
                    <?php Evenement::_affEvenementsPasses(2); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">Une nouvelle vision du Street Art</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="media/background3.jpg" alt="Unsplashed background img 2">
    </div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 center">
                <h3 class="mdi-image-photo orange-text"></h3>
                <h4>Portfolio</h4>
                <div class="row">
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background1.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background2.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background3.jpg">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background3.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background2.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background1.jpg">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background2.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background3.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel" src="media/background1.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="media/background2.jpg" alt="Unsplashed background img 3">
    </div>
</div>

<?php require "footer.php"; ?>