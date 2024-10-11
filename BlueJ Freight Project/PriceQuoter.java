/**
 * Interface to provide pricing based on a unit price.
 *
 * @author Sebastian Nowak
 * @version v1
 */
public interface PriceQuoter {
    /**
     * Creates a quote based on a unit price.
     * @param unitPrice the price per unit
     * @return the calculated quote
     */
    double createQuote(int unitPrice);
}
