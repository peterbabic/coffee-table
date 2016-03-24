<?php

namespace Coffee;

require __DIR__ . '/vendor/autoload.php';

try {

    ?>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            background-color: #deb887;
            width: 30px;
            height: 30px;
            text-align: center;
            color: #000000;
        }

        td.coffee {
            background-color: #8b4513;
            font-weight: bold;
            color: #ded8de;
        }
    </style>
    <?php

    $map = [
            [0, 1, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1],
            [0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
            [0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
            [1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
            [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
            [0, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0],
            [1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0],
    ];

    $table = new Table($map);

    echo '<table>' . "\n";
    foreach ($table->getStructuredTiles() as $tileRow) {
        echo '<tr>' . "\n";
        /** @var Tile $tile */
        foreach ($tileRow as $tile) {
            $spotNumber = 0;
            $attribute = '';

            if (!is_null($tile->getSpot())) {
                $spotNumber = $tile->getSpot()->getNumber();
                $attribute = ' class="coffee"';
            }

            echo '<td' . $attribute . '>' . $spotNumber . '</td>' . "\n";
        }
        echo '</tr>' . "\n";
    }
    echo '</table>' . "\n";
    echo '</br>' . "\n";

    echo 'Najväčšia kávová kaluž je s číslom ';
    $numbers = '';
    $delimiter = ', ';
    foreach ($table->getLargestSpots() as $spot) {
        $numbers .= $spot->getNumber() . $delimiter;
    }
    echo rtrim($numbers, $delimiter) . '<br>' . "\n";

    echo 'Kaluž je veľká ' . $table->getFirstLargestSpot()->getSize() . ' políčok.</br>' . "\n";
    echo 'Počet kaluží je: ' . $table->getSpotsCount() . '<br>' . "\n";
}
catch (\Exception $e) {
    // TODO: provide more information, like the file:line for example
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}

