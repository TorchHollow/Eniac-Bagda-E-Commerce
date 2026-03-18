<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['mensagem'])) {
        $mensagem = $_SESSION['mensagem'];
        $tipo = $_SESSION['tipo'];
        echo "<div id='toast' class='toast $tipo'>$mensagem</div>";
        unset($_SESSION['mensagem'], $_SESSION['tipo']);
    }
    ?>
    <div id="mensagem" class="mensagem"></div>

    <div class="container">

        <div class="middle-screen">
            <img src="../assets/images/Logo Eniac.webp" alt="Logo Eniac">
            <h1>Bem-vindo ao Eniac</h1>
            <p id="texto-middle">Entre na sua conta e descubra ofertas exclusivas para você.</p>
        </div>

        <div class="cadastro">

            <h2 class="title-form">Crie sua conta</h2>

            <a href="#">
                <img class="img-google-1" src="../assets/images/google.png" alt="Login com Google">
            </a>

            <form class="form-cadastro" action="../includes/cadastro.php" method="POST">
                <div class="form-group">
                    <input placeholder="Nome Completo" type="text" id="name" name="nome" required>
                </div>
                <div class="form-group">
                    <input placeholder="E-mail" type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <input placeholder="CPF" type="text" id="cpf" name="cpf" required>
                </div>
                <div class="form-group">
                    <input
                        type="date"
                        id="data"
                        name="data_nascimento"
                        required>
                </div>
                <div class="form-group">
                    <input type="tel" id="telefone" name="telefone"
                        placeholder="(99) 99999-9999"
                        pattern="\(\d{2}\) \d{5}-\d{4}"
                        required>
                </div>

                <div class="form-group" style="position: relative;">
                    <input placeholder="Senha" type="password" id="password-cadastro" name="senha" required>
                    <button type="button" id="toggleSenhaCadastro"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                        <img id="iconSenhaCadastro" src="../assets/images/eye.png" alt="Mostrar senha" style="width:20px; height:20px;">
                    </button>
                </div>

                <div class="link-login">
                    <p class="paragrafo-login">Já tem uma conta?</p>
                    <a id="btn-link-login" href="#">Entrar</a>
                </div>

                <button type="submit" id="btn-cadastro" class="btn-cadastro">Cadastre-se</button>
            </form>


        </div>

        <div class="login">

            <h2 class="title-login">Acesse sua conta</h2>

            <?php if (isset($erro)) {
                echo "<p style='color: red;'>$erro</p>";
            } ?>

            <a class="link-google-login" href="#">
                <img class="img-google-2" src="../assets/images/google.png" alt="Login com Google">
            </a>

            <form class="form-cadastro" action="../includes/login.php" method="post">

                <div class="form-group">
                    <input placeholder="E-mail" type="email" id="email" name="email" required>
                </div>

                <div class="form-group" style="position: relative;">
                    <input placeholder="Senha" type="password" id="password-login" name="senha" required>
                    <small id="erro-senha" style="color: red; display: none;">Senha Incorreta!</small>
                    <button type="button" id="toggleSenhaLogin"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                        <img id="iconSenhaLogin" src="../assets/images/eye.png" alt="Mostrar senha" style="width:20px; height:20px;">
                    </button>
                </div>


                <div class="link-cadastro">
                    <a id="abrir-modal" href="#" class="paragrafo-cadastro1">Esqueceu a senha?</a>
                    <a id="btn-link-cadastro" class="paragrafo-cadastro2" href="#">Cadastre-se</a>
                </div>

                <button class="btn-login" type="submit">Entrar</button>
            </form>


        </div>


    </div>

    <div class="recuperar-senha">

        <div class="btn-close">
            <a href="#">+</a>
        </div>
        <div class="img-email">
            <img src="../assets/images/Mail-amico.png" alt="Ícone de e-mail">
        </div>

        <h2 class="title-recuperar-senha">
            Recuperar Senha
        </h2>

        <p class="paragrafo-recuperar-senha">
            Insira seu e-mail cadastrado para receber as instruções de recuperação.
        </p>

        <form class="form-recuperar-senha" action="../includes/recuperar_senha.php" method="POST">
            <div class="form-group-recuperar-senha">
                <label for="email">Email</label>
                <input placeholder="seu@email.com" type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn-recuperar-senha">Enviar Link de Recuperação</button>
        </form>

    </div>

    <script>
        const inputTelefone = document.getElementById('telefone');

        inputTelefone.addEventListener('input', function(e) {
            let valor = e.target.value;
            valor = valor.replace(/\D/g, '');
            valor = valor.substring(0, 11);
            if (valor.length > 2) {
                valor = "(" + valor.substring(0, 2) + ") " + valor.substring(2);
            }
            if (valor.length > 9) { // Ajustado para 9 para formatar o 5º dígito
                valor = valor.substring(0, 10) + "-" + valor.substring(10, 14);
            } else {
                 valor = valor.substring(0, 9) + "-" + valor.substring(9, 13);
            }
            e.target.value = valor;
        });

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                // Corrigido o caminho para a imagem
                icon.src = "../assets/images/hidden.png";
                icon.alt = "Esconder senha";
            } else {
                input.type = "password";
                // Corrigido o caminho para a imagem
                icon.src = "../assets/images/eye.png";
                icon.alt = "Mostrar senha";
            }
        }

        document.getElementById("toggleSenhaCadastro")
            .addEventListener("click", () => togglePassword("password-cadastro", "iconSenhaCadastro"));

        document.getElementById("toggleSenhaLogin")
            .addEventListener("click", () => togglePassword("password-login", "iconSenhaLogin"));

        window.addEventListener("load", function() {
            var toast = document.getElementById("toast");
            if (toast) {
                toast.classList.add("show");
                setTimeout(function() {
                    toast.classList.remove("show");
                }, 5000);
            }
        });
    </script>
    <script src="../assets/js/script.js"></script>
</body>

</html>