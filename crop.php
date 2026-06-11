<?php
$srcPath = 'public/images/logo-polvent.png';
$destPath = 'public/images/favicon.png';

$src = imagecreatefrompng($srcPath);
$width = imagesx($src);
$height = imagesy($src);

$minX = $width; $minY = $height; $maxX = 0; $maxY = 0;

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $color = imagecolorsforindex($src, imagecolorat($src, $x, $y));
        if ($color['alpha'] < 127) { // Not fully transparent
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}

$newWidth = $maxX - $minX + 1;
$newHeight = $maxY - $minY + 1;

// Make it square
$size = max($newWidth, $newHeight);
$dest = imagecreatetruecolor($size, $size);
imagesavealpha($dest, true);
$transColor = imagecolorallocatealpha($dest, 0, 0, 0, 127);
imagefill($dest, 0, 0, $transColor);

$dstX = ($size - $newWidth) / 2;
$dstY = ($size - $newHeight) / 2;

imagecopy($dest, $src, $dstX, $dstY, $minX, $minY, $newWidth, $newHeight);
imagepng($dest, $destPath);
echo "Cropped from {$width}x{$height} to square {$size}x{$size}\n";
