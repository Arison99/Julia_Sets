package main

import (
    "image"
    "image/color"
    "image/png"
    "math/cmplx"
    "os"
)

const (
    width       = 800
    height      = 800
    maxIter     = 300
    xMin, xMax  = -1.5, 1.5
    yMin, yMax  = -1.5, 1.5
    cRe, cIm    = -0.7, 0.27015
)

func main() {
    img := image.NewRGBA(image.Rect(0, 0, width, height))

    for x := 0; x < width; x++ {
        for y := 0; y < height; y++ {
            zx := xMin + (xMax-xMin)*float64(x)/width
            zy := yMin + (yMax-yMin)*float64(y)/height
            z := complex(zx, zy)
            c := complex(cRe, cIm)
            var i int
            for i = 0; i < maxIter; i++ {
                if cmplx.Abs(z) > 2 {
                    break
                }
                z = z*z + c
            }
            colorVal := uint8(255 * i / maxIter)
            col := color.RGBA{colorVal, colorVal, colorVal, 255}
            img.Set(x, y, col)
        }
    }

    file, err := os.Create("juliaSet.png")
    if err != nil {
        panic(err)
    }
    defer file.Close()

    if err := png.Encode(file, img); err != nil {
        panic(err)
    }
}