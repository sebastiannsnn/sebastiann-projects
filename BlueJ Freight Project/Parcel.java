import java.util.ArrayList;
import java.util.Collections;
import java.util.Objects;

/**
 * @author Sebastian Nowak
 * @version v1
 */
public class Parcel extends Freight
{    
    private double weight;  // The parcel's weight in kilos  
    private int width; // The parcel's width in cms    
    private int length; // The parcel's length in cms
    private int height; // The parcel's height in cms
    private String address; // delivery address
    private String dateSent; // The date the parcel was sent, initialized as empty

    /** the maximum permissible length of the parcel in cms */
    public static final int LENGTH_LIMIT = 120;
    /** the maximum permissible size of the parcel in cms */
    public static final int SIZE_LIMIT = 245;
    /** the maximum permissible size of the parcel in kilos */
    public static final int WEIGHT_LIMIT = 5;

    /**
     * Constructor to initialize the parcel's properties.
     * @param address the delivery address for the parcel
     * @param weight the weight of the parcel
     * @param width the width of the parcel
     * @param length the length of the parcel
     * @param height the height of the parcel
     */
    public Parcel(String address, double weight, int width, int length, int height) {
        super(address); // Call the Freight constructor with the address
        this.weight = weight;
        this.width = width;
        this.length = length;
        this.height = height;
        this.dateSent = ""; // Initialize dateSent to an empty string
    }
    
    /**
     * Returns a list of the parcel's dimensions (width, length, height) ordered from smallest to largest.
     * @return an ArrayList of Integer containing the dimensions sorted in ascending order
     */
    public static ArrayList<Integer> getOrderedSides(int width, int length, int height) {
        ArrayList<Integer> sides = new ArrayList<>();
        sides.add(width);
        sides.add(length);
        sides.add(height);
        Collections.sort(sides);
        return sides;
    }
    
    /**
     * Calculates the total price of the parcel based on its weight and the cost per kilo in pence.
     * @param costPerKilo the cost per kilo in pence
     * @return the price in pounds
     */
    @Override
    public double createQuote(int costPerKilo) {
        double totalCostInPence = this.weight * costPerKilo;  // Calculate total cost in pence
        double totalCostInPounds = totalCostInPence / 100.0; // Convert pence to pounds
        return Double.parseDouble(String.format("%.2f", totalCostInPounds));
    }

    /**
     * Checks if this Parcel is equal to another object.
     * Equality is based on matching class type, address, date sent, weight, width, length, and height.
     * @param o the object to compare with this Parcel
     * @return true if the specified object is a Parcel with the same values for all checked properties
     */
    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
    
        Parcel parcel = (Parcel) o;
        return Objects.equals(address, parcel.address) &&
               Objects.equals(dateSent, parcel.dateSent) &&
               Double.compare(parcel.weight, weight) == 0 &&
               width == parcel.width &&
               length == parcel.length &&
               height == parcel.height;
    }   
    @Override
    public int hashCode() {
        return Objects.hash(address, dateSent, weight, width, length, height);
    }

    /**
     * @return a string representation of the parcel
     */
    @Override
    public String toString() {
        String returnString = "A parcel for " + getAddress() + "\nWeight " + weight + 
        "Kg, Width " + width + "cms, Height " + height + "cms, Length " + length + "cms.";
        return returnString;
    }

    /**
     * @return the weight
     */
    public double getWeight() {
        return weight;
    }
    
    /**
     * Returns the longest side of the parcel.
     * @return the length of the longest side as an int
    */
    public int getLongestSide() {
        int longest = Math.max(width, Math.max(length, height));
        return longest;
    }
    /**
     * Calculates and returns the size of the parcel using the formula: 
     * (shortest side + next shortest side) x 2 + longest side.
     * @return the calculated size of the parcel as an int
     */
    public int getParcelSize() {
        int shortest = Math.min(width, Math.min(length, height)); // Find the shortest side
        int longest = Math.max(width, Math.max(length, height)); // Find the longest side
        
        // Find the middle value by excluding the shortest and the longest
        int middle = (width + length + height) - shortest - longest;
    
        // Calculate the size using the formula
        int size = (shortest + middle) * 2 + longest;
        return size;
    }
    /**
     * Checks if the parcel is within the specified limits.
     * @return true if the parcel's longest side, total size, and weight are within the specified limits; false otherwise.
     */
    public boolean isWithinLimits() {
        int longestSide = getLongestSide(); // Reuse the method to get the longest side
        int totalSize = getParcelSize(); // Reuse the method to get the calculated size of the parcel
        boolean isWithinSizeLimits = longestSide <= LENGTH_LIMIT && totalSize <= SIZE_LIMIT;
        boolean isWithinWeightLimit = weight <= WEIGHT_LIMIT;
    
        return isWithinSizeLimits && isWithinWeightLimit;
    }  
    /**
     * Sets the date sent for the parcel.
     * @param dateSent The formatted date when the parcel was sent.
     */
    public void setDateSent(String dateSent) {
        this.dateSent = dateSent;
    }
    /**
     * Returns the date when the parcel was sent.
     * @return A string representing the date sent.
     */
    public String getDateSent() {
        return dateSent;
    }
}


