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
					<li class="nav-center-elements">
						<a href="index.php?accio=cistella">CISTELLA</a>
					</li>
					<li id="user-icon-container">
                        <?php
                        require_once __DIR__ . '/../model/usuaris.php';
                        require_once __DIR__ . '/../model/connectaBD.php';
                        $connexio = connectaBD();
                        $usuari = getUsuariById($_SESSION['id_usuari'], $connexio);
                        if (!empty($usuari['profile_image'])): ?>
                            <img id="user-icon" src="/uploadedFiles/<?php echo htmlspecialchars($usuari['profile_image']); ?>" alt="usuari" class="profile-picture">
                        <?php else: ?>
                            <img id="user-icon" src="/img/user_icon.png" alt="usuari">
                        <?php endif; ?>
                        <div id="user-menu">
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