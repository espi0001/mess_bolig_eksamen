<?php
require_once __DIR__."/../db.php";

$pk   = $_GET["key"] ?? "";
$sql  = "SELECT * FROM items WHERE pk = :pk";
$stmt = $_db->prepare($sql);
$stmt->bindValue(":pk", $pk);
$stmt->execute();
$item = $stmt->fetch();

if(!$item){
    http_response_code(404);
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
            <img src="<?= htmlspecialchars ($item["main_image_path"]) ?>" alt="Boligbillede" class="item-img" onerror="this.style.display='none'">
            <?php endif; ?>

            <?php if($item["floor_plan_path"]): ?>
            <img src="<?= htmlspecialchars ($item["floor_plan_path"]) ?>" alt="Plantegning" class="item-img" onerror="this.style.display='none'">
            <?php endif; ?>

            <div class="item-info">
                <h2 class="item-type"><?= htmlspecialchars ($item["type"]) ?> </h2>
                <h2>DKK <?= number_format((float)($item["price"] ?? 0), 0, ',', '.') ?></h2>
            </div>

            <div class="item-stats">
                <div>
                    <h3>Adresse</h3>
                    <p><?= htmlspecialchars ($item["road_name"]) ?> <?= htmlspecialchars ($item["house_number"]) ?>, <?= htmlspecialchars ($item["zip_code"]) ?> <?= htmlspecialchars ($item["city_name"]) ?>  </p>
                </div>
                <div>
                    <h3>Grundareal</h3>
                    <p><?= htmlspecialchars ($item["lot_square_meters"]) ?> m²</p>
                </div>
                <div>
                    <h3>Boligareal</h3>
                    <p><?= htmlspecialchars ($item["floor_square_meters"]) ?> m²</p>
                </div>
                <div>
                    <h3>Pris per. meter</h3>
                    <p>DKK <?= number_format((float)($item["price_per_meter"] ?? 0), 0, ',', '.') ?></p>
                </div>
                <div>
                    <h3>Antal værelser</h3>
                    <p><?= htmlspecialchars ($item["number_of_rooms"]) ?></p>
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
                    <p><?= htmlspecialchars ($item["energy_label"]) ?></p>
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

<?php if(!$item["is_sold"]): ?>
    <form mix-post="apis/api-buy-item.php" mix-update="#buy-section">
        <input type="hidden" name="key" value="<?= htmlspecialchars ($item["pk"]) ?>">
        <button id="buy-section" class="btn-primary" type="submit">
            Køb bolig
        </button>
    </form>
<?php endif; ?>

    </section>
</browser>