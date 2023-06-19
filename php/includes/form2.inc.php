<form class="container h-100" action="../index.php" method="POST" enctype="multipart/form-data">
    <div class='row'>
        <section class='card col-md-7 mx-auto my-1'>
            <h2>Ajouter des données</h2>
            <div class="d-flex justify-content-center">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Prénom" name="firstname" required="required" pattern="[a-z]+"></div>
                    <br><div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Nom" name="lastname" required="required" pattern="[a-z]+"></div>
                    <br><div class="form-group col-md-6">
                        <label for="old">Age (18 à 70 ans)</label>
                        <input name="old" type="number" class="form-control" placeholder="Renseignez votre age" min="18" max="70" required="required" pattern="[0-9]+"></div>
                    <br><div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">Taille (1.26m à 3m)</span></div>
                        <input type="number" step="0.01" class="form-control" aria-label="Somme arrondie" name ="size" min="1.26" max="3" required="required"> 
                        <div class="input-group-append"><span class="input-group-text">cm</span></div></div>
                    <br><div class="form-group col-md-4">
                        <input name="sexe" type="radio" id="Femme" value="Mme" required="required">
                        <label for="Femme">Femme</label><br>
                        <input name="sexe" type="radio" id="Homme" value="Mr" required="required">
                        <label for="Homme">Homme</label><br>
                        <input name="sexe" type="radio" id="Autre" value="truc" required="required">
                        <label for="Autre">Autre</label></div><br>
                </div>
            </div>
        </section>
        <section class='card col-md-4 mx-auto my-1'>
            <legend>Connaissances</legend>
            <div>
                <label for="html">HTML</label>
                <input type="checkbox" name="tricks[]" value="HTML">
            </div>
            <div>
                <label for="css">CSS</label>
                <input type="checkbox" name="tricks[]" value="CSS">
            </div>
            <div>
                <label for="javascript">JavaScript</label>
                <input type="checkbox" name="tricks[]" value="JAVASCRIPT">
            </div>
            <div>
                <label for="php">PHP</label>
                <input type="checkbox" name="tricks[]" value="PHP">
            </div>
            <div>
                <label for="mysql">MySQL</label>
                <input type="checkbox" name="tricks[]" value="MySQL">
            </div>
            <div>
                <label for="bootstrap">Bootstrap</label>
                <input type="checkbox" name="tricks[]" value="BOOTSTRAP">
            </div>
            <div>
                <label for="symfony">Symfony</label>
                <input type="checkbox" name="tricks[]" value="SYMFONY">
            </div>
            <div>
                <label for="react">React</label>
                <input type="checkbox" name="tricks[]" value="REACT">
            </div>
            <br>
            <div>
                <label for="color">Couleur préférée</label><br>
                <input type="color" required="required" name='color'>
            </div>
            <br>
            <div>
                <label for="date">Date de naissance</label><br>
                <input type="date" required="required" name='birth'>
            </div>
        </section>
    </div>
    
    <section class='card col-11 mx-auto my-1'>
        <br>
        <label for="image"> Joindre une image (jpg ou png)</label>
        <input type="file" name='photo' required="required">
        <br>
    </section>
    <input name="valid" type="submit" class="btn btn-primary" value="Enregistrer les données">
</form>





