<?php
$name = 'Sebastian';

$cars = array(
    "Ferrari" => 250000,
    "Toyota" => 30000,
    "Hyundai" => 25000,
    "BMW" => 65000
);

$hateCars = array("Mitsubishi", "Subaru", "Kia", "Tesla");

$selectedCar = $_GET['car'] ?? "";

require_once 'header.php';
?>

    <h1><?php echo $name; ?>'s Car Dealership</h1>
    <p>Click a car button below to view its price and details:</p>

    <div>
        <?php foreach ($cars as $brand => $price): ?>
            <a href="?car=<?php echo $brand; ?>">
                <button type="button"><?php echo $brand; ?></button>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if ($selectedCar != ""): ?>
        <h2>Selected Car: <?php echo $selectedCar; ?></h2>

        <?php
        $price = $cars[$selectedCar] ?? 0;

        $details = match ($selectedCar) {
            "Ferrari" => "High-speed luxury sports car.",
            "Toyota" => "Reliable and fuel-efficient daily car.",
            "Hyundai" => "Affordable and modern city car.",
            "BMW" => "Comfortable performance sedan.",
            default => "Car not found."
        };
        ?>

        <p>Price: $<?php echo $price; ?></p>
        <p>Details: <?php echo $details; ?></p>

        <?php
        if ($price <= 30000) {
            echo "<p>Budget Tier: Affordable</p>";
        } elseif ($price <= 70000) {
            echo "<p>Budget Tier: Mid-Range</p>";
        } else {
            echo "<p>Budget Tier: Luxury</p>";
        }

        switch ($selectedCar) {
            case "Ferrari":
                echo "<p>Origin: Italy</p>";
                break;
            case "Toyota":
                echo "<p>Origin: Japan</p>";
                break;
            case "Hyundai":
                echo "<p>Origin: South Korea</p>";
                break;
            case "BMW":
                echo "<p>Origin: Germany</p>";
                break;
            default:
                echo "<p>Origin: Unknown</p>";
                break;
        }
        ?>

        <h3>5-Year Installment Plan</h3>
        <ul>
            <?php
            $yearlyPayment = $price / 5;
            for ($year = 1; $year <= 5; $year++):
            ?>
                <li>Year <?php echo $year; ?>: Pay $<?php echo $yearlyPayment; ?></li>
            <?php endfor; ?>
        </ul>

        <h3>Car Life Expectancy</h3>
        <ul>
            <?php
            $maxYears = match ($selectedCar) {
                "Ferrari" => 8,
                "Toyota" => 15,
                "Hyundai" => 10,
                "BMW" => 12,
                default => 5
            };

            $year = 1;
            do {
            ?>
                <li>Year <?php echo $year; ?>: Running strong</li>
            <?php
                $year++;
            } while ($year <= $maxYears);
            ?>
        </ul>

    <?php else: ?>
        <p>No car selected yet. Please choose a car above.</p>
    <?php endif; ?>

    <h3>Cars Not Available Here</h3>
    <ul>
        <?php
        $i = 0;
        while ($i < count($hateCars)):
        ?>
            <li><?php echo $hateCars[$i]; ?></li>
        <?php
            $i++;
        endwhile;
        ?>
    </ul>

<?php include_once 'footer.php'; ?>