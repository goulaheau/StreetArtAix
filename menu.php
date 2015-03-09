<body>
    <!-- Dropdown Compte -->
    <ul id="dropdown_compte" class="dropdown-content">
        <li><a href="compte.php">Paramètres du compte</a></li>
        <li class="divider"></li>
        <li class="divider"></li>
        <li><a href="#!">Envoyer une image</a></li>
        <?php affichageCreationEvenement(); ?>
        <li class="divider"></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
    </ul>

    <div class="navbar-fixed">
        <nav class="white" role="navigation">
            <div class="container">
                <div class="nav-wrapper">
                    <a id="logo-container" href="index.php" class="brand-logo">Street Art in Aix</a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="evenements.php">Evènements</a>
                        </li>
                        <li><a href="portfolio.php">Portfolio</a>
                        </li>
                        <li><a href="contact.php">Contact</a>
                        </li>
                        <?php switchMenu(); ?>
                    </ul>
                    <ul id="nav-mobile" class="side-nav">
                        <li><a href="evenements.php">Evènements</a>
                        </li>
                        <li><a href="portfolio.php">Portfolio</a>
                        </li>
                        <li><a href="contact.php">Contact</a>
                        </li>
                        <?php switchMenu(); ?>
                    </ul>
                    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                </div>
            </div>
        </nav>
    </div>