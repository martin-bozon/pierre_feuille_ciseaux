<?php include 'traitement.php' ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/pfc.css"/>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="pfc.js"></script>
        <title>Pierre Feuille Ciseaux</title>
    </head>
    <body>
    <h2>Joue contre l'ordinateur au "Pierrre Feuille Ciseaux" !</h2>
        <!-- Version JavaScript -->
        <h3>Version JavaScript</h3>
        <p>Clique sur ton choix</p>
        <section id="js">
            <section>
                <img src="image/1.png" alt="Pierre" class="jeu" data-id="1">
                <img src="image/2.png" alt="Feuille" class="jeu" data-id="2">
                <img src="image/3.png" alt="Ciseaux" class="jeu" data-id="3">
            
                <p id="quoi">&nbsp;</p>
                <p id="resultat_js">&nbsp;</p>
                <p id="raison">&nbsp;</p>
            </section>
            <section>
                
                <table>
                    <thead>
                        <tr>
                            <th>Score de la partie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Victoire</td>
                            <td id="victoire"></td>
                        </tr>
                        <tr>
                            <td>Défaite</td>
                            <td id="defaite"></td>
                        </tr>
                        <tr>
                            <td>Egalité</td>
                            <td id="egalite"></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </section>
        <!-- Version PHP -->
        <h3>Version PHP</h3>
        <section id="php">
            <section class="groupe">              
                <p>Fais ton choix, puis valide</p>    
                <form action="index.php" method="POST">
                    <section class="choix">
                        <label for="pierre"><img src="image/1.png" alt="Pierre"></label>
                        <input type="radio" id="pierre" name="jeu" value="1">
                    </section>
    
                    <section class="choix">
                        <label for="feuille"><img src="image/2.png" alt="Feuille"></label>
                        <input type="radio" id="feuille" name="jeu" value="2">
                    </section>
    
                    <section class="choix">
                        <label for="ciseaux"><img src="image/3.png" alt="Ciseaux"></label>
                        <input type="radio" id="ciseaux" name="jeu" value="3">
                    </section>
    
                <input type="submit" name="valider" value="Jouer">
                </form>                       
            </section>       
            <section class="groupe">
            <?php            
                if(!isset($_SESSION["partie"]))                                   
                    {
                        $_SESSION["partie"] = new Partie;                                                
                    }
    
                $s_partie = $_SESSION["partie"];
                
                if(isset($_POST["valider"], $_POST["jeu"]))
                    {                                        
                        $choix = $_POST["jeu"];                                 
                        ?>
                        <section id="resultat">
                            <p>Tu as fait <?= $s_partie->joueur($choix) ?> l'ordi à fait <?= $s_partie->ordi($choix_ordi)?></p>
                            <?php $s_partie->resultat($choix, $choix_ordi);?>
                            <p><?= $s_partie->getCommentaire() ?></p>                                                     
                        </section>
                        <?php
                    }
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Score de la partie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Victoires</td>
                            <td><?= $s_partie->getVictoire()?></td>
                        </tr>
                        <tr>
                            <td>Défaites</td>
                            <td><?= $s_partie->getDefaite()?></td>
                        </tr>
                        <tr>
                            <td>Egalités</td>
                            <td><?= $s_partie->getEgalite()?></td>
                        </tr>
                    </tbody>
                </table>
            </section>                  
        </section>
        <form action="" method="POST">
            <input type="submit" name="reset" value="Retour">
        </form>
    </body>
</html>