<?php
    session_start();

    include 'includes/head.inc.html';
    include 'includes/header.inc.html'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        function valid_int($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            if (!ctype_digit($donnees)) {
                session_destroy();
            }
            return $donnees;
        }
        function valid_float($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            if (!is_numeric($donnees)) {
                session_destroy();
            }
            return $donnees;
        }
        function valid_string($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            // if (!ctype_alpha($donnees)) {
            //     session_destroy();
            //     echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données ERRORER</div>';
            // }
            return $donnees;
        }
        function handleFiles() {

            $name = $_FILES['photo']['name'];
            $tmpName = $_FILES['photo']['tmp_name'];
            $size_img = $_FILES['photo']['size'];
            $error = $_FILES['photo']['error'];

            $path = 'uploaded/' .$name;

            if (isset($_FILES) && $error == 0) {
                if ($size_img > 2000000) {
                    echo '<div class=" d-flex justify-content-center alert alert-danger">La taille doit être inférieur à 2MO</div>';
                    session_destroy();
                } else if (pathinfo($path)['extension'] == 'pdf') {
                    echo '<div class=" d-flex justify-content-center alert alert-danger">Extension "pdf" non pris en charge</div>';
                    session_destroy();
                } else {
                    move_uploaded_file($tmpName,$path);
                    echo '<div class=" d-flex justify-content-center alert alert-success">Données enregistré</div>';
                }
            } 
            else {
                echo '<div class=" d-flex justify-content-center alert alert-danger">Aucun fichier a été téléchargé</div>';
                session_destroy();
            }
            
        }

    
        // On récupère toute les données du formulaire
        $prenom = valid_string($_POST['firstname']);
        $nom = valid_string($_POST['lastname']);
        $age = valid_int($_POST['old']);
        $taille = valid_float($_POST['size']);
        $genre = $_POST['sexe'];
        $color = $_POST['color'];
        $birth = $_POST['birth'];
        

        // On stock les données dans un tableau
        $table = array();
        $table['firstname'] = $prenom;
        $table['lastname'] = $nom;
        $table['old'] = $age;
        $table['size'] = $taille;
        $table['sexe'] = $genre;
        $table['color'] = $color;
        $table['birth'] = $birth;

        if (isset($_POST['HTML'])) {
            $table['html'] = $_POST['HTML'];
        }

        if (isset($_POST['CSS'])) {
            $table['css'] = $_POST['CSS'];
        }

        if (isset($_POST['JAVASCRIPT'])) {
            $table['javascript'] = $_POST['JAVASCRIPT'];
        }

        if (isset($_POST['PHP'])) {
            $table['php'] =  $_POST['PHP'];
        }

        if (isset($_POST['MYSQL'])) {
            $table['mysql'] = $_POST['MYSQL'];
        }

        if (isset($_POST['BOOTSTRAP'])) {
            $table['bootstrap'] = $_POST['BOOTSTRAP'];
        }

        if (isset($_POST['SYMFONY'])) {
            $table['symfony'] = $_POST['SYMFONY'];
        }

        if (isset($_POST['REACT'])) {
            $table['react'] = $_POST['REACT'];
        }

        $table['img'] = array(
            'tmp_name' => $_FILES['photo']['tmp_name'],
            'type' => $_FILES['photo']['type'],
            'name' => $_FILES['photo']['name'],
            'size_img' => $_FILES['photo']['size'],
            'error' => $_FILES['photo']['error']
        );
        
        
        // On stocke les données de l'utilisateur dans la session 
        $_SESSION['table'] = $table;

        handleFiles();


    }
 
?>

