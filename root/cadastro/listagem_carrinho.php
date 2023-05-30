<?php
    session_start();
    print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_session['email']);
        unset($_session['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];
?>
<?php
include 'conexao_banco_eos.php';

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Consulta SQL para obter os dados do carrinho
$sql = "SELECT * FROM produtos";

// Executa a consulta
$resultado = $conexao->query($sql);

// Verifica se a consulta foi executada com sucesso
if ($resultado) {
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="style_listagem.css">
            <link rel="stylesheet" href="style.css">

            <link rel = "preconnect" href = "https://fonts.googleapis.com" />
    <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin />
    <link
      href = "https://fonts.googleapis.com/css2?family=Martel:wght@700&display=swap"
      rel  = "stylesheet"
    />
    <link rel = "preconnect" href = "https://fonts.googleapis.com" />
    <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin />
    <link
      href = "https://fonts.googleapis.com/css2?family=Open+Sans&display=swap"
      rel  = "stylesheet"
    />
    <link rel  = "preconnect" href                                                   = "https://fonts.googleapis.com">
    <link rel  = "preconnect" href                                                   = "https://fonts.gstatic.com" crossorigin>
    <link href = "https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel = "stylesheet">
    <link rel  = "stylesheet" href                                                   = "https://use.fontawesome.com/releases/v5.4.1/css/all.css">

        </head>
        <body>
        <nav  id       = "navigation">
  <a    onclick  = "closeMenu()" href            = "#">
  <img  width="110" height="70" src      = "assets/logo.png" alt = "logo legalide" />
      </a>

      <ul>
        <li><a onclick = "menuShoww()" href = "#" class = "active">Inicio</a></li>
        <li>
          <a onclick = "menuShoww()" id = "aproduct" href = "#product">Produtos</a>
        </li>
        <li><a onclick = "menuShoww()" id = "aabout" href = "#about">Sobre</a></li>
        <li>
          <a onclick = "menuShoww()" id = "acontact" href = "#contact">Contatos</a>
        </li>
      </ul>
      <a class = "navSB" href = "#"><img src = "assets/icn search .icn-xs.png" alt = "busca" /></a>
      <a class = "navSB" href = "http://localhost:8080/cadastro/listagem_carrinho.php"
        ><img
          src = "assets/icn shopping-cart .icn-xs.png"
          alt = "icone carrinho de compra"
          /></a>
          <?php
             echo "<p class=\"logado\">$logado</p>";
          ?>
          <div class   = "menu-btn">
          <i   onclick = "menuShoww()"><img src = "assets/icn menu .icn-xs.png" /></i>
          </div>
          <button class="buttonGetOut"><a href="sair.php">SAIR</a>
            
          </button>

          
        </nav>
            <div class="carrinho_content">
                <center>
                    <table style="width:900px;" id="table_listagem">
                        <tr>
                            <th>PRODUTO</th>
                            <th>PRECO</th>
                            <th>QUANTIDADE</th>
                            <th>ACAO</th>
                        </tr>
                        <?php
                        while ($linha = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $linha['nome_produto']; ?></td>
                                <td align="center"><?php echo $linha['preco_produto']; ?></td>
                                <td align="center">
                                    <form method="POST" action="atualizar_qtd.php">
                                        <input type="hidden" name="produto_id" value="<?php echo $linha['id_produto']; ?>">
                                        <input type="number" width="10px" name="quantidade" value="<?php echo $linha['qtd_produto']; ?>" min="1" step="1">
                                        <input type="submit" value="Atualizar" name="update" id="update">
                                    </form>
                                </td>
                                <td align="center">
                                    <button class="remover_button"><a href="remover_item_carrinho.php?produto_id=<?php echo $linha['id_produto']; ?>">Remover</a></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </center>
            </div>
           <button id="close_carrinho"><a href="sistema.php"><svg width="25" height="25" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 19L1 1M19.0001 1L1 19.0001" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a></button>
            <footer>
        
        <div class = "touch">
          <center>
              <h3>Contatos</h3>
              <div class = "touch1">
                <svg
                  width   = "24"
                  height  = "25"
                  viewBox = "0 0 24 25"
                  fill    = "none"
                  xmlns   = "http://www.w3.org/2000/svg"
                >
                  <g clip-path = "url(#clip0_964_12952)">
                    <path
                      d    = "M18.8481 12.9767C18.7367 12.8652 18.6045 12.7767 18.4589 12.7163C18.3133 12.656 18.1573 12.6249 17.9997 12.6249C17.8421 12.6249 17.686 12.656 17.5405 12.7163C17.3949 12.7767 17.2626 12.8652 17.1513 12.9767L15.2385 14.8895C14.3517 14.6255 12.6969 14.0255 11.6482 12.9767C10.5994 11.9279 9.99938 10.2731 9.73538 9.38635L11.6482 7.47357C11.7597 7.36223 11.8482 7.22998 11.9085 7.08441C11.9689 6.93883 12 6.78278 12 6.62518C12 6.46758 11.9689 6.31153 11.9085 6.16595C11.8482 6.02038 11.7597 5.88813 11.6482 5.77679L6.84821 0.976838C6.73686 0.865304 6.60462 0.776819 6.45904 0.716447C6.31347 0.656075 6.15741 0.625 5.99982 0.625C5.84222 0.625 5.68616 0.656075 5.54059 0.716447C5.39501 0.776819 5.26277 0.865304 5.15142 0.976838L1.89706 4.23121C1.44106 4.6872 1.18426 5.31359 1.19386 5.95319C1.22146 7.66197 1.67386 13.5971 6.35141 18.2747C11.029 22.9522 16.9641 23.4034 18.6741 23.4322H18.7077C19.3413 23.4322 19.9401 23.1826 20.3937 22.729L23.648 19.4747C23.7596 19.3633 23.8481 19.2311 23.9084 19.0855C23.9688 18.9399 23.9999 18.7839 23.9999 18.6263C23.9999 18.4687 23.9688 18.3126 23.9084 18.167C23.8481 18.0215 23.7596 17.8892 23.648 17.7779L18.8481 12.9767ZM18.6957 21.031C17.1981 21.0058 12.0742 20.6038 8.04819 16.5767C4.00904 12.5375 3.61784 7.39557 3.59384 5.92799L5.99982 3.52201L9.10298 6.62518L7.5514 8.17677C7.41036 8.3177 7.30665 8.49157 7.24967 8.68264C7.19268 8.87372 7.1842 9.07598 7.225 9.27115C7.2538 9.40915 7.9582 12.6815 9.95018 14.6735C11.9422 16.6655 15.2145 17.3699 15.3525 17.3987C15.5476 17.4406 15.75 17.4328 15.9413 17.376C16.1325 17.3192 16.3064 17.2151 16.4469 17.0735L17.9997 15.5219L21.1029 18.6251L18.6957 21.031Z"
                      fill = "#8EC2F2"
                    />
                  </g>
                  <defs>
                    <clipPath id = "clip0_964_12952">
                      <rect
                        width     = "24"
                        height    = "24"
                        fill      = "white"
                        transform = "translate(0 0.625)"
                      />
                    </clipPath>
                  </defs>
                </svg>
                <a href = "#">(11) 91234-4321</a>
              </div>
              <div class = "touch2">
                <svg
                  width   = "24"
                  height  = "31"
                  viewBox = "0 0 24 31"
                  fill    = "none"
                  xmlns   = "http://www.w3.org/2000/svg"
                >
                  <g clip-path = "url(#clip0_964_12956)">
                    <path
                      d    = "M11.9999 18.2499C15.3089 18.2499 17.9999 15.5589 17.9999 12.2499C17.9999 8.94097 15.3089 6.25 11.9999 6.25C8.69097 6.25 6 8.94097 6 12.2499C6 15.5589 8.69097 18.2499 11.9999 18.2499ZM11.9999 9.24997C13.6544 9.24997 14.9999 10.5955 14.9999 12.2499C14.9999 13.9044 13.6544 15.2499 11.9999 15.2499C10.3455 15.2499 8.99997 13.9044 8.99997 12.2499C8.99997 10.5955 10.3455 9.24997 11.9999 9.24997Z"
                      fill = "#8EC2F2"
                    />
                    <path
                      d    = "M11.13 29.9707C11.3839 30.152 11.688 30.2494 12 30.2494C12.312 30.2494 12.6161 30.152 12.87 29.9707C13.326 29.6482 24.0434 21.9098 23.9999 12.2499C23.9999 5.63344 18.6164 0.25 12 0.25C5.38357 0.25 0.000132055 5.63344 0.000132055 12.2424C-0.0433675 21.9098 10.674 29.6482 11.13 29.9707ZM12 3.24997C16.9634 3.24997 20.9999 7.28642 20.9999 12.2574C21.0314 18.9143 14.418 24.8917 12 26.8522C9.58353 24.8902 2.9686 18.9113 3.0001 12.2499C3.0001 7.28642 7.03655 3.24997 12 3.24997Z"
                      fill = "#8EC2F2"
                    />
                  </g>
                  <defs>
                    <clipPath id = "clip0_964_12956">
                      <rect
                        width     = "24"
                        height    = "29.9997"
                        fill      = "white"
                        transform = "translate(0 0.25)"
                      />
                    </clipPath>
                  </defs>
                </svg>
                <a href = "#">Av. Antonia Rosa Fioravanti, 804</a>
              </div>
              <div class = "touch3">
                <svg
                  width   = "24"
                  height  = "27"
                  viewBox = "0 0 24 27"
                  fill    = "none"
                  xmlns   = "http://www.w3.org/2000/svg"
                >
                  <g clip-path = "url(#clip0_964_12961)">
                    <path
                      d    = "M23.71 2.21646C23.575 2.07676 23.4045 1.98004 23.2185 1.93766C23.0325 1.89529 22.8388 1.90903 22.66 1.97726L0.660001 10.2973C0.470269 10.3721 0.306921 10.5052 0.191652 10.6789C0.0763829 10.8526 0.0146484 11.0586 0.0146484 11.2697C0.0146484 11.4807 0.0763829 11.6867 0.191652 11.8604C0.306921 12.0341 0.470269 12.1672 0.660001 12.2421L10.26 16.2357L14.1 26.2197C14.1721 26.4083 14.2958 26.5709 14.4557 26.6873C14.6157 26.8037 14.8049 26.8689 15 26.8749C15.2021 26.8705 15.3982 26.8026 15.5624 26.6801C15.7266 26.5576 15.8513 26.3862 15.92 26.1885L23.92 3.30846C23.9881 3.12446 24.0046 2.92411 23.9674 2.73076C23.9302 2.53742 23.8409 2.35905 23.71 2.21646ZM15 22.9229L12.21 15.6429L17 10.6613L15.59 9.19486L10.76 14.2181L3.8 11.2749L21.33 4.69166L15 22.9229Z"
                      fill = "#8EC2F2"
                    />
                  </g>
                  <defs>
                    <clipPath id = "clip0_964_12961">
                      <rect
                        width     = "24"
                        height    = "26"
                        fill      = "white"
                        transform = "translate(0 0.874756)"
                      />
                    </clipPath>
                  </defs>
                </svg>
                <a href = "#">comercial@eos.com</a>
              </div>
          </center>
        </div>
      <section class = "socialLinks">
        <ul>
          <li>
            <a href = "#"
              ><svg
                width   = "24"
                height  = "24"
                viewBox = "0 0 24 24"
                fill    = "none"
                xmlns   = "http://www.w3.org/2000/svg"
              >
                <path
                  d    = "M23.04 0H0.96C0.429 0 0 0.429 0 0.96V23.04C0 23.571 0.429 24 0.96 24H23.04C23.571 24 24 23.571 24 23.04V0.96C24 0.429 23.571 0 23.04 0ZM20.268 7.005H18.351C16.848 7.005 16.557 7.719 16.557 8.769V11.082H20.145L19.677 14.703H16.557V24H12.816V14.706H9.687V11.082H12.816V8.412C12.816 5.313 14.709 3.624 17.475 3.624C18.801 3.624 19.938 3.723 20.271 3.768V7.005H20.268Z"
                  fill = "#335BF5"
                />
              </svg>
            </a>
          </li>
          <li>
            <a href = "#"
              ><svg
                width   = "24"
                height  = "24"
                viewBox = "0 0 24 24"
                fill    = "none"
                xmlns   = "http://www.w3.org/2000/svg"
              >
                <g clip-path = "url(#clip0_964_12976)">
                  <path
                    d    = "M12.0018 5.84719C8.59683 5.84719 5.84883 8.59519 5.84883 12.0002C5.84883 15.4052 8.59683 18.1532 12.0018 18.1532C15.4068 18.1532 18.1548 15.4052 18.1548 12.0002C18.1548 8.59519 15.4068 5.84719 12.0018 5.84719ZM12.0018 15.9992C9.79983 15.9992 8.00283 14.2022 8.00283 12.0002C8.00283 9.79819 9.79983 8.00119 12.0018 8.00119C14.2038 8.00119 16.0008 9.79819 16.0008 12.0002C16.0008 14.2022 14.2038 15.9992 12.0018 15.9992ZM18.4068 4.16119C17.6118 4.16119 16.9698 4.80319 16.9698 5.59819C16.9698 6.39319 17.6118 7.03519 18.4068 7.03519C19.2018 7.03519 19.8438 6.39619 19.8438 5.59819C19.8441 5.40942 19.8071 5.22245 19.7349 5.048C19.6628 4.87354 19.557 4.71504 19.4235 4.58155C19.29 4.44807 19.1315 4.34223 18.957 4.2701C18.7826 4.19796 18.5956 4.16096 18.4068 4.16119ZM23.9958 12.0002C23.9958 10.3442 24.0108 8.70319 23.9178 7.05019C23.8248 5.13019 23.3868 3.42619 21.9828 2.02219C20.5758 0.615193 18.8748 0.180193 16.9548 0.0871931C15.2988 -0.00580693 13.6578 0.00919311 12.0048 0.00919311C10.3488 0.00919311 8.70783 -0.00580693 7.05483 0.0871931C5.13483 0.180193 3.43083 0.618193 2.02683 2.02219C0.619832 3.42919 0.184832 5.13019 0.0918317 7.05019C-0.00116826 8.70619 0.0138318 10.3472 0.0138318 12.0002C0.0138318 13.6532 -0.00116826 15.2972 0.0918317 16.9502C0.184832 18.8702 0.622832 20.5742 2.02683 21.9782C3.43383 23.3852 5.13483 23.8202 7.05483 23.9132C8.71083 24.0062 10.3518 23.9912 12.0048 23.9912C13.6608 23.9912 15.3018 24.0062 16.9548 23.9132C18.8748 23.8202 20.5788 23.3822 21.9828 21.9782C23.3898 20.5712 23.8248 18.8702 23.9178 16.9502C24.0138 15.2972 23.9958 13.6562 23.9958 12.0002ZM21.3558 19.0742C21.1368 19.6202 20.8728 20.0282 20.4498 20.4482C20.0268 20.8712 19.6218 21.1352 19.0758 21.3542C17.4978 21.9812 13.7508 21.8402 12.0018 21.8402C10.2528 21.8402 6.50283 21.9812 4.92483 21.3572C4.37883 21.1382 3.97083 20.8742 3.55083 20.4512C3.12783 20.0282 2.86383 19.6232 2.64483 19.0772C2.02083 17.4962 2.16183 13.7492 2.16183 12.0002C2.16183 10.2512 2.02083 6.50119 2.64483 4.92319C2.86383 4.37719 3.12783 3.96919 3.55083 3.54919C3.97383 3.12919 4.37883 2.86219 4.92483 2.64319C6.50283 2.01919 10.2528 2.16019 12.0018 2.16019C13.7508 2.16019 17.5008 2.01919 19.0788 2.64319C19.6248 2.86219 20.0328 3.12619 20.4528 3.54919C20.8758 3.97219 21.1398 4.37719 21.3588 4.92319C21.9828 6.50119 21.8418 10.2512 21.8418 12.0002C21.8418 13.7492 21.9828 17.4962 21.3558 19.0742Z"
                    fill = "#E61F5A"
                  />
                </g>
                <defs>
                  <clipPath id    = "clip0_964_12976">
                  <rect     width = "24" height = "24" fill = "white" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </li>
          <li>
            <a href = "#"
              ><svg
                width   = "24"
                height  = "20"
                viewBox = "0 0 24 20"
                fill    = "none"
                xmlns   = "http://www.w3.org/2000/svg"
              >
                <g clip-path = "url(#clip0_964_12978)">
                  <path
                    d    = "M24.0004 2.46548C23.1188 2.85141 22.1594 3.12917 21.1711 3.23735C22.1971 2.61879 22.9655 1.64156 23.332 0.489007C22.3692 1.07022 21.3145 1.47778 20.2146 1.6936C19.7549 1.19488 19.1989 0.797581 18.5813 0.526453C17.9636 0.255325 17.2976 0.116179 16.6247 0.117688C13.902 0.117688 11.7123 2.3573 11.7123 5.10564C11.7123 5.49158 11.7584 5.87752 11.8333 6.24884C7.7565 6.03248 4.12048 4.05601 1.7032 1.0299C1.26274 1.79335 1.03193 2.66261 1.03477 3.54727C1.03477 5.27814 1.902 6.80435 3.22444 7.70195C2.44511 7.6708 1.68402 7.45342 1.00308 7.06749V7.12889C1.00308 9.5527 2.69143 11.5613 4.94161 12.0233C4.51912 12.1347 4.08449 12.1916 3.64797 12.1929C3.32817 12.1929 3.02565 12.1607 2.72024 12.1168C3.34257 14.0933 5.15482 15.5289 7.3128 15.5757C5.62444 16.9177 3.50968 17.7071 1.2134 17.7071C0.801397 17.7071 0.421085 17.6925 0.0263672 17.6457C2.20452 19.0637 4.78891 19.8824 7.5721 19.8824C16.6074 19.8824 21.5514 12.2864 21.5514 5.69332C21.5514 5.47696 21.5514 5.2606 21.537 5.04424C22.4936 4.33377 23.332 3.45371 24.0004 2.46548Z"
                    fill = "#21A6DF"
                  />
                </g>
                <defs>
                  <clipPath id = "clip0_964_12978">
                    <rect
                      width     = "24"
                      height    = "19.7647"
                      fill      = "white"
                      transform = "translate(0 0.117676)"
                    />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </li>
          <li>
            <a href = "#"
              ><svg
                width   = "24"
                height  = "18"
                viewBox = "0 0 24 18"
                fill    = "none"
                xmlns   = "http://www.w3.org/2000/svg"
              >
                <g clip-path = "url(#clip0_964_12980)">
                  <path
                    d    = "M23.4699 2.9313C23.3335 2.39833 23.0663 1.9124 22.6951 1.52212C22.324 1.13185 21.8619 0.850924 21.355 0.707468C19.4884 0.17627 11.9879 0.17627 11.9879 0.17627C11.9879 0.17627 4.48729 0.17627 2.62071 0.707468C2.11385 0.850924 1.65172 1.13185 1.28057 1.52212C0.90941 1.9124 0.642248 2.39833 0.50582 2.9313C0.157288 4.93298 -0.0118455 6.96464 0.000644257 8.99956C-0.0118455 11.0345 0.157288 13.0661 0.50582 15.0678C0.642248 15.6008 0.90941 16.0867 1.28057 16.477C1.65172 16.8673 2.11385 17.1482 2.62071 17.2917C4.48729 17.8229 11.9879 17.8229 11.9879 17.8229C11.9879 17.8229 19.4884 17.8229 21.355 17.2917C21.8619 17.1482 22.324 16.8673 22.6951 16.477C23.0663 16.0867 23.3335 15.6008 23.4699 15.0678C23.8184 13.0661 23.9876 11.0345 23.9751 8.99956C23.9876 6.96464 23.8184 4.93298 23.4699 2.9313ZM9.59041 12.781V5.21815L15.8152 8.99956L9.59041 12.781Z"
                    fill = "#E42F08"
                  />
                </g>
                <defs>
                  <clipPath id = "clip0_964_12980">
                    <rect
                      width     = "24"
                      height    = "17.6842"
                      fill      = "white"
                      transform = "translate(0 0.157715)"
                    />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </li>
        </ul>
      </section>
    </footer>
        </body>
    </html>
    <?php
} else {
    echo "Erro ao obter os dados do carrinho: " . $conexao->error;
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
