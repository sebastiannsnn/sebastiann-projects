import tensorflow as tf

# Generate some synthetic data
X = tf.constant([1, 2, 3, 4, 5], dtype=tf.float32)  # Independent variable (input)
Y = tf.constant([2, 4, 6, 8, 10], dtype=tf.float32)  # Dependent variable (output)

# Initialize weights and bias (start with random values)
w = tf.Variable(0.0)  # Weight
b = tf.Variable(0.0)  # Bias

# Define the linear regression model
def linear_regression(x):
    return w * x + b

# Define the loss function (Mean Squared Error)
def loss_fn(y_true, y_pred):
    return tf.reduce_mean(tf.square(y_true - y_pred))
# def loss_fn_mae(y_true, y_pred):
#     return tf.reduce_mean(tf.abs(y_true - y_pred))

# Set the learning rate and number of iterations
learning_rate = 0.01
epochs = 100

# Training loop
for epoch in range(epochs):
    with tf.GradientTape() as tape:
        y_pred = linear_regression(X)  # Predict the output using the model
        loss = loss_fn(Y, y_pred)  # Calculate the loss
    
    # Compute the gradients of the loss with respect to the model's parameters (w and b)
    gradients = tape.gradient(loss, [w, b])
    
    # Update the weights and bias using gradient descent
    w.assign_sub(learning_rate * gradients[0])
    b.assign_sub(learning_rate * gradients[1])
    
    # Print the predicted values at every 10th epoch
    if epoch % 10 == 0:
        print(f"Epoch {epoch}: Loss = {loss.numpy()}, w = {w.numpy()}, b = {b.numpy()}")
        print(f"Predicted values (y_pred): {y_pred.numpy()}")
# Predict for a new value of x

new_X = tf.constant([6], dtype=tf.float32)
predicted_y = linear_regression(new_X)
print(f"Predicted value for x=6: {predicted_y.numpy()}")

