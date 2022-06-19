<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Expressfood est une application de restauration en ligne." />
        <title>Expressfood</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <!-- Custom CSS-->
        <link href="./assets/css/styles.css" rel="stylesheet" />
    </head>

    <?php
        // Database informations
        require('../db.php');
        $host = getenv("DB_HOST");
        $username = getenv("DB_USERNAME");
        $password = getenv("DB_PASSWORD");
        $database = getenv("DB_DATABASE");
        
        // Database connection
        try {
            $db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }  
    ?> 

    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#">Expressfood</a>
            </div>
        </nav>

        <!-- Header -->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5">Concevez la solution technique d'une application de restauration en ligne, ExpressFood</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi bi-diagram-2 m-auto text-primary"></i></div>
                            <h3>Diagrammes UML</h3>
                            <p class="lead mb-0">Cas d'utilisation, Classes, Séquences</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi bi-code-slash m-auto text-primary"></i></div>
                            <h3>Base de données</h3>
                            <p class="lead mb-0">Schéma de conception, Modèle de données</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Presentation -->
        <section class="presentation">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white presentation-img" style="background-image: url('./assets/img/bg-uml-use-case.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto presentation-text">
                        <h2>UML - Cas d'utilisation</h2>
                        <p class="lead mb-0">Les diagrammes de cas d'utilisation modélisent le comportement d'un système et permettent de capturer les exigences de ce système.</p>
                        <a href="./assets/download/use-case.zip" download="uml-use-case.zip" class="downloadBtn btn btn-primary">Télécharger les diagrammes</a>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white presentation-img" style="background-image: url('./assets/img/bg-uml-sequence.jpg')"></div>
                    <div class="col-lg-6 my-auto presentation-text">
                        <h2>UML - Séquences</h2>
                        <p class="lead mb-0">Les diagrammes de séquences sont la représentation graphique des interactions entre les acteurs et le système.</p>
                        <a href="./assets/download/sequences.zip" download="uml-sequences.zip" class="downloadBtn btn btn-primary">Télécharger les diagrammes</a>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white presentation-img" style="background-image: url('./assets/img/bg-uml-classe.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto presentation-text">
                        <h2>UML - Classes</h2>
                        <p class="lead mb-0">Le diagramme de classes est un schéma utilisé en génie logiciel pour présenter les classes et les interfaces des systèmes ainsi que leurs relations.</p>
                        <a href="./assets/download/classes.zip" download="uml-classes.zip" class="downloadBtn btn btn-primary">Télécharger le diagramme</a>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white presentation-img" style="background-image: url('./assets/img/bg-db-schema.png')"></div>
                    <div class="col-lg-6 my-auto presentation-text">
                        <h2>Base de données - Schéma de conception</h2>
                        <p class="lead mb-0">Le schéma de base de données est une structure d'une base de données décrite dans un langage formel pris en charge par le système de gestion de base de données.</p>
                        <a href="./assets/download/schema.zip" download="db-schema.zip" class="downloadBtn btn btn-primary">Télécharger le schéma</a>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white presentation-img" style="background-image: url('./assets/img/bg-db-dump.png')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto presentation-text">
                        <h2>Base de données - Modèle de données</h2>
                        <p class="lead mb-0">En informatique, un modèle de données est un modèle qui décrit la manière dont sont représentées les données dans une organisation métier, un système d'information ou une base de données.</p>
                        <a href="./assets/download/database.zip" download="db-dump.zip" class="downloadBtn btn btn-primary">Télécharger le dump de la base de données</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- SQL -->
        <section class="sql">
           <h2 class="text-center sqlTitle">Quelques requêtes SQL</h2>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Liste des utilisateurs standard (ne prend pas en compte les livreurs et administrateurs) :
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php
                                $sql = 'SELECT nom, prenom FROM utilisateur WHERE role = :role';
                                $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $query->execute(array(':role' => 'user'));
                                while ($users = $query->fetch(PDO::FETCH_ASSOC)) {
                                    echo "- " . $users["prenom"] . " " . $users["nom"] . "<br>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Liste des commandes réalisées : 
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php 
                                $sql = 
                                'SELECT A.id as idCommande, statut, prix, date_creation, nom, prenom FROM commande as A
                                INNER JOIN utilisateur as B ON A.utilisateur_id = B.id';
                                $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $query->execute();
                                while ($orders = $query->fetch(PDO::FETCH_ASSOC)) {
                                    echo 'ID de commande : ' . $orders["idCommande"] . '<br>';
                                    echo 'Staut de la commande : ' .$orders["statut"] . '<br>';
                                    echo 'Prix de la commande : ' . $orders["prix"] . "€" . '<br>';
                                    echo 'Date de la commande : ' . $orders["date_creation"] . '<br>';
                                    echo 'Client : ' . $orders["prenom"] . ' ' . $orders["nom"] . '<br>';
                                    echo '<br>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Détail des commandes ayant le statut "Livré" :
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php
                                $sql = 
                                'SELECT A.id as idCommande, B.produit_id, B.quantite_produit, C.nom, C.prix FROM commande as A 
                                INNER JOIN commande_produit as B ON A.id = B.commande_id
                                INNER JOIN produit as C ON B.produit_id = C.id
                                WHERE A.statut = "Livré"';
                                $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $query->execute();      
                                while ($orders = $query->fetch(PDO::FETCH_ASSOC)) {
                                    echo(
                                        'ID de commande : ' . $orders['idCommande'] 
                                        . ' - Produit : ' . $orders["nom"] . ' x' . $orders['quantite_produit'] 
                                        . ' (' . $orders['prix'] . '€)' . '<br>'
                                    );
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    Copyright &copy; 2022 <strong><span>Expressfood</span></strong>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS-->
        <script src="./assets/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS-->
        <script src="./assets/js/main.js"></script>
    </body>
</html>
