<?php 

$rows = 10;
$cols = 10;
$mines = 15;

// Initialize the game board with all cells hidden
$board = [];
for ($i = 0; $i < $rows; $i++) {
  for ($j = 0; $j < $cols; $j++) {
    $board[$i][$j] = "#";
  }
}

// Place mines randomly on the board
$mineLocations = [];
for ($k = 0; $k < $mines; $k++) {
  $i = rand(0, $rows - 1);
  $j = rand(0, $cols - 1);
  if (!in_array([$i, $j], $mineLocations)) {
    $mineLocations[] = [$i, $j];
  } else {
    $k--;
  }
}

// Calculate the number of mines surrounding each cell
$numberOfMines = [];
for ($i = 0; $i < $rows; $i++) {
  for ($j = 0; $j < $cols; $j++) {
    $numberOfMines[$i][$j] = 0;
    foreach ($mineLocations as $mine) {
      if (abs($i - $mine[0]) <= 1 && abs($j - $mine[1]) <= 1) {
        $numberOfMines[$i][$j]++;
      }
    }
  }
}

// Renders the game board (with no fog)
function renderBoard() {
    global $numberOfMines, $rows, $cols, $mineLocations;
  
    echo " ";
    for ($i = 0; $i < $cols; $i++) {
        echo " " . ($i + 1);
    }

    echo "\n";
    for ($i = 0; $i < $rows; $i++) {
        echo ($i + 1) . " ";
        for ($j = 0; $j < $cols; $j++) {
            if (in_array([$i, $j], $mineLocations)) {
                echo "*";
            } else {
                if ($numberOfMines[$i][$j] == 0) {
                    echo " ";
                } else {
                    echo $numberOfMines[$i][$j];
                }
            }
            echo " ";
        }
        echo "\n";
    }
}

// Function to be written
function reveal($selectedRow, $selectedCol) {    
    global $board, $numberOfMines, $rows, $cols, $mineLocations;

    echo "<div style='margin-top: 10px'></div>";

    $lost = false;
    if (in_array([$selectedRow, $selectedCol], $mineLocations)) {
        $lost = true;
        echo "<h2>You lost</h2>";
    }

    echo " ";
    for ($i = 0; $i < $cols; $i++) {
        echo " " . ($i + 1);
    }

    $result = [];
    $numberOfMinesCheck = [];

    for ($i = 0; $i < $rows; $i++) {       
        for ($j = 0; $j < $cols; $j++) {
            if ($i == $selectedRow && $j == $selectedCol && $lost) {
                $result[$i][$j] = '<span style="color: red;font-weight:bold">*&nbsp;</span>';
            } else if ($numberOfMines[$i][$j] == 0 && $i == $selectedRow && $j == $selectedCol) {
                $numberOfMinesCheck[$i+1][$j] = true;
                $numberOfMinesCheck[$i-1][$j] = true;
                $numberOfMinesCheck[$i-1][$j-1] = true;
                $numberOfMinesCheck[$i+1][$j+1] = true;
                $numberOfMinesCheck[$i][$j+1] = true;
                $numberOfMinesCheck[$i][$j-1] = true;
                $numberOfMinesCheck[$i-1][$j+1] = true;
                $numberOfMinesCheck[$i+1][$j-1] = true;

                $result[$i][$j] = " &nbsp;";
            } else if ($numberOfMines[$i][$j] != 0 && $i == $selectedRow && $j == $selectedCol) {
                $result[$i][$j] = $numberOfMines[$i][$j]." ";
            } else {   
                $result[$i][$j] = $board[$i][$j]." ";           
            }
        }
    }

    echo "\n";
    for ($i = 0; $i < $rows; $i++) {
        echo ($i + 1) . " ";
       
        for ($j = 0; $j < $cols; $j++) {
            if (isset($numberOfMinesCheck[$i][$j]) && $numberOfMines[$i][$j] == 0) {
                echo " &nbsp;";
            } else {
                echo $result[$i][$j];
            }
        }

        echo "\n";
    }
}

echo '<pre>';
renderBoard();
reveal(3,3);
echo '</pre>';
?>