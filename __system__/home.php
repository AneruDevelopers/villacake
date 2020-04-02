<?php
    use Model\{Product, Department};

    $sql = new Sql();

    if (isset($_SESSION[Department::SESSION]['tamQuery'])) {
        unset($_SESSION[Department::SESSION]['tamQuery']);
    }
    if (isset($_SESSION[Department::SESSION]['marcaQuery'])) {
        unset($_SESSION[Department::SESSION]['marcaQuery']);
    }
    if (isset($_SESSION[Department::SESSION]['precoQuery'])) {
        unset($_SESSION[Department::SESSION]['precoQuery']);
    }
    if (isset($_SESSION[Department::SESSION]['favQuery'])) {
        unset($_SESSION[Department::SESSION]['precoQuery']);
    }

    // PRODUTOS COM PROMOÇÕES COMUNS
    $listSimplePromotionalProducts = Product::listSimplePromotionalProducts();
    
    // PRODUTOS COM PROMOCÕES PERSONALIZADAS
    $listCustomPromotionalProducts = Product::listCustomPromotionalProducts();
    if (count($listCustomPromotionalProducts) > 0) {
        $promo_id = "";
        $c = 0;
        foreach ($listCustomPromotionalProducts as $row) {
            if ($promo_id != $row['promo_id']) {
                $products_top[$c] = '
                    <div class="l-prods">
                        <div class="loop owl-carousel">
                ';
                $promo_id = $row['promo_id'];
            } else {
                $products_top[$c] = '';
            }
            $produtos_promo[$c] = '
                <div class="divProdCarousel">
                    <div class="btnFavorito' . $row['produto_id'] . '">
                        <i class="far fa-heart addFavorito" id="' .  $row['produto_id'] . '"></i>
                    </div>
                    <a class="linksProdCarousel" id-produto="' .  $row['produto_id'] . '">
                        <img class="divProdImg" src="' .  Project::baseUrlAdm() . "img-produtos/" . $row['produto_img'] . '">
                        <div class="divisorFilterCar"></div>
                        <p class="divProdPromo">-' .  $row['promo_desconto'] . '%</p>
                        <h4 class="divProdTitle">
                            ' .  $row['produto_nome'] . " - " . $row['produto_tamanho'] . '
                        </h4>
                        <p class="divProdPrice">
                            <span class="divProdPrice1">R$ ' .  $row['produto_preco'] . '</span> R$ ' . $row['produto_desconto'] . '
                        </p>
                    </a>
            ';
            if ($row['empty']) {
                $produtos_promo[$c] .= '
                    <div>
                        <div class="quantity">
                            <span class="esgotQtd">ESGOTADO</span>
                        </div>
                        <form class="formBuy">
                            <button class="btnBuy" type="submit">ADICIONAR</button>
                        </form>
                    </div>
                ';
            } else {
                $produtos_promo[$c] .= '
                    <div>
                        <form class="formBuy">
                            <input type="hidden" value="' .  $row['produto_id'] . '" name="id_prod"/>
                            <div class="quantity">
                                <input type="number" min="0" max="20" value="' .  $row['carrinho'] . '" class="inputQtd inputBuy' .  $row['produto_id'] . '" name="qtd_prod"/>
                            </div>
                            <button class="btnBuy" type="submit">ADICIONAR</button>
                        </form>
                    </div>
                ';
            }
            $produtos_promo[$c] .= '
                </div>
            ';
            $c++;
        }
    }

    $banners = $sql->select("SELECT * FROM banner WHERE banner_status = 1");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Villa Cake - Confeitaria | Início</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- <link rel="icon" href="<?= Project::baseUrl(); ?>style/img/e-dark-icon.png"/> -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= Project::baseUrl(); ?>style/css/main.css"/>
    <link href="<?= Project::baseUrl(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
    <!-- <link href="<?= Project::baseUrl(); ?>style/libraries/aos-master/dist/aos.css" rel="stylesheet"/> -->
    <link rel="stylesheet" href="<?= Project::baseUrl(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?= Project::baseUrl(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?= Project::baseUrl(); ?>style/fonts/Icons/icons_pack/font/flaticon.css"/> -->
    <link rel="stylesheet" href="<?= Project::baseUrl(); ?>style/libraries/Remodal-master/dist/remodal.css" type="text/css"/>
    <link rel="stylesheet" href="<?= Project::baseUrl(); ?>style/libraries/Remodal-master/dist/remodal-default-theme.css" type="text/css"/>
