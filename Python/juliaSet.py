import numpy as np
"""
This script generates and plots a Julia set using the given parameters.
Parameters:
    width (int): The width of the output image in pixels.
    height (int): The height of the output image in pixels.
    x_min (float): The minimum x-coordinate value for the plot.
    x_max (float): The maximum x-coordinate value for the plot.
    y_min (float): The minimum y-coordinate value for the plot.
    y_max (float): The maximum y-coordinate value for the plot.
    max_iterations (int): The maximum number of iterations to perform.
    c (complex): The complex constant used in the Julia set formula.
Variables:
    x (ndarray): Array of x-coordinates.
    y (ndarray): Array of y-coordinates.
    X (ndarray): 2D grid of x-coordinates.
    Y (ndarray): 2D grid of y-coordinates.
    Z (ndarray): 2D grid of complex numbers.
    iterations (ndarray): Array to store the iteration count for each point.
The script performs the iteration to generate the Julia set and plots the result using matplotlib.
Note:
    Other color maps that can be used include 'viridis', 'plasma', 'magma', 'cividis', etc.
"""
import matplotlib.pyplot as plt

# Parameters for the Julia set
width, height = 800, 800
x_min, x_max = -1.5, 1.5
y_min, y_max = -1.5, 1.5
max_iterations = 300
c = complex(-0.7, 0.27015)

# Create a grid of complex numbers
x = np.linspace(x_min, x_max, width)
y = np.linspace(y_min, y_max, height)
X, Y = np.meshgrid(x, y)
Z = X + 1j * Y

# Initialize the iteration count array
iterations = np.zeros(Z.shape, dtype=int)

# Perform the iteration
for i in range(max_iterations):
    mask = np.abs(Z) < 4
    Z[mask] = Z[mask] ** 2 + c
    iterations[mask] = i

# Plot the Julia set
plt.imshow(iterations, extent=(x_min, x_max, y_min, y_max), cmap='plasma', origin='lower')
plt.colorbar()
plt.title('Julia Set')
plt.xlabel('Re')
plt.ylabel('Im')
plt.show()