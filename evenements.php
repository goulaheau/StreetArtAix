<?php require "require.php";
head("Evènements");
require "menu.php"; ?>
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br>
                <br>

                <h1 class="header center orange-text">Evènements</h1>

                <div class="row center">
                    <h5 class="header col s12 light">Tous les évènements passés et à venir</h5>
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
                        <h5 class="center">Les 20 prochains évènements à venir</h5>
                        <?php Evenement::_affEvenementsAVenir(20); ?>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="icon-block">
                        <h2 class="mdi-notification-event-busy center orange-text"></h2>
                        <h5 class="center">Les 20 derniers évènements passés</h5>
                        <?php Evenement::_affEvenementsPasses(20); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "footer.php"; 