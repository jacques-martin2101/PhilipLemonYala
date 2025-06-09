<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Université Philip Lemon - Paiement des Frais Académiques</title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <style>
        * {
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body { }

        header {
            min-height: 15vh;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            background-image: url('assets/images/Fond2.png');
            background-size: cover;
            display: flex;
            justify-content: center;
        }
        nav {
            float: right;
            margin-top: 10%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 1rem;
            position: fixed;
            width: 45%;
            left: 90%;
            transform: translateX(-70%);
            top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 6px 6px rgba(0, 0, 0, 0.5);
            display: flex;
            overflow: hidden;
        }

        nav:hover {
            width: 50%;
            transition: width 0.3s ease;
        }
        ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 3rem;
            
        }
        a {
            text-decoration: none;
            color: #ffda79;
            font-size: 15px;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s ease;
            margin: 5px 5px;
            padding: 5px 5px;
        }
        a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: white;
            bottom: 0;
            left: 50%;
            transition: all 0.3s ease;
        }
        a:hover::after {
            width: 100%;
            left: 0;
        }
        a:hover {
            color:rgb(146, 123, 64);
            
        }
        .logo {
            margin-top: 10%;     
            display: flex;
            align-items: left;
            margin-right: 20px;
        }
        .logo img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .nav {
            
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            overflow: auto;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/v4-shims.min.css">

</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/images/Fond1.png" alt="Université Philip Lemon Logo" style="width: 50px; height: 50px;"><br>
            <h1>Université Philip Lemon</h1>
        </div>

        <div class="nav">          
            <nav>
               
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="inscription.php"><i class="fas fa-user-plus"></i> Inscription</a></li>
                    <li><a href="etudiants.php"><i class="fas fa-users"></i> Étudiants</a></li>
                    <li><a href="paiement.php"><i class="fas fa-credit-card"></i> Paiement</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <form action="recherche.php" method="GET">
                    <input type="text" name="query" placeholder="Rechercher..." required>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div> 
        </div>
    </header>