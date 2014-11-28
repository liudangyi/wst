import java.applet.*;
import javax.swing.*;
import java.awt.*;

public class awt extends Applet {
    public void paint(Graphics g) {
        g.setColor(Color.red);
        g.drawRect(20, 20, 50, 50);
        g.fillRect(20, 20, 50, 50);
        g.setColor(Color.green);
        g.drawOval(100, 20, 50, 50);
        g.fillOval(100, 20, 50, 50);
    }
}
