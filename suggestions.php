<?php
require 'db.php';

$keywoard = $_GET["keywoard"];
$sql = "SELECT * FROM animal WHERE name LIKE '%$keywoard%'";
$sql_type = "SELECT type.name_type, type.id, animal.type_id, animal.name FROM type 
            INNER JOIN animal ON type.id = animal.type_id 
            WHERE animal.name LIKE '%$keywoard%' GROUP BY type.name_type";
$sql_count = "SELECT COUNT(*) FROM animal WHERE name LIKE '%$keywoard%'";

$results = $conn->query($sql);
$types = $conn->query($sql_type);
$counts = $conn->query($sql_count);

?>
<?php
if ($counts->fetch_row()[0] != 0) {
    foreach ($types as $type) :
?>
        <ul>
            <p style="font-weight: bold;"><?= $type['name_type'] ?></p>
            <?php
            foreach ($results as $result) :
                if ($result['type_id'] == $type['id']) {
            ?>
                    <li><?= $result['name'] ?></li>
        <?php }
            endforeach;
        endforeach; ?>
        </ul>
    <?php
} else {
    ?>
        <div style="color: #c7c7c7;padding-left: .8rem;">No Product</div>
    <?php }
$conn->close(); ?>