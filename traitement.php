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