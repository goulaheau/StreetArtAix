<?php require "require.php"; head( "Evènements"); require "menu.php";
$id = null;
$e = new Evenement($_GET['id']);
?>
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h1 class="center orange-text">Evènement</h1>
            </div>
        </div>
    </div>
    <div class="parallax">
        <img src="media/background1.jpg" alt="Unsplashed background img 2">
    </div>
</div>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="section col s12">
                <h2 class="header"><?php echo $e->getTitre();?></h2>
                <p>
                    <div class="section col s3">
                        Date : <?php echo $e->getDate();?>
                    </div> 
                    <div class="section col s3">
                        Lieu : <?php echo $e->getLieu();?>
                    </div>
                    <div class="section col s3">
                        Participants : 25
                    </div>
                    <div class="section col s3">
                        <form action="#" method="POST">
                            <input type="checkbox" name="participer" id="participer"/>
                            <label for="participer">Je participe</label>
                        </form>
                    </div>
                </p>
                <div class="section col s12">
                    <p class="caption"><?php echo $e->getDescription();?></p>    
                </div> 
            </div>
        </div>
    </div>
</div>
<?php require "footer.php";
