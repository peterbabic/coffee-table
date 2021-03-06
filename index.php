<?php

namespace Coffee;

// If 'vendor/' folder does not exist, please run 'composer install'
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

            $attribute = '';
            if ($tile->isRepresentingSpot()) {
                $attribute = ' class="coffee"';
            }

            $spotNumber = $tile->getSpot()->getNumber();

            echo '<td' . $attribute . '>' . $spotNumber . '</td>' . "\n";
        }
        echo '</tr>' . "\n";
    }
    echo '</table>' . "\n";
    echo '</br>' . "\n";

    // TODO: introduce i18n/pluralism
    echo 'The biggest coffee spot is of number ';
    $numbers = '';
    $delimiter = ', ';
    foreach ($table->getLargestSpots() as $spot) {
        $numbers .= $spot->getNumber() . $delimiter;
    }
    echo rtrim($numbers, $delimiter) . '<br>' . "\n";

    echo 'The spot is ' . $table->getFirstLargestSpot()->getSize() . ' tiles large.</br>' . "\n";
    echo 'The number of spots is: ' . $table->getSpotsCount() . '<br>' . "\n";
}
catch (\Exception $e) {
    // TODO: provide more information, like the file:line for example
    echo '</br>' . "\n";
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}

