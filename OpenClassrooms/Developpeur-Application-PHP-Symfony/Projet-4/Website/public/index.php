<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Expressfood est une application de restauration en ligne." />
        <title>ExpressFood</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#">ExpressFood</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Accueil</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Diagrammes UML</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#umlUseCase">Cas d'utilisation</a></li>
                                <li><a class="dropdown-item" href="#umlSequences">Séquences</a></li>
                                <li><a class="dropdown-item" href="#umlClasses">Classes</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Base de données</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#bddConception">Schéma de conception</a></li>
                                <li><a class="dropdown-item" href="#bddModele">Modèle de données (dump)</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#sql">Requêtes SQL</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <h1 class="mb-5">Concevez la solution technique d'une application de restauration en ligne, ExpressFood</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scroll to top -->
        <button onclick="topFunction()" id="scrollToTop"><i class="bi bi-arrow-up"></i></button> 

        <!-- Icons Grid -->
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
                <div class="row g-0" id="umlUseCase">
                    <div class="col-lg-6 order-lg-2 text-white presentation-img" style="background-image: url('./assets/img/bg-uml-use-case.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto presentation-text">
                        <h2>UML - Cas d'utilisation</h2>
                        <p class="lead mb-0">Les diagrammes de cas d'utilisation modélisent le comportement d'un système et permettent de capturer les exigences de ce système.</p>
                        <a href="./assets/download/use-case.zip" download="uml-use-case.zip" class="downloadBtn btn btn-primary">Télécharger les diagrammes</a>
                    </div>
                </div>
                <div class="row g-0" id="umlSequences">
                    <div class="col-lg-6 text-white presentation-img" style="background-image: url('./assets/img/bg-uml-sequence.jpg')"></div>
                    <div class="col-lg-6 my-auto presentation-text">
                        <h2>UML - Séquences</h2>
                        <p class="lead mb-0">Les diagrammes de séquences sont la représentation graphique des interactions entre les acteurs et le système.</p>
                        <a href="./assets/download/sequences.zip" download="uml-sequences.zip" class="downloadBtn btn btn-primary">Télécharger les diagrammes</a>
                    </div>
                </div>
                <div class="row g-0" id="umlClasses">
                    <div class="col-lg-6 order-lg-2 text-white presentation-img" style="background-image: url('./assets/img/bg-uml-classe.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto presentation-text">
                        <h2>UML - Classes</h2>
                        <p class="lead mb-0">Le diagramme de classes est un schéma utilisé en génie logiciel pour présenter les classes et les interfaces des systèmes ainsi que leurs relations.</p>
                        <a href="./assets/download/classes.zip" download="uml-classes.zip" class="downloadBtn btn btn-primary">Télécharger le diagramme</a>
                    </div>
                </div>
                <div class="row g-0" id="bddConception">
                    <div class="col-lg-6 text-white presentation-img" style="background-image: url('./assets/img/bg-db-schema.png')"></div>
                    <div class="col-lg-6 my-auto presentation-text">
                        <h2>Base de données - Schéma de conception</h2>
                        <p class="lead mb-0">Le schéma de base de données est une structure d'une base de données décrite dans un langage formel pris en charge par le système de gestion de base de données.</p>
                        <a href="./assets/download/schema.zip" download="db-schema.zip" class="downloadBtn btn btn-primary">Télécharger le schéma</a>
                    </div>
                </div>
                <div class="row g-0" id="bddModele">
                    <div class="col-lg-6 order-lg-2 text-white presentation-img" style="background-image: url('./assets/img/bg-db-dump.png')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto presentation-text">
                        <h2>Base de données - Modèle de données</h2>
                        <p class="lead mb-0">En informatique, un modèle de données est un modèle qui décrit la manière dont sont représentées les données dans une organisation métier, un système d'information ou une base de données.</p>
                        <a href="./assets/download/db.zip" download="db-dump.zip" class="downloadBtn btn btn-primary">Télécharger le dump de la base de données</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- SQL -->
        <section id="sql">
           <h2 class="text-center sqlTitle">Quelques requêtes SQL</h2>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Liste des utilisateurs :
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php
                                $sql = 
                                'SELECT 
                                    nom, 
                                    prenom,
                                    email,
                                    telephone,
                                    role,
                                    date_creation
                                FROM utilisateur
                                ORDER BY role';
                                $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $query->execute();
                                while ($users = $query->fetch(PDO::FETCH_ASSOC)) {
                                    echo $users['prenom'] . ' ' . $users['nom'] . '<br>';
                                    echo 'Email : ' . $users['email'] . '<br>';
                                    echo 'Téléphone : ' . $users['telephone'] . '<br>';
                                    echo 'Compte créer le : ' . $users['date_creation'] . '<br>'; 
                                    echo 'Permissions : ' . $users['role'] . '<br>';
                                    echo '<br>';
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
                                'SELECT 
                                    A.id as idCommande, 
                                    A.date_commande as dateCommande,
                                    A.statut as statutCommande,
                                    A.prix as prixCommande,
                                    B.nom as nomClient, 
                                    B.prenom as prenomClient,
                                    B.email as emailClient,
                                    C.nom as nomLivreur,
                                    C.prenom as prenomLivreur,
                                    C.email as emailLivreur
                                FROM commande as A
                                INNER JOIN utilisateur as B ON A.utilisateur_id = B.id
                                INNER JOIN utilisateur as C ON A.livreur_id = C.id';
                                $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $query->execute();
                                while ($orders = $query->fetch(PDO::FETCH_ASSOC)) {
                                    echo 'ID de commande : ' . $orders["idCommande"] . '<br>';
                                    echo 'Staut de la commande : ' .$orders["statutCommande"] . '<br>';
                                    echo 'Prix de la commande : ' . $orders["prixCommande"] . "€" . '<br>';
                                    echo 'Date de la commande : ' . $orders["dateCommande"] . '<br>';
                                    echo 'Client : ' . $orders["prenomClient"] . ' ' . $orders["nomClient"] . ' (' . $orders["emailClient"] . ')' . '<br>';
                                    echo 'Livreur : ' . $orders["prenomLivreur"] . ' ' . $orders["nomLivreur"] . ' (' . $orders["emailLivreur"] . ')' . '<br>';
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
                                'SELECT 
                                    A.id as idCommande,  
                                    B.quantite_produit as quantiteProduit,
                                    C.nom as nomProduit,
                                    C.prix as prixProduit
                                FROM commande as A 
                                INNER JOIN commande_produit as B ON A.id = B.commande_id
                                INNER JOIN produit as C ON B.produit_id = C.id
                                WHERE A.statut = "Livré"';
                                $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $query->execute(); 
                                $orders = $query->fetchAll(PDO::FETCH_ASSOC);  
                                $commandes = [];
                                foreach ($orders as $key => $value) {
                                    if(!isset($commandes[$value['idCommande']])) {
                                        $commandes[$value['idCommande']] = [];
                                    }
                                    $commandes[$value['idCommande']][] = [
                                        'idCommande' => $value['idCommande'],
                                        'nomProduit' => $value['nomProduit'], 
                                        'quantiteProduit' => $value['quantiteProduit'],
                                        'prixProduit' => $value['prixProduit']
                                    ];
                                }
                                foreach ($commandes as $commande) {
                                    echo('ID de commande : ' . $commande[0]['idCommande'] . '<br>');
                                    echo('Produits : ' . '<br>');
                                    for ($i=0; $i < count($commande) ; $i++) { 
                                        echo('- ' . $commande[$i]['nomProduit'] . ' x' . $commande[$i]['quantiteProduit'] . ' (' . $commande[$i]['quantiteProduit'] * $commande[$i]['prixProduit'] . '€)' . '<br>');
                                    }
                                    echo '<br>';
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <!-- Custom JS-->
        <script src="./assets/js/main.js"></script>
    </body>
</html>