<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Buku</title>
	<link rel="stylesheet" href="style.css">
	<style>
		.header-flexstart {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 0 20px;
			/* Add padding to create space on both sides */
		}

		.logo-main-menu img,
		.header-flexend img {
			display: block;
		}
	</style>
</head>

<body bgcolor="#d6dfcc">
	<div class="layer2">
		<header>
			<div class="header-flexstart">
				<div class="logo-main-menu">
					<a href="MainMenu.php">
						<img src="Logo library.png" alt="library Logo" width="60" height="60">
					</a>
				</div>
				<div>
					<!-- Empty div for spacing -->
				</div>
				<div class="header-flexend">
					<a href="MainMenu.php">
						<img src="Back button.png" alt="Back Button" width="60" height="60">
					</a>
				</div>
			</div>
		</header>
		<main>
			<hr>
			<div class="layer3">
				<h2><u>MENU BUKU</u></h2>
				<ol>
					<li>
						<a href="displaybuku.php"><button>Display Buku</button></a>
					</li>
					<br>
					<li>
						<a href="tambahbuku.php"><button>Tambah Buku</button></a>
					</li>
					<br>
					<li>
						<a href="deletebuku.php"><button>Delete Buku</button></a>
					</li>
				</ol>
			</div>
		</main>
	</div>
</body>

</html>