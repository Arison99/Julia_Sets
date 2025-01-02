const canvas = document.getElementById('juliaCanvas');
const ctx = canvas.getContext('2d');
const width = canvas.width;
const height = canvas.height;

const maxIterations = 300;
const zoom = 1;
const moveX = 0;
const moveY = 0;
const cRe = -0.7;
const cIm = 0.27015;

function juliaSet() {
    for (let x = 0; x < width; x++) {
        for (let y = 0; y < height; y++) {
            let zx = 1.5 * (x - width / 2) / (0.5 * zoom * width) + moveX;
            let zy = (y - height / 2) / (0.5 * zoom * height) + moveY;
            let i = maxIterations;
            while (zx * zx + zy * zy < 4 && i > 0) {
                let tmp = zx * zx - zy * zy + cRe;
                zy = 2.0 * zx * zy + cIm;
                zx = tmp;
                i--;
            }
            const color = i === 0 ? 0 : (i / maxIterations) * 255;
            ctx.fillStyle = `rgb(${color}, ${color}, ${color})`;
            ctx.fillRect(x, y, 1, 1);
        }
    }
}

juliaSet();