<?php require "require.php";
head("Portfolio");
require "menu.php"; ?>

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br>
            <br>

            <h1 class="header center orange-text">Portfolio</h1>

            <div class="row center">
                <h5 class="header col s12 light">Tout ce qui concerne le Street Art à Aix-en-Provence et ses
                    alentours</h5>
            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="parallax">
        <img src="media/background1.jpg" alt="Unsplashed background img 2">
    </div>
</div>
<br>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 center">
                <div id="wowslider-container1">
                    <div class="ws_images">
                        <ul>
                            <li><img src="data1/images/background1.jpg" alt="background1" title="background1"
                                     id="wows1_0"/></li>
                            <li><a href="http://wowslider.com"><img src="data1/images/background2.jpg"
                                                                    alt="jquery slider free download"
                                                                    title="background2" id="wows1_1"/></a></li>
                            <li><img src="data1/images/background3.jpg" alt="background3" title="background3"
                                     id="wows1_2"/></li>
                        </ul>
                    </div>
                    <div class="ws_bullets">
                        <div>
                            <a href="#wows1_0" title="background1"><span><img src="data1/tooltips/background1.jpg"
                                                                              alt="background1"/>1</span></a>
                            <a href="#wows1_1" title="background2"><span><img src="data1/tooltips/background2.jpg"
                                                                              alt="background2"/>2</span></a>
                            <a href="#wows1_2" title="background3"><span><img src="data1/tooltips/background3.jpg"
                                                                              alt="background3"/>3</span></a>
                        </div>
                    </div>
                    <div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">joomla
                            slideshow</a> by WOWSlider.com v7.7
                    </div>
                    <div class="ws_shadow"></div>
                </div>
                <div class="slider">
                    <ul class="slides">
                        <li>
                            <img src="http://lorempixel.com/580/250/nature/1"> <!-- random image -->
                            <div class="caption center-align">
                                <h3>This is our big Tagline!</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                        <li>
                            <img src="http://lorempixel.com/580/250/nature/2"> <!-- random image -->
                            <div class="caption left-align">
                                <h3>Left Aligned Caption</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                        <li>
                            <img src="http://lorempixel.com/580/250/nature/3"> <!-- random image -->
                            <div class="caption right-align">
                                <h3>Right Aligned Caption</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                        <li>
                            <img src="http://lorempixel.com/580/250/nature/4"> <!-- random image -->
                            <div class="caption center-align">
                                <h3>This is our big Tagline!</h3>
                                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                            </div>
                        </li>
                    </ul>
                </div>
                <br>
                <a href="fullscreen.php" target="_blank" class="btn-large waves-effect waves-light">Plein écran</a>
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
<br>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 center">
                <div class="row">
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background1.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background2.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background3.jpg">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background3.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background2.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background1.jpg">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background2.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background3.jpg">
                    </div>
                    <div class="col s12 m4">
                        <img class="materialboxed responsive-img z-depth-1" data-caption="Daniel Angel"
                             src="media/background1.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
