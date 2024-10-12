import tensorflow as tf

var = tf.Variable(10)

print("Initial variable value:", var.numpy())

var.assign(20)
print("Updated variable value:", var.numpy())

# Creating two tensors
tensor_x = tf.constant([[1, 2], [3, 4]])
tensor_y = tf.constant([[5, 6], [7, 8]])

# Matrix multiplication
matrix_product = tf.matmul(tensor_x, tensor_y)
print("Matrix Multiplication Result:\n", matrix_product.numpy())

# Element-wise multiplication
elementwise_product = tf.multiply(tensor_x, tensor_y)
print("Element-wise Multiplication Result:\n", elementwise_product.numpy())

# Creating tensors of different shapes
tensor_a = tf.constant([1, 2, 3])
tensor_b = tf.constant([[1], [2], [3]])

# Broadcasting addition
broadcast_result = tf.add(tensor_a, tensor_b)
print("Broadcasting Result:\n", broadcast_result.numpy())

# Define two matrices
matrix_a = tf.constant([[1, 2], [3, 4]])  # Shape: (2, 2)
matrix_b = tf.constant([[5, 6], [7, 8]])  # Shape: (2, 2)

# Perform matrix multiplication
matrix_product = tf.matmul(matrix_a, matrix_b)

# Print result
print("Matrix Multiplication Result:\n", matrix_product.numpy())

import tensorflow as tf

# Define two matrices
matrix_a = tf.constant([[1, 2], [3, 4]])  # Shape: (2, 2)
matrix_b = tf.constant([[5, 6], [7, 8]])  # Shape: (2, 2)

# Perform element-wise multiplication
elementwise_product = tf.multiply(matrix_a, matrix_b)

# Print result
print("Element-wise Multiplication Result:\n", elementwise_product.numpy())

# Define two matrices with compatible shapes
matrix_x = tf.constant([[1, 2], [3, 4], [5, 6]])  # Shape: (3, 2)
matrix_y = tf.constant([[7, 8, 9], [10, 11, 12]])  # Shape: (2, 3)

# Perform matrix multiplication
result = tf.matmul(matrix_x, matrix_y)
print(result.numpy())
