<?php
session_start();
if (isset($_POST['mensagem'])) {
  echo '<script>alert("' . $_POST['mensagem'] . ' ");</script>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../../css/admin.css">
  <link rel="stylesheet" href="../../css/geral.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>
    <?php echo $_SESSION['usuario']; ?>
  </title>

</head>

<body>
  <header>

    <div id="sessao-usuario">
      <img class="logo-header" id="logo" src="../../css/assets/research.svg" alt="Lampada " />
      <div>
        </div>
        <form action="../../php/logout.php" method="post">
          <input type="submit" class="logout-bt" value="Logout">
        </form>
      </div>
      
    </header>
    <main class="form">
      <span class="span-title">
        <?php echo 'Bem-vindo, ' . $_SESSION['usuario'] . '!'; ?>
      </span>
    <h2>Cadastro de Usuário</h2>
    <form method="post" action="../../php/criar_usuario.php">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required><br><br>
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required><br><br>
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required><br><br>
      <label for="tipo">Tipo:</label>
      <input type="radio" id="aluno" name="tipo" value="aluno" checked>
      <label for="aluno">Aluno</label>
      <input type="radio" id="administrador" name="tipo" value="administrador">
      <label for="administrador">Administrador</label>
      <input type="radio" id="professor" name="tipo" value="professor">
      <label for="professor">Professor</label><br><br>
      <input type="submit" value="Cadastrar" class="btnCadastro">
    </form>
     </main>
    <br><br><br><br><br>
    <!--lista de professores -->
    <table border="3" align="center">
			<tr>
					<td>PROFESSOR</td>
                    <td>EMAIL</td>
                    <td>SENHA</td>
                    
			</tr>

<?php

include('../../php/conexao.php');

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE tipo = 'professor'");

$stmt->execute();

$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

               
                <?php foreach ($professores as $professor): ?>
              
            <tr>
					<td><?php echo $professor['nome']; ?></td>
                    <td><?php echo $professor['email'];  ?></td>
                    <td><?php echo $professor['senha']; ?></td>
                    <td>
					
									<form action="../../deletar.php" method="POST">
                                    <input type="hidden" name="btn_delete" value="<?php echo $id; ?>">
                                    <button type="submit" name="">DELETAR</button>
									</form>
                                    
                                    <form action="../../editar.php" method="POST">
                                    <input type="hidden" name="btn_editar" value="<?php echo $id; ?>">
                                    <button type="submit" name="">EDITAR</button>
									</form>
					
					</td>
			</tr>
           
            <?php endforeach; ?>
            </table>

<br><br><br>

 
</body>

</html>