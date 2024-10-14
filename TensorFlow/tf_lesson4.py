import tensorflow as tf

# # Creating a variable
# my_variable = tf.Variable(10)

# # Accessing the value of the variable
# print("Initial value:", my_variable.numpy())

# # Modifying the variable by assignment
# my_variable.assign(15)
# print("Modified value:", my_variable.numpy())

# # Adding to the current value
# my_variable.assign_add(5)
# print("Value after adding 5:", my_variable.numpy())

# def my_function(x):
#     return x**2

# x = tf.Variable(3.0)

# with tf.GradientTape() as tape:
#     y = my_function(x)

# dy_dx = tape.gradient(y, x)

# print("Gradient of y with respect to x:", dy_dx.numpy())

# # Define the function: f(x) = (x - 4)^2
# def loss_function(x):
#     return (x - 4) ** 2

# # Create a variable
# x = tf.Variable(10.0)

# # Define the learning rate
# learning_rate = 0.1

# # Perform gradient descent
# for i in range(20):
#     with tf.GradientTape() as tape:
#         loss = loss_function(x)
    
#     # Compute the gradients
#     grad = tape.gradient(loss, x)
    
#     # Update the variable using gradient descent
#     x.assign_sub(learning_rate * grad)
    
#     # Print progress
#     print(f"Iteration {i+1}: x = {x.numpy()}, loss = {loss.numpy()}")

#challenge 1

# z = tf.Variable(15.0)

# for i in range(20):
#     z.assign_sub(3)  # Subtract 3 from z
#     print(f"Iteration {i+1}: z = {z.numpy()}")
    
#     if z < 5:
#         print("Stopping the loop as z is less than 5.")
#         break  # Stop the loop if z is less than 5


# def my_function(x):
#     return x ** 3 + 2 * (x ** 2) + 5 * x

# # x should be a float for proper gradient calculation
# x = tf.Variable(10.0)

# with tf.GradientTape() as tape:
#     y = my_function(x)

# # Calculate the gradient of y with respect to x
# dy_dx = tape.gradient(y, x)
# print("Gradient of y with respect to x:", dy_dx.numpy())

def my_function(x):
    return (x-7)**2

learning_rate = 0.05

x = tf.Variable(10.0)

for i in range(30):
    with tf.GradientTape() as tape:
        function = my_function(x)
    
    grad = tape.gradient(function,x)
    x.assign_sub(learning_rate*grad)

    print(f"Iteration {i+1}: x = {x.numpy()}, function = {function.numpy()}")
