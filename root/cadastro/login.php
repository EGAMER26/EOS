<Html>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </head>
    <body>
    <div class = "allhomelogin">
        <div class = "backgroundLogin">
        <img width = "100%" height="100%" src = "assets/backgroundlogin.jpg" alt = "">
          </div>
          <div class = "backgroundcadastro">
          <img width = "100%" height = "100%" src = "assets/backgroundlogin.jpg" alt = "">
          </div>
          <div class = "popup_wrapper">
          
            <div    class   = "popup">
            <a       href="index.html" class = "closeOpenLogin" > <img width        = "20px" src                             = "assets/closeLogin.png" alt = "close icone"></a>
            
              <div  class  = "sectionLogin">
              <h2   class  = "slaaa" >Digite o seu e-mail e senha</h2> <br>
              <form action="testLogin.php" method="POST">
                <div  class  = "allLogin">
                <div  class  = "email">
                <input style="width: 100%;" type = "email" name="email" id = "email" placeholder = "E-mail...">
                            </div>
                          <div class = "senha">
                          
                            <input type = "password" name="senha" id = "senha" placeholder = "Senha...">
                          </div>
                  </div>
              
                
                <div class = "forgot">
                <a   href  = "#">Esqueci minha senha</a>
                </div>
                <input type="submit" name="submit" value="Submit" class = "entrar">
              </form>
              </div>
          
            </div>
            <div onclick = "allbackcadastro()" class = "popupCadastro"><button>Cadastre-se</button></div>
          </div>
          <div class = "cadastrowrapper">
          
          
          <div    class   = "popup cadastro">
          <a      href="index.html" class = "closeOpenLogin" > <img width        = "20px" src                             = "assets/closeLogin.png" alt = "close icone"></a>
          
            <div class = "sectionLogin">
            <h2  style="margin-bottom: 3rem; font-size: 40px;" class = "slaaa" >Crie uma conta</h2>
            <div class = "allLogin">
          
                <form style="display: flex; gap:3rem; flex-direction: column; align-items: center; justify-content: center; align-content: center;" id="formCadastro" name="form_cliente" method="post" autocomplete = "on">
                <label for="email">
                  <div  class  = "email">
                            
                              <input type = "text" name="txt_nome" maxlength = "30" id = "email" placeholder = "Nome completo..." required>
                            </div>
                </label>
                <label for="email">
                  <div class = "senha">
                            
                            <input type = "email" name="txt_email" maxlength = "50" id = "email" placeholder = "E-mail..." required>
                  </div>
                </label>
                
                <label for="confirm_password">
                            
                            <input type = "password" name="txt_senha" maxlength = "50" id = "confirm_password" placeholder = "senha..." required>
                </label>
                <input type="submit" value="Cadastrar" id="inputCadatro" style="margin: 0; width: 20rem; display: flex; justify-content: center; align-items: center;background:black; color: white; padding: 0;" onclick="document.form_cliente.action='cadastrar1.php'">
              </form>
                
                </div>
              
              
            </div>
          
          </div>
          </div>
        </div>
        <script src  = "https://unpkg.com/scrollreveal"></script>
    <script type = "text/javascript" src = "main.js"></script>
    </body>
    </html>
 </Html>