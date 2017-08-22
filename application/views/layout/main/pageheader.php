<div class="pageheader">
    <h2><i class="fa fa-home"></i> <?= $pagetitle?> <span><?= $subpagetitle?></span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
        <?php foreach( $breadcrums as $link ) {?>
        <li><?= $link?></li>
        <?php }?>
        </ol>
    </div>
</div>