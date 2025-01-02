<?php
// Parameters for the Julia set
$width = 800;
$height = 800;
$maxIterations = 300;
$cRe = -0.7;
$cIm = 0.27015;

// Create an image
$image = imagecreatetruecolor($width, $height);

// Colors
$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);

// Draw the Julia set
for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $zx = 1.5 * ($x - $width / 2) / (0.5 * $width);
        $zy = ($y - $height / 2) / (0.5 * $height);
        $i = $maxIterations;
        while ($zx * $zx + $zy * $zy < 4 && $i > 0) {
            $tmp = $zx * $zx - $zy * $zy + $cRe;
            $zy = 2.0 * $zx * $zy + $cIm;
            $zx = $tmp;
            $i--;
        }
        $color = $i == 0 ? $black : imagecolorallocate($image, $i % 256, $i % 256, $i % 256);
        imagesetpixel($image, $x, $y, $color);
    }
}

// Save the image to a file
$imagePath = 'juliaSet.png';
imagepng($image, $imagePath);
imagedestroy($image);

// Output the image path
echo $imagePath;
?>