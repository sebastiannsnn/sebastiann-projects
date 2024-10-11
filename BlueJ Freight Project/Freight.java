
/**
 * class Freight - write a description of the class here
 *
 * @author M250 module team
 * @version v1
 */
public abstract class Freight implements PriceQuoter {
    private String address; // the address to send the freight to
    private String dateSent; // the date the freight was sent

    /**
     * Constructor to set the address for the freight.
     * @param anAddress the address the freight is to be sent to
     */
    public Freight(String anAddress) {
        address = anAddress;
    }
    
    /**
     * Gets the address.
     * @return the address
     */
    public String getAddress() {
        return address;
    }
    
    /**
     * Gets the date sent.
     * @return the dateSent
     */
    public String getDateSent() {
        return dateSent;
    }

    /**
     * Sets the date sent.
     * @param aPostDate the dateSent to set
     */
    public void setDateSent(String aPostDate) {
        dateSent = aPostDate;
    }
}
