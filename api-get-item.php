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
                <h2>DKK <?= number_format((float)($item["price"] ?? 0), 0, ',', '.') ?></h2>
            </div>

            <div class="item-stats">
                <div>
                    <h3>Adresse</h3>
                    <p><?= $item["road_name"] ?> <?= $item["house_number"] ?>, <?= $item["zip_code"] ?> <?= $item["city_name"] ?>  </p>
                </div>
                <div>
                    <h3>Grundareal</h3>
                    <p><?= $item["lot_square_meters"] ?> m²</p>
                </div>
                <div>
                    <h3>Boligareal</h3>
                    <p><?= $item["floor_square_meters"] ?> m²</p>
                </div>
                <div>
                    <h3>Pris per. meter</h3>
                    <p>DKK <?= number_format((float)($item["price_per_meter"] ?? 0), 0, ',', '.') ?></p>
                </div>
                <div>
                    <h3>Antal værelser</h3>
                    <p><?= $item["number_of_rooms"] ?></p>
                </div>
                <div>
                    <h3>Månedlige ydelser</h3>
                    <p>DKK <?= number_format((float)($item["monthly_expenses"] ?? 0), 0, ',', '.') ?></p>
                </div>
                <div>
                    <h3>Antal dage på markedet</h3>
                    <p><?= number_format((float)($item["days_listed"] ?? 0), 0, ',', '.') ?> dage</p>
                </div>
                <?php if($item["energy_label"]): ?>
                <div>
                    <h3>Energimærke</h3>
                    <p><?= $item["energy_label"] ?></p>
                </div>   
                <?php endif; ?>        
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
