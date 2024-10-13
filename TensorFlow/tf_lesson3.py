import tensorflow as tf

dataset = tf.data.Dataset.from_tensor_slices([1,2,3,4,5])

for element in dataset:
    print(element.numpy())

batched_dataset = dataset.batch(2)
for batch in batched_dataset:
    print(batch.numpy())

shuffled_dataset = dataset.shuffle(buffer_size=5).batch(2)
for batch in shuffled_dataset:
    print(batch.numpy())

def preprocess(x):
    return x * 2

processed_dataset = dataset.map(preprocess)
for element in processed_dataset:
    print(element.numpy())