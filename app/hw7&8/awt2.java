import java.applet.*;
import javax.swing.*;
import java.awt.*;

public class awt2 extends Applet {
    public void paint(Graphics g) {
        g.setColor(Color.red);
        g.drawRect(20, 20, 50, 50);
        g.fillRect(20, 20, 50, 50);
        g.setColor(Color.green);
        g.drawOval(100, 20, 50, 50);
        g.fillOval(100, 20, 50, 50);
        if (Integer.parseInt(getParameter("color")) > 0) {
            g.setColor(Color.red);
        } else {
            g.setColor(Color.green);
        }
        if (Integer.parseInt(getParameter("shape")) > 0) {
            g.drawRect(180, 20, 50, 50);
            g.fillRect(180, 20, 50, 50);
        } else {
            g.drawOval(180, 20, 50, 50);
            g.fillOval(180, 20, 50, 50);
        }
    }
}
