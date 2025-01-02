import java.awt.Color;
import java.awt.image.BufferedImage;
import javax.imageio.ImageIO;
import java.io.File;
import java.io.IOException;

public class JuliaSet {
    private static final int WIDTH = 800;
    private static final int HEIGHT = 800;
    private static final int MAX_ITER = 300;
    private static final double ZOOM = 1;
    private static final double MOVE_X = 0;
    private static final double MOVE_Y = 0;
    private static final double C_RE = -0.7;
    private static final double C_IM = 0.27015;

    public static void main(String[] args) {
        BufferedImage image = new BufferedImage(WIDTH, HEIGHT, BufferedImage.TYPE_INT_RGB);

        for (int x = 0; x < WIDTH; x++) {
            for (int y = 0; y < HEIGHT; y++) {
                double zx = 1.5 * (x - WIDTH / 2) / (0.5 * ZOOM * WIDTH) + MOVE_X;
                double zy = (y - HEIGHT / 2) / (0.5 * ZOOM * HEIGHT) + MOVE_Y;
                float i = MAX_ITER;
                while (zx * zx + zy * zy < 4 && i > 0) {
                    double tmp = zx * zx - zy * zy + C_RE;
                    zy = 2.0 * zx * zy + C_IM;
                    zx = tmp;
                    i--;
                }
                int color = i > 0 ? Color.HSBtoRGB((MAX_ITER / i) % 1, 1, 1) : 0;
                image.setRGB(x, y, color);
            }
        }

        try {
            ImageIO.write(image, "png", new File("juliaSet.png"));
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}