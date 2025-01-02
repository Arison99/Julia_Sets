#include <SDL2/SDL.h>
#include <complex.h>

#define WIDTH 800
#define HEIGHT 800
#define MAX_ITER 300

void drawJuliaSet(SDL_Renderer *renderer, double complex c) {
    for (int x = 0; x < WIDTH; x++) {
        for (int y = 0; y < HEIGHT; y++) {
            double zx = 1.5 * (x - WIDTH / 2) / (0.5 * WIDTH);
            double zy = (y - HEIGHT / 2) / (0.5 * HEIGHT);
            double complex z = zx + zy * I;
            int i;
            for (i = 0; i < MAX_ITER; i++) {
                if (cabs(z) > 2.0) break;
                z = z * z + c;
            }
            int color = (i == MAX_ITER) ? 0 : (255 * i / MAX_ITER);
            SDL_SetRenderDrawColor(renderer, color, color, color, 255);
            SDL_RenderDrawPoint(renderer, x, y);
        }
    }
}

int main(int argc, char *argv[]) {
    if (SDL_Init(SDL_INIT_VIDEO) != 0) {
        fprintf(stderr, "SDL_Init Error: %s\n", SDL_GetError());
        return 1;
    }

    SDL_Window *win = SDL_CreateWindow("Julia Set", 100, 100, WIDTH, HEIGHT, SDL_WINDOW_SHOWN);
    if (win == NULL) {
        fprintf(stderr, "SDL_CreateWindow Error: %s\n", SDL_GetError());
        SDL_Quit();
        return 1;
    }

    SDL_Renderer *renderer = SDL_CreateRenderer(win, -1, SDL_RENDERER_ACCELERATED | SDL_RENDERER_PRESENTVSYNC);
    if (renderer == NULL) {
        SDL_DestroyWindow(win);
        fprintf(stderr, "SDL_CreateRenderer Error: %s\n", SDL_GetError());
        SDL_Quit();
        return 1;
    }

    double complex c = -0.7 + 0.27015 * I;
    drawJuliaSet(renderer, c);
    SDL_RenderPresent(renderer);

    SDL_Event e;
    int quit = 0;
    while (!quit) {
        while (SDL_PollEvent(&e)) {
            if (e.type == SDL_QUIT) {
                quit = 1;
            }
        }
    }

    SDL_DestroyRenderer(renderer);
    SDL_DestroyWindow(win);
    SDL_Quit();
    return 0;
}