<!DOCTYPE HTML>  
<html>

  <head>
    <style>
    .error {color: #FF0000;}
    </style>
  </head>

  <body>  

    <?php
    // define variáveis e defina como valores vazios
    $nomeErro = $emailErro = $generoErro = $websiteErro = "";
    $nome = $email = $genero = $comentario = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nome"])) {
        $nomeErro = "O nome é obrigatório";
      } else {
        $nome = test_input($_POST["nome"]);
        // verifica se o nome contém apenas letras e espaços em branco
        if (!preg_match("/^[a-zA-Z-\' ]*$/", $nome)) {
          $nomeErro = "Somente letras e espaços em branco são permitidos";
        }
      }

      if (empty($_POST["email"])) {
        $emailErro = "O e-mail é obrigatório";
      } else {
        $email = test_input($_POST["email"]);
        // verifica se o formato do e-mail é válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErro = "Formato de e-mail inválido";
        }
      }

      if (empty($_POST["website"])) {
        $website = "";
      } else {
        $website = test_input($_POST["website"]);
        // verifica se o formato da URL é válido (essa expressão regular também permite traços na URL)
        if (!preg_match("/\\b(?:(?:https?|ftp):\\/\\/|www\\.)[-a-z0-9+&@#\\/%?=~_|!:,.;]*[-a-z0-9+&@#\\/%=~_|]/i", $website)) {
          $websiteErro = "URL inválida";
        }
      }

      if (empty($_POST["comentario"])) {
        $comentario = "";
      } else {
        $comentario = test_input($_POST["comentario"]);
      }

      if (empty($_POST["genero"])) {
        $generoErro = "O gênero é obrigatório";
      } else {
        $genero = test_input($_POST["genero"]);
      }
    }

    function test_input($dados) {
      $dados = trim($dados);
      $dados = stripslashes($dados);
      $dados = htmlspecialchars($dados);
      return $dados;
    }
    ?>

    <h2>Exemplo de Validação de Formulário em PHP</h2>
    <p><span class="error">* campo obrigatório</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      Nome: <input type="text" name="nome" value="<?php echo $nome;?>">
      <span class="error">* <?php echo $nomeErro;?></span>
      <br><br>
      E-mail: <input type="text" name="email" value="<?php echo $email;?>">
      <span class="error">* <?php echo $emailErro;?></span>
      <br><br>
      Website: <input type="text" name="website" value="<?php echo $website;?>">
      <span class="error"><?php echo $websiteErro;?></span>
      <br><br>
      Comentário: <textarea name="comentario" rows="5" cols="40"><?php echo $comentario;?></textarea>
      <br><br>
      Gênero:
      <input type="radio" name="genero" <?php if (isset($genero) && $genero=="feminino") echo "checked";?> value="feminino">Feminino
      <input type="radio" name="genero" <?php if (isset($genero) && $genero=="masculino") echo "checked";?> value="masculino">Masculino
      <input type="radio" name="genero" <?php if (isset($genero) && $genero=="outro") echo "checked";?> value="outro">Outro  
      <span class="error">* <?php echo $generoErro;?></span>
      <br><br>
      <input type="submit" name="submit" value="Enviar">  
    </form>

    <?php
    echo "<h2>Seu input:</h2>";
    echo $nome;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comentario;
    echo "<br>";
    echo $genero;
    ?>

  </body>
</html>
