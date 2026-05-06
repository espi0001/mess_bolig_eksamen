<?php
require_once __DIR__."/db.php";

$pk   = $_GET["key"] ?? "";
$sql  = "SELECT * FROM items WHERE pk = :pk";
$stmt = $_db->prepare($sql);
$stmt->bindValue(":pk", $pk);
$stmt->execute();
$item = $stmt->fetch();

if(!$item){
    echo "<browser mix-update='#aside'><p>Bolig ikke fundet</p></browser>";
    exit;
}
?>

<browser mix-update="#aside">
    <section class="item-detail">
        <div class="item-main">
            <?php if($item["is_sold"] === 1): ?>
            <div class="item-sold">Solgt</div>
            <?php endif; ?>

            <?php if($item["main_image_path"]): ?>
            <img src="<?= $item["main_image_path"] ?>" alt="Boligbillede" class="item-img" onerror="this.style.display='none'">
            <?php endif; ?>

            <?php if($item["floor_plan_path"]): ?>
            <img src="<?= $item["floor_plan_path"] ?>" alt="Plantegning" class="item-img" onerror="this.style.display='none'">
            <?php endif; ?>

            <div class="item-info">
                <h2 class="item-type"><?= $item["type"] ?> </h2>
                <h2><?= number_format((float)($item["price"] ?? 0), 0, ',', '.') ?> kr.</h2>
            </div>

            <div class="item-stats">
            </div>
        </div>

        <div class="item-status">
            <?php if($item["is_sold"] === 1): ?>
            <span class="status-sold">Solgt</span>
            <?php else: ?>
            <span class="status-available">Ledig</span>
            <?php endif; ?>
        </div>

        <button class="btn-primary">Køb bolig</button>

    </section>
</browser>
