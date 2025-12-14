<?php 
	//Iniciamos una sesión o la reanudamos
	session_start();
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	
	error_log('Session variable set in index.php : ' . print_r($_SESSION, true));

	//echo "<pre>";
	//print_r($_SESSION);
	//echo "</pre>";

	//Dependiendo del valor accio, se incluirá un resource o controller
	$accio = $_GET['accio'] ?? NULL;

		switch($accio) {
			case 'llistar-categories':
				include __DIR__ .'/resource_llistar_categories.php';
				break;
			case 'llistar-productes':
				include __DIR__ .'/resource_productes_categoria.php';
				break;
			case 'login':
				include __DIR__ .'/controller/login.php';
				break;
			case 'register':
				include __DIR__ .'/controller/registre.php';
				break;
			case 'detall-producte':
				include __DIR__ .'/controller/detall_producte.php';
				break;
			case 'tancar-sessio':
				include __DIR__ .'/controller/logout.php';
				break;
			case 'el_meu_compte':
				include __DIR__ .'/controller/el_meu_compte.php';
				break;
			case 'buidar-cistella':
				include __DIR__ .'/controller/buidar_cistella.php';
				break;
			case 'cistella':
				include __DIR__ .'/controller/cistella.php';
				break;
			case 'processar-compra':
				error_log("Processing purchase request");
				require __DIR__ .'/controller/processar_compra.php';
				break;
			case 'confirmacio-compra':
				include __DIR__ .'/controller/confirmacio_compra.php';
				break;
			case 'el_meu_compte':
				include __DIR__ .'/controller/el_meu_compte.php';
				break;
			case 'les_meves_compres':
				include __DIR__ .'/controller/les_meves_compres.php';
				break;
			default:
				break;
		}
?>








<?php 
/*
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title> Pràctiques TDIW </title>
		<link rel="stylesheet" type="text/css" href="/css/inici.css" title="main"/>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="/js/user_menu.js" ></script>
		<script src="/js/inici.js" defer></script>
		<script src="/js/inici_images.js" defer></script>
	</head>
	<body>
	<div class="container-header-nav">
	<header id="main-nav" class="header-general">
			<h1><a href="#">DOUBLE R SHOP </a></h1>
	</header>
		<nav id="main-nav">
			<div class="container-nav">
			<ul class = "nav-elements">
				<?php if (isset($_SESSION['id_usuari'])) {?>
					<!--<li><a href="index.php?accio=tancar-sessio">Tancar sessió</a></li>-->
					<li class="nav-center-elements">
						<a href="index.php?accio=llistar-categories">CATEGORIES</a>
					</li>
					<li id="user-icon-container">
						<img id="user-icon" src="/img/user_icon.png" alt="usuari">
						<div id ="user-menu">
							<ul>
								<li><a href="index.php?accio=tancar-sessio">TANCAR SESSIÓ</a></li>
								<li><a href="index.php?accio=el_meu_compte">EL MEU COMPTE</a></li>
								<li><a href="index.php?accio=les_meves_compres">LES MEVES COMPRES</a></li>
							</ul>
						</div>
					</li>
					<li class ="nom_usuari">
						<?php echo "Benvingut, " . htmlspecialchars($_SESSION['nom_usuari']); ?>
					</li>
			<?php } else{ ?>
					<li class="user_menu_logout"><a href="index.php?accio=register">REGISTRA'T</a></li>
					<li class="user_menu_logout"><a href="index.php?accio=login">INICIAR SESSIÓ</a></li>
					<li class="user_menu_logout"><a href="index.php?accio=llistar-categories">CATEGORIES</a></li>
			<?php } ?>
			</ul>
			</div>
		</nav>
		</div>

		<div class="container-body">
			<div class ="text_image">
				<h2>ELS MILLORS PRODUCTES A DOUBLE R SHOP</h2>
			</div>
			<div class="images">
				<img id="slide-images" src="/img/image1.jpg" alt="Imatges">
			</div>
		</div>
		<?php 
		}

*/
?>