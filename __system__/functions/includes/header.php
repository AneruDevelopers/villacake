<?php
    use Model\Department;
    use Model\Storage;
?>
<div class="wrapperAdjusterDiv">
<div class="topNavCity">
    <h6 class="linkMenuTopNavCityMobile linkArm" id="myBtnArmazemMobile" title="Veja os armazéns disponíveis">
        <i class="fas fa-globe-americas"></i> <span class="armName"><?= isset($_SESSION[Storage::SESSION]['arm_cm']) ? $_SESSION[Storage::SESSION]['arm_cm'] : $_SESSION[Storage::SESSION]['arm']; ?></span>
    </h6>
</div>
<div class="companyNameSpace">
    <a class="linkCompanyName" href="<?= Project::baseUrlPhp(); ?>">
        <img src="<?= Project::baseUrl(); ?>style/img/banner/VillaCakeLog.png" alt="Villa Cake - Confeitaria online" title="Villa Cake - Bolos e Doces">
    </a>
</div>
<nav class="headerNavDiv">
  <ul class="headerMenuDiv">
    <li><a href="#!">HOME</a></li>
    <li><a href="#!">NOVIDADES</a></li>
    <li><a href="#!">CONTATO</a></li>
    <li><a href="#!">FAQ</a></li>
  </ul>
</nav>
<div class="rightHeaderNavDiv">
    <ul class="menuTopNav">
        <li class="celulaTopNavCity linkArm" id="myBtnArmazem" title="Veja os armazéns disponíveis">
            <a class="linkMenuTopNavCity" href="#">
                <span class="armName"><?= isset($_SESSION[Storage::SESSION]['arm_cm']) ? $_SESSION[Storage::SESSION]['arm_cm'] : $_SESSION[Storage::SESSION]['arm']; ?></span>
            </a>
        </li>
        <li class="celulaTopNav">
            <a class="linkMenuTopNav" href="<?= Project::baseUrlPhp(); ?>compra/procedimento">
                <i class="fas fa-shopping-cart"></i> CARRINHO
            </a>
        </li>
        <li data-remodal-target="modal" class="celulaTopNav" id="myBtn2">
            <a class="linkMenuTopNav" href="#">
                    <i class="far fa-user-circle"></i> ENTRAR
            </a>
        </li>
    </ul>
    <ul class="menuTopNavMobile">
        <li class="celulaTopNavMobile">
            <a class="linkMenuTopNavMobile" href="#" id="myBtn">
                <i class="far fa-user-circle"></i>
            </a>
        </li>
        <li class="celulaTopNavMobile">
            <a class="linkMenuTopNavMobile" href="<?= Project::baseUrlPhp(); ?>compra/procedimento">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </li>
    </ul>
</div>
<!-- <div class="searchSpace">
    <div class="searchBoxHeader" id="searchBoxHeader">
        <form class="formPesquisaHeader" method="get" action="<?= Project::baseUrlPhp(); ?>pesquisa">
            <input class="pesquisaTxtHeader" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ; ?>" type="text" name="q" placeholder=" Clique e pesquise" title="Pesquise por produtos">
            <button class="pesquisaBtnHeader" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div> -->

<!--  -->

<div class="searchSpaceMobile">
  <div class="searchBoxHeader" id="searchBoxHeader">
      <form class="formPesquisaHeader" method="get" action="<?= Project::baseUrlPhp(); ?>pesquisa">
            <input class="pesquisaTxtHeader" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ; ?>" type="text" name="q" placeholder=" Clique e pesquise" title="Pesquise por produtos">
            <button class="pesquisaBtnHeader" type="submit">
                <i class="fas fa-search"></i>
            </button>
      </form>
  </div>
</div>

<!-- <?php
    $listDepartment = Department::listAll();

    if (count($listDepartment) > 0):?>
        <div class="menuCarousel owl-one owl-carousel departamentos">
            <?php
            foreach ($listDepartment as $row):?>
                <div class="celulaMenuCarousel">
                    <a class="linkBtnMenu" title="<?= ($row['depart_desc'] != "") ? $row['depart_desc'] : Project::formatFirstName($row['depart_nome']); ?>" href="<?= Project::baseUrlPhp() . $row['depart_url']; ?>">
                        <i class="<?= $row['depart_icon']; ?>"></i>
                        <h5 class="linkMenuCarousel"><?= $row['depart_nome']; ?></h5>
                    </a>
                </div>
                <?php
            endforeach;?>
        </div>
        <?php
    endif;
?> -->
</div>