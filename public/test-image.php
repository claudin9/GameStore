<?php
// Verifica se o arquivo existe
$imagePath = __DIR__ . '/images/products/game1.jpg';
if (file_exists($imagePath)) {
    echo "A imagem existe em: " . $imagePath . "<br>";
    echo "Permissões do arquivo: " . decoct(fileperms($imagePath) & 0777) . "<br>";
    echo '<img src="images/products/game1.jpg" alt="Test Image">';
} else {
    echo "A imagem não existe no caminho: " . $imagePath;
}
?> 