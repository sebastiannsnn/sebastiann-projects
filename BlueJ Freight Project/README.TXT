Brief Overview of the Parcel and Freight Price Quoting System
Project Description:

This project is a Parcel and Freight Price Quoting System designed to handle different aspects of shipping, including quoting shipping prices, managing different types of parcels, tracking shipments, and even handling bulk removal services. The system is implemented using Java and is built around multiple classes that work together to manage and process shipping requests efficiently.
Key Components:

    Parcel Class:
        Represents a basic shipping parcel, with attributes such as dimensions, weight, and possibly destination details.
        Includes methods for calculating basic shipping details like cost and classification (e.g., standard or express delivery).

    Freight Class:
        Handles larger shipments or cargo, typically involving freight transport. It calculates costs based on weight and volume, and may include logistics for handling multiple items at once.

    TrackedParcel Class:
        An extension of the basic Parcel class that includes tracking information. It allows users to track a parcel’s location and delivery status.
        Useful for managing shipping logistics and providing customers with real-time updates.

    PriceQuoter Class:
        Provides functionality to quote prices for both parcels and freight. It takes into account factors such as weight, dimensions, shipping speed, and possibly destination.
        Likely central to the system, as it interfaces with all other classes to provide accurate pricing for various types of shipping.

    Removal Class:
        Represents a special service for handling bulk removals, such as moving large items or performing relocations.
        It includes logic to calculate pricing based on the nature and volume of the removal services, including potential extras like packaging or handling.

Code and Language:

    Language Used: Java
        The project is written in Java, a popular object-oriented programming language known for its robustness, portability, and ability to handle large systems efficiently.
    Key Technologies:
        Object-Oriented Programming (OOP) principles are employed, with each aspect of the shipping process (e.g., parcels, freight, tracking) represented by its own class.
        Java Libraries: Likely uses standard Java libraries to handle file input/output, data manipulation, and potentially network operations for tracking.
