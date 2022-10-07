<?php
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }

    echo "<br>";
}

for ($i = 1; $i <= 50; $i++) {
    if ($i % 3 == 0) {
        echo "Perulangan ke $i";
        echo "<br>";
    }
}