</head>
<body>
    <div class="remodal-bg">
        <div class="l-wrapper">
            <header class="l-headerNav" id="headerNav">
            <?php
                include('functions/includes/header.php');
            ?>
            </header>

            <div class="l-bottomNav" id="bottomNav">
            <?php
                include('functions/includes/bottom.php');
            ?>
            </div>

            <!-- IGNORAR POR ENQUANTO OS BANNERS NÃO ESTÃO SENDO COLOCADOS NO BANCO -->

            <?php
                if (count($banners) > 0):?>
                    <!-- -------------------- -->
                    <!-- Carousel -->
                    <div class="l-carousel">
                        <div id="owl-demo" class="owl-carousel">
                            <?php
                            foreach ($banners as $row):?>
                                <div class="item">
                                    <img src="<?= Project::baseUrl(); ?>style/img/banner/<?= $row['banner_path']; ?>" alt="<?= $row['banner_nome']; ?>" title="<?= $row['banner_nome']; ?>"/>
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <?php
                endif;
            ?>

            <!-- ---- -->

            <div class="l-carousel show-on-scroll">
                <h3 class="callToSearchText">Procure as delícias em nosso <span>CARDÁPIO</span></h3>
                <div class="searchSpace">
                    <div class="searchBoxHeader" id="searchBoxHeader">
                        <form class="formPesquisaHeader" method="get" action="<?= Project::baseUrlPhp(); ?>pesquisa">
                            <input class="pesquisaTxtHeader" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ; ?>" type="text" name="q" placeholder=" Clique e pesquise" title="Pesquise por produtos">
                            <button class="pesquisaBtnHeader" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr class="searchDivLine">
            </div>
            
            <!-- Title/Display Products -->

            <div class="l-main">

                <!-- PROVISÓRIO PORQUE NÃO HÁ PRODUTOS NO BANCO -->

                <div class="productCarouselDivTitle">
                    <h3 class="productCarouselTitle">
                        Bolo Caseiro
                    </h3>
                    <h4 class="productCarouselSubTitle">
                        Bolos com lembrança de família
                    </h4>
                </div>
                <div class="carousel-wrap">
                    <div class="loopCarousel owl-carousel owl-theme">
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                    </div>
                    <div class="owl-theme">
                        <div class="owl-controls">
                            <div class="custom-nav owl-nav"></div>
                        </div>
                    </div>
                </div>

                <!--  -->

                <div class="newsDiv">
                    <div class="leftNewsDiv">
                        <h4 class="newsDivTitle">
                            Grandes descontos com cupons!
                        </h4>
                    </div>
                    <div class="rightNewsDiv">
                        <h4 class="newsDivTitle">
                            Grandes descontos com cupons!
                        </h4>
                    </div>
                </div>

                <!-- PROVISÓRIO PORQUE NÃO HÁ PRODUTOS NO BANCO -->

                <div class="productCarouselDivTitle">
                    <h3 class="productCarouselTitle">
                        Bolo De Pote
                    </h3>
                    <h4 class="productCarouselSubTitle">
                        Deliciosos bolos para toda a hora
                    </h4>
                </div>
                <div class="carousel-wrap">
                    <div class="loopCarousel2 owl-carousel owl-theme">
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                    </div>
                    <div class="owl-theme">
                        <div class="owl-controls">
                            <div class="custom-nav2 owl-nav"></div>
                        </div>
                    </div>
                </div>

                <!--  -->

                <div class="newsDiv">
                    <div class="uniqueNewsDiv">
                        <h4 class="newsDivTitle">
                            Grandes descontos com cupons!
                        </h4>
                    </div>
                </div>

                <!-- PROVISÓRIO PORQUE NÃO HÁ PRODUTOS NO BANCO -->

                <div class="productCarouselDivTitle">
                    <h3 class="productCarouselTitle">
                        Tortas doces
                    </h3>
                    <h4 class="productCarouselSubTitle">
                        Torta doce não pode faltar
                    </h4>
                </div>
                <div class="carousel-wrap">
                    <div class="loopCarousel3 owl-carousel owl-theme">
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                        <div class="individualCarouselCard">  </div>
                    </div>
                    <div class="owl-theme">
                        <div class="owl-controls">
                            <div class="custom-nav3 owl-nav"></div>
                        </div>
                    </div>
                </div>

                <!--  -->

                <!-- NOVO MODAL -->

                <div class="remodal" data-remodal-id="modal">
                    <div class="modal-content">
                        <button data-remodal-action="close" class="remodal-close"></button>
                        <div class="modalLeftContent">
                            <form id="form-login">
                                <h4 class="titleModalLogin">LOG IN</h4>
                                <div class="outsideSecInputCadModal">
                                    <div class="field -md">
                                        <input type="text" name="usu_email_login" id="usu_email_login" class="placeholder-shown" placeholder=" "/>
                                        <label class="labelFieldCad" for="usu_email_login"><strong><i class="fas fa-envelope"></i> EMAIL</strong></label>
                                    </div>
                                    <div class="help-block"></div><br/>
                                </div>
                                <div class="outsideSecInputCadModal">
                                    <div class="field -md">
                                        <input type="password" name="usu_senha_login" id="usu_senha_login" class="placeholder-shown" placeholder=" "/>
                                        <label class="labelFieldCad" for="usu_senha_login"><strong><i class="fas fa-unlock"></i> SENHA</strong></label>
                                    </div>
                                    <div class="help-block"></div><br/>
                                </div>
                                <div class="mantConLoginModal">
                                    <input type="checkbox" class="radioCadModal" id="usu_cookie_login" name="usu_cookie_login"/> 
                                    <label class="labelCadSexRadioModal" for="usu_cookie_login">Lembre-se de mim</label>
                                </div>
                                <button class="btnSend" type="submit" id="btn-login">ENTRAR</button>
                                <div class="help-block-login"></div>
                                <p class="linkForgotPassword">
                                    <a href="<?= Project::baseUrlPhp(); ?>usuario/esqueceu-senha">Esqueceu a senha?</a>
                                </p>
                            </form>
                        </div>
                        <div class="modalRightContent">
                            <p class="textModal">Olá, amigo!</p>
                            <p class="textModalBottom">Entre com seus detalhes pessoais e comece sua jornada conosco</p>
                            <div class="divLinkCad">
                                <a class="linkCadModal" href="<?= Project::baseUrlPhp(); ?>usuario/cadastro">Cadastre-se já</a>
                            </div>    
                        </div>
                    </div>
                </div>

                <!-- <div class="l-prods">
                    <?php
                        if (count($listSimplePromotionalProducts) > 0):?>
                            <div class="loop owl-carousel">
                                <?php
                                foreach ($listSimplePromotionalProducts as $v):?>
                                    <div class="divProdCarousel">
                                        <div class="btnFavorito<?= $v['produto_id']; ?>">
                                            <i class="far fa-heart addFavorito" id="<?= $v['produto_id']; ?>"></i>
                                        </div>
                                        <a class="linksProdCarousel" id-produto="<?= $v['produto_id']; ?>">
                                            <img class="divProdImg" src="<?= Project::baseUrlAdm() . "img-produtos/" . $v['produto_img']; ?>">
                                            <div class='divisorFilterCar'></div>
                                            <p class="divProdPromo">-<?= $v['produto_desconto_porcent']; ?>%</p>
                                            <h4 class="divProdTitle">
                                                <?= $v['produto_nome'] . " - " . $v['produto_tamanho']; ?>
                                            </h4>
                                            <p class="divProdPrice">
                                                <span class="divProdPrice1">R$ <?= $v['produto_preco']; ?></span> R$ <?= $v['produto_desconto']; ?>
                                            </p>
                                        </a>
                                        <?php 
                                            if ($v['empty']):?>
                                                <div>
                                                    <div class="quantity">
                                                        <span class="esgotQtd">ESGOTADO</span>
                                                    </div>
                                                    <form class="formBuy">
                                                        <button class="btnBuy" type="submit">ADICIONAR</button>
                                                    </form>
                                                </div>
                                                <?php
                                            else:?>
                                                <div>
                                                    <form class="formBuy">
                                                        <input type="hidden" value="<?= $v['produto_id']; ?>" name="id_prod"/>
                                                        <div class="quantity">
                                                            <input type="number" min="0" max="20" value="<?= $v['carrinho']; ?>" class="inputQtd inputBuy<?= $v['produto_id']; ?>" name="qtd_prod"/>
                                                        </div>
                                                        <button class="btnBuy" type="submit">ADICIONAR</button>
                                                    </form>
                                                </div>
                                                <?php
                                            endif;
                                        ?>
                                    </div>
                                    <?php
                                endforeach;?>
                            </div>
                            <?php
                        else:?>
                            <h2 class="sem_promo">Sem promoções hoje. Aproveite a barra de pesquisa</h2>
                            <?php
                        endif;
                    ?>
                </div>  -->
                    <!-- <center>
                        <img class="bannerDiaDosPais" width="100%"  src="<?= Project::baseUrl(); ?>style/img/banner/bannerDiaDosPaisRoxo.png" alt="Banner Dia dos Pais">
                    </center> -->
                    <?php
                    if (count($listCustomPromotionalProducts) > 0):
                        foreach ($produtos_promo as $k => $v):
                            echo $products_top[$k];
                            echo $v;

                            $c = $k + 1;
                            if (isset($products_top[$c])) {
                                if ($products_top[$c] != '') {
                                    echo '
                                            </div>
                                        </div>
                                    ';
                                }
                            } else {
                                echo '
                                        </div>
                                    </div>
                                ';
                            }
                        endforeach;
                    endif;
                ?>
            </div>

            <?php
                // include('functions/includes/modal.php');
            ?>

            <div class="l-footer id='footer'">
            <?php
                include('functions/includes/footer.php');
            ?>
            </div>
            <div class="l-footerBottom" id="footerBottom">
            <?php
                include('functions/includes/bottomFooter.html');
            ?>
            </div>
        </div>
        <script src="<?= Project::baseUrl(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
        <script src="<?= Project::baseUrl(); ?>style/libraries/sweetalert2.all.min.js"></script>
        <script src="<?= Project::baseUrl(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
        <script src="<?= Project::baseUrl(); ?>style/libraries/Remodal-master/dist/remodal.min.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/util.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/verificaLogin.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/favoritos.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/attCarrinho.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/listArmazem.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/main.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/login.js"></script>
        <script src="<?= Project::baseUrl(); ?>js/show-on-scroll.js"></script>
        <?php
            if (isset($_SESSION['msg'])):?>
                <script>
                    Swal.fire({
                        title: "e.conomize informa:",
                        text: "<?= $_SESSION['msg']; ?>",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#A94442",
                        confirmButtonText: "Ok"
                    });
                </script>
                <?php
                unset($_SESSION['msg']);
            endif;
        ?>
    </div>
</body>
</html>