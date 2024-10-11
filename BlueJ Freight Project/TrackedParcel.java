import java.util.HashSet;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Objects;
/**
 * TrackedParcel class that extends Parcel.
 * @author Sebastian Nowak
 * @version v1
 */
public class TrackedParcel extends Parcel
{
    private String trackingNumber; // Represents the tracking number of the parcel, initialized to an empty string
    private int value; // Represents the value of the parcel in pence
    private HashSet<String> contents; // Represents the contents of the parcel

    public static final double TRACKING_FEE = 2.0; // Price in pounds sterling for tracking

    /**
     * Constructor for TrackedParcel with parameters for Parcel properties and additional value.
     * @param address The address where the parcel is to be delivered
     * @param weight The weight of the parcel in kilos
     * @param width The width of the parcel in cms
     * @param length The length of the parcel in cms
     * @param height The height of the parcel in cms
     * @param value The value of the parcel in pence
     */
    public TrackedParcel(String address, double weight, int width, int length, int height, int value) {
        super(address, weight, width, length, height); // Call to the superclass constructor
        this.value = value;
        this.contents = new HashSet<String>(); // Initialize the HashSet for contents
        this.trackingNumber = ""; // Initialize tracking number to an empty string
    }

    // Method implementations (getTrackingNumber, addItem)
    /**
     * @return the tracking number of the parcel
     */
    public String getTrackingNumber() {
        return trackingNumber;
    }

    /**
     * Adds an item to the contents set for the parcel
     * @param anItem The item to add to the contents
     */
    public void addItem(String anItem) {
        contents.add(anItem);
    }
    
    /**
     * Sets the tracking number and updates the date sent to the current date.
     * @param trackingNumber The tracking number to set.
     */
    public void setDateAndTracking(String trackingNumber) {
        this.trackingNumber = trackingNumber;

        // Create a DateTimeFormatter with the desired format
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd MMM yyyy");

        // Get the current date and format it
        String formattedDate = LocalDate.now().format(formatter);

        // Use the setter method in the superclass to set the dateSent
        super.setDateSent(formattedDate);
    }
    /**
     * Overrides the toString method to include details about the parcel's contents,
     * value in pounds, date sent, and tracking number.
     * @return A string representation of the TrackedParcel including additional details.
     */
    @Override
    public String toString() {
        StringBuilder result = new StringBuilder(super.toString()); // Start with the Parcel's toString output

        // Add contents if not empty
        if (!contents.isEmpty()) {
            ArrayList<String> sortedContents = new ArrayList<>(contents);
            Collections.sort(sortedContents);
            result.append("\nContents: ");
            for (String item : sortedContents) {
                result.append(item).append(" ");
            }
            // Remove the last space
            result.setLength(result.length() - 1);
        }

        // Add value converted to pounds
        if (value > 0) {
            double pounds = value / 100.0;
            result.append("\nValue: £").append(String.format("%.2f", pounds));
        }

        // Add date sent if not empty
        String dateSent = getDateSent(); // Use the getter method
        if (dateSent != null && !dateSent.isEmpty()) {
            result.append("\nDate Sent: ").append(dateSent);
        }

        // Add tracking number if not empty
        if (trackingNumber != null && !trackingNumber.isEmpty()) {
            result.append("\nTracking Number: ").append(trackingNumber);
        }

        return result.toString();
    }
    /**
     * Overrides the equals method to include a comparison of the tracking numbers.
     * @param obj The object to compare this TrackedParcel against.
     * @return true if the objects are of the same class and have matching tracking numbers, false otherwise.
     */
    @Override
    public boolean equals(Object obj) {
        if (!super.equals(obj)) return false;  // First check equality based on Parcel properties
        if (getClass() != obj.getClass()) return false;  // Ensure exact class match
    
        TrackedParcel other = (TrackedParcel) obj;
        return Objects.equals(trackingNumber, other.trackingNumber);
    }   
   
    /**
     * Generates a hash code for a TrackedParcel.
     * @return a hash code value for this object.
     */
    @Override
    public int hashCode() {
        // Call super.hashCode() if Parcel's hashCode is implemented and relevant
        return Objects.hash(super.getAddress(), super.getDateSent(), trackingNumber);
    }
    /**
     * Calculates the total price of the tracked parcel based on its weight and the cost per kilo in pence,
     * then adds a tracking fee.
     * @param costPerKilo the cost per kilo in pence
     * @return the total price in pounds, including the tracking fee, rounded to two decimal places
     */
    @Override
    public double createQuote(int costPerKilo) {
        // First, get the quote from the Parcel (superclass) method
        double baseQuote = super.createQuote(costPerKilo);
        // Add the tracking fee
        double totalQuote = baseQuote + TRACKING_FEE;
        // Return the total cost, rounded to two decimal places
        return Math.round(totalQuote * 100.0) / 100.0;
    }
}
