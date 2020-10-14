$(document).ready(function()
    {
        // Fonction random
        function shuffle(a) {
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }
        // 
        var Victoire = 0;
        var Defaite = 0;
        var Egalite = 0;
        $('#victoire').html(Victoire);
        $('#defaite').html(Defaite);
        $('#egalite').html(Egalite);

        $('.jeu').click(function()
            {     
                console.log(Defaite);
                // 1 = Pierre, 2 = Feuille, 3 = Ciseaux
                var ordi = [1, 2, 3];
                shuffle(ordi);
                var choix_ordi = ordi[0];        
                var choix = $(this).data('id');            

                if(choix==choix_ordi)
                    {
                        $('#resultat_js').html('<b>Egalité</b>');
                        $('#raison').html('');
                        Egalite++
                        $('#egalite').html(Egalite);
                    }       
            // Victoire ordi
                if(choix==1 && choix_ordi==2)
                    {
                        $('#resultat_js').html('Vous avez <b>perdu</b>');
                        $('#raison').html('La Feuille englobe la Pierre');
                        Defaite++;
                        $('#defaite').html(Defaite);
                    }
                if(choix==2 && choix_ordi==3)
                    {
                        $('#resultat_js').html('Vous avez <b>perdu</b>');
                        $('#raison').html('Les Ciseaux coupent la Feuille');
                        Defaite++;
                        $('#defaite').html(Defaite);
                    }
                if(choix==3 && choix_ordi==1)
                    {
                        $('#resultat_js').html('Vous avez <b>perdu</b>');
                        $('#raison').html('La Pierre écrase les Ciseaux');
                        Defaite++;
                        $('#defaite').html(Defaite);
                    }         
            //    Victoire Joueur
                if(choix==1 && choix_ordi==3)
                    {
                        $('#resultat_js').html('Vous avez <b>gagné</b>');
                        $('#raison').html('La Pierre écrase les Ciseaux');
                        Victoire++;
                        $('#victoire').html(Victoire);
                    }                    
                if(choix==2 && choix_ordi==1)
                    {
                        $('#resultat_js').html('Vous avez <b>gagné</b>');
                        $('#raison').html('La Feuille englobe la Pierre');
                        Victoire++;
                        $('#victoire').html(Victoire);
                    }                    
                if(choix==3 && choix_ordi==2)
                    {
                        $('#resultat_js').html('Vous avez <b>gagné</b>');
                        $('#raison').html('Les Ciseaux coupent la Feuille');
                        Victoire++;
                        $('#victoire').html(Victoire);
                    }              
                $('#quoi').html('Tu as fais <img src="image/'+choix+'">, ton adeversaire à fait <img src="image/'+choix_ordi+'"/>')
            });
    });