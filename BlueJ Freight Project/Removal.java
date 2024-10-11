/**
 * Write a description of class Removal here.
 *
 * @author (your name)
 * @version (a version number or a date)
 */
public class Removal extends Freight
{
   private int volume; //the volume of freight required to be transported

    /**
     * Constructor for objects of class Removals
     * @param anAddress the address the removal is to
     * @param aVolume the volume of the goods to be removed
     */
    public Removal(String anAddress, int aVolume)
    {
       super(anAddress);
       volume = aVolume;
    }
    /**
     * Calculates the total price of the removal based on its volume and the cost per cubic meter.
     * @param costPerM3 the cost per cubic meter in pence
     * @return the price in pounds
     */
    @Override
    public double createQuote(int costPerM3) {
        double totalCostInPence = this.volume * costPerM3; // Calculate total cost in pence
        double totalCostInPounds = totalCostInPence / 100.0; // Convert pence to pounds
        return Double.parseDouble(String.format("%.2f", totalCostInPounds));
    }
}