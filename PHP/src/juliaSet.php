<?php
// Parameters for the Julia set
$width = 800;
$height = 800;
$maxIterations = 300;
$cRe = -0.7;
$cIm = 0.27015;

// Create an image
$image = new Imagick();
$image->newImage($width, $height, new ImagickPixel('black'));
$image->setImageFormat('png');

// Create a drawing object
$draw = new ImagickDraw();

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
        $colorValue = $i == 0 ? 0 : (255 * $i / $maxIterations);
        $color = new ImagickPixel("rgb($colorValue, $colorValue, $colorValue)");
        $draw->setFillColor($color);
        $draw->point($x, $y);
    }
}

// Draw the points on the image
$image->drawImage($draw);

// Save the image to a file
$imagePath = 'juliaSet.png';
$image->writeImage($imagePath);

// Clean up
$image->clear();
$image->destroy();

// Output the image path
echo $imagePath;
?>