import tensorflow as tf
tf.config.run_functions_eagerly(True)

print("TensorFlow version:", tf.__version__)

tensor_a = tf.constant(5)
tensor_b = tf.constant(3)

result = tf.add(tensor_a,tensor_b)

print("Result of addition:", result, flush=True)

int_tensor = tf.constant(10, dtype=tf.int32)
print("Integer Tensor:", int_tensor)

float_tensor = tf.constant(10.5, dtype=tf.float32)
print("Float Tensor:", float_tensor)

string_tensor = tf.constant("Hello TensorFlow")
print("String Tensor:", string_tensor)

bool_tensor = tf.constant(True)
print("Boolean tensor:", bool_tensor)

# Scalar tensor (0-D)
scalar_tensor = tf.constant(42)
print("Scalar Tensor:", scalar_tensor)

# Vector (1-D tensor)
vector_tensor = tf.constant([1, 2, 3, 4])
print("Vector Tensor:", vector_tensor)

# Matrix (2-D tensor)
matrix_tensor = tf.constant([[1, 2], [3, 4]])
print("Matrix Tensor:\n", matrix_tensor)

# 3D Tensor
tensor_3d = tf.constant([[[1], [2]], [[3], [4]]])
print("3D Tensor:\n", tensor_3d)

# Reshape a 1D tensor into a 2x2 matrix
reshaped_tensor = tf.reshape(vector_tensor, (2, 2, 1))
print("Reshaped Tensor:\n", reshaped_tensor)

# Add two tensors
add_result = tf.add(tensor_a, tensor_b)
print("Addition Result:", add_result)

# Multiply two tensors
multiply_result = tf.multiply(tensor_a, tensor_b)
print("Multiplication Result:", multiply_result)

# Subtract two tensors
subtract_result = tf.subtract(tensor_a, tensor_b)
print("Subtraction Result:", subtract_result)

# Divide two tensors
divide_result = tf.divide(tensor_a, tensor_b)
print("Division Result:", divide_result)

# Matrix multiplication
matrix_1 = tf.constant([[1, 2], [3, 4]])
matrix_2 = tf.constant([[5, 6], [7, 8]])
matrix_mult_result = tf.matmul(matrix_1, matrix_2)
print("Matrix Multiplication Result:\n", matrix_mult_result)

# Sum of elements in a tensor
sum_result = tf.reduce_sum(matrix_1)
print("Sum of elements:", sum_result)

# Mean of elements in a tensor
mean_result = tf.reduce_mean(matrix_1)
print("Mean of elements:", mean_result)

# Find the index of the maximum value in a tensor
max_index = tf.argmax(vector_tensor)
print("Index of max value:", max_index)
