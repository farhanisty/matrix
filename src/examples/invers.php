<?php

use Farhanisty\Matrix\Custom\Visualizer\BasicMatrixVisualizer;
use Farhanisty\Matrix\Engine\Matrix;
use Farhanisty\Matrix\Facades\ERO\ElementaryRowOperationImpl;

require_once(__DIR__ . "/../../vendor/autoload.php");

// Setup
$visualizer = new BasicMatrixVisualizer();
$matrix = new Matrix(2, 2, [[2, 3], [3, 5]]);
$matrixIdentitas = new Matrix(2, 2, [[1, 0], [0, 1]]);
$ero = new ElementaryRowOperationImpl();

// Visualisasi Matrix Awal
echo "Matrix Awal\n";
$visualizer->visualize($matrix);

// Setting Matrix Awal
$ero->setMatrix($matrix);


// Operasi OBE
$ero->scalarMultiplication(4, 1); // 4 * B1
$ero->scalarMultiplication(3, 2); // 3 * B2
$ero->swapRow(1, 2); // B1 <=> B2
$ero->sumByMultiplesOfOtherRow(-1, 2, 1); // -1B2 + B1
$ero->sumByMultiplesOfOtherRow(-8, 1, 2); // 8B1 + B2
$ero->scalarMultiplication(-1 * (1 / 12), 2); // -(1/12) * B2
$ero->sumByMultiplesOfOtherRow(-3, 2, 1); // -3B2 + B1

// Eksekusi OBE
$ero->executeAll();

// Re-assign matrix facades ke matrix identitas
$ero->setMatrix($matrixIdentitas);

// Visualisasi matrix identitas awal
echo "Matrix Identitas awal\n";
$visualizer->visualize($matrixIdentitas);

// Reset posisi operasi menjadi yang paling awal
$ero->resetPosition();

// Perulangan untuk melakukan operasi yang sama pada matrix identitas(Visualisasi setiap langkah)
do {
  $ero->execute();
  echo "Operasi : " . $ero->getActiveOperation()->getDescription() . "\n";
  $visualizer->visualize($matrixIdentitas);
} while ($ero->next());

// Visualisasi matrix identitas hasil OBE(Matrix Invers)
echo "Matrix Hasil Invers\n";
$visualizer->visualize($matrixIdentitas);
