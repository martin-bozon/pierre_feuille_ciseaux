<?php
session_start();
$choix_ordi = [1, 2, 3];        
shuffle($choix_ordi);

if(isset($_POST["reset"]))
    {
        session_destroy();
        session_unset();
        header('Location:../../index.php');
    }

class Partie
    {
        private $victoire = 0;
        private $defaite = 0;
        private $egalite = 0;
        private $commentaire;

        public function resultat($choix, $choix_ordi)
            {              
                //condition égalité
                if($choix == $choix_ordi[0])
                    {                
                        $this->egalite++;
                        $this->commentaire = "Il y a&nbsp;<b>égalité</b>, qui est dans la tête de qui ?";                
                    }
                //victoire joueur
                if($choix == 1 && $choix_ordi[0] == 3)
                    {
                        $this->victoire++;
                        $this->commentaire = "Tu as&nbsp;<b>gagné</b>&nbsp;: la pierre casse les ciseaux";                
                    }
                if($choix == 2 && $choix_ordi[0] == 1)             
                    {
                        $this->victoire++;
                        $this->commentaire = "Tu as&nbsp;<b>gagné</b>&nbsp;: la feuille englobe la pierre";              
                    }
                if($choix == 3 && $choix_ordi[0] == 2)
                    {
                        $this->victoire++;
                        $this->commentaire = "Tu as&nbsp;<b>gagné</b>&nbsp;: les ciseaux coupent la feuille";              
                    }
                //Victoire ordi
                if($choix == 3 && $choix_ordi[0] == 1)
                    {
                        $this->defaite++;
                        $this->commentaire = "Tu as&nbsp;<b>perdu</b>&nbsp;: la pierre casse les ciseaux";                
                    }
                if($choix == 1 && $choix_ordi[0] == 2)
                    {
                        $this->defaite++;
                        $this->commentaire = "Tu as&nbsp;<b>perdu</b>&nbsp;: la feuille englobe la pierre";              
                    }
                if($choix == 2 && $choix_ordi[0] == 3)
                    {
                        $this->defaite++;
                        $this->commentaire = "Tu as&nbsp;<b>perdu</b>&nbsp;: les ciseaux coupent la feuille";              
                    }                
            }
        //image pour le joueur
        public function joueur($choix)
            {
                if($choix == 1)
                    {
                        return "<img src='image/$choix.png' alt='Pierre'/>";
                    }
                if($choix == 2)
                    {
                        return "<img src='image/$choix.png' alt='Feuille'/>";
                    }
                if($choix == 3)
                    {
                        return "<img src='image/$choix.png' alt='Ciseaux'/>";
                    }
            }
        //image pour l'ordi
        public function ordi($choix_ordi)
            {
                $ia = $choix_ordi[0];
                if($ia == 1)
                    {
                        return "<img src='image/$ia.png' alt='Pierre'/>";
                    }
                if($ia == 2)
                    {
                        return "<img src='image/$ia.png' alt='Feuille'/>";
                    }
                if($ia == 3)
                    {
                        return "<img src='image/$ia.png' alt='Ciseaux'/>";
                    }
            }
        public function getCommentaire()
            {
                return $this->commentaire;
            }
        public function getVictoire()
            {
                return $this->victoire;
            }
        public function getDefaite()
            {
                return $this->defaite;
            }
        public function getEgalite()
            {
                return $this->egalite;
            }        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/pfc.css"/>
        <title>Pierre Feuille Ciseaux</title>
    </head>
    <body>
        <section class="groupe">
            <h2>Joue contre l'ordinateur au "Pierrre Feuille Ciseaux" !</h2>
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
            <form action="" method="POST">
                <input type="submit" name="reset" value="Retour">
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
    </body>
</html>