<div class='container'>
    <div class='row'>

        <div class='col-3'>

            <a type="button" class="btn btn-secondary btn-lg" class="list-group-item list-group-item-action active" href="/" >Home</a>
            
            <?php
                if (!empty($_SESSION['table'])) {
                    # code...
                    include 'includes/ul.inc.php';
                }                
            ?>

        </div>

        <div class='col-9'>

            <!-- <a id="id" href="?id=form" type="button" class="btn btn-primary btn-lg" name='donnees'>Ajouter des données</a> -->
            <a id="id" href="?id=form2" type="button" class="btn btn-primary btn-lg" name='donnees'>Ajouter plus des données</a>
            
            <?php
                if (isset($_GET['id'])) {

                    switch($_GET['id']) {
                        case 'form':

                            echo '<style>#id {display:none};</style>';
                            include "./includes/form.inc.html";
                            break;

                        case 'form2':
                            echo '<style>#id {display:none};</style>';
                            include "./includes/form2.inc.php";
                            break;

                        case 'debug':

                            echo '<style>#id {display:none};</style>';
                            
                            if (empty($_SESSION['table'])) {
                                # code...
                                echo '<br><br><div class=" d-flex justify-content-center alert alert-danger alert-success">Données ERRONÉES</div>';
                            }else {
                                # code...
                                echo '===> Lecture du tableau avec la fonction print_r()';
                                echo '<pre>';
                                print_r($_SESSION['table']);
                                echo '</pre>';                                              
                            }

                            break;

                        case 'concat':

                            echo '<style>#id {display:none};</style>';

                            if (empty($_SESSION['table'])) {
                                # code...
                                echo '<br><br><div class=" d-flex justify-content-center alert alert-danger alert-success">Données ERRONÉES</div>';
                            }else{
                                $table = $_SESSION['table'];
                                echo '===> Construction d\'une phrase avec le contenu du tableau<br>';
                                echo 'Bonjour ' . $table['sexe'] . ' ' . $table['firstname']. ' ' . $table['lastname']. '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . $table['size'] . 'm.<br><br>';
                                echo '===> Construction d\'une phrase après MAJ du tableau<br>';
                                echo 'Bonjour ' . $table['sexe'] . ' ' . ucfirst( $table['firstname']). ' ' . strtoupper($table['lastname']). '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . $table['size'] . 'm.<br><br>';
                                echo '===> Affichage d\'une virgule à la place du point pour la taille<br>';
                                echo 'Bonjour ' . $table['sexe'] . ' ' . ucfirst( $table['firstname']). ' ' . strtoupper($table['lastname']). '<br>J\'ai ' . $table['old']. ' ans et je mesure ' . str_replace('.',',',$table['size']). 'm.';
                            }
                            
                            break;

                        case 'bouc':

                            echo '<style>#id {display:none};</style>';

                            if (empty($_SESSION['table'])) {
                                # code...
                                echo '<br><br><div class=" d-flex justify-content-center alert alert-danger alert-success">Données ERRONÉES</div>';
                            }else {
                                # code...
                                echo '===> Lecture du tableau a l\'aide d\'une boucle foreach<br><br>';
                                $table = $_SESSION['table'];
                                $n = 0;
    
                                foreach ($table as $key => $value) {
                                    if ($key != 'img') {
                                        echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient " . $value . "<br>";
                                    } else {
                                        echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient <br>";
                                        echo "<img class='mw-100' src='./uploaded/" . $value['name'] . "' alt='Image " . $value['name'] . "'><br><br>";
                                    }
                                }
                            }
                            
                            break;

                        case 'fonc':

                            echo '<style>#id {display:none};</style>';
                            if (empty($_SESSION['table'])) {
                                # code...
                                echo '<br><br><div class=" d-flex justify-content-center alert alert-danger alert-success">Données ERRONÉES</div>';
                            }else {
                                # code...
                                echo '===> Lecture du tableau a l\'aide d\'une fonction<br><br>';
                                function readTable(){
                                    $table = $_SESSION['table'];
                                    $n = 0;
                                    foreach ($table as $key => $value) {
                                        if ($key != 'img') {
                                            echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient " . $value . "<br>";
                                        } else {
                                            echo "à la ligne n°" . $n++ . " correspond la clé " . $key . " et contient <br>";
                                            echo "<img class='mw-100' src='./uploaded/" . $value['name'] . "' alt='Image " . $value['name'] . "'><br><br>";
                                        }
                                    }
                                };
                                readTable();
                            }
                            
                            break;

                        case 'supp':

                            echo '<style>#hide {visibility: hidden}</style>';
                            session_destroy();
                            echo '<br><br><div class=" d-flex justify-content-center alert alert-dismissible alert-success">Données supprimés</div>';
                            
                            break;
                        

                        default:
                    }

                }
            ?>

        </div>

    </div>   
</div>

<br>

<?php include 'includes/footer.inc.html'; ?>
