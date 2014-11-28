import java.applet.*;
import javax.swing.*;
import java.awt.*;

public class swing extends JApplet {
  Container messageArea = getContentPane();
  MessagePanel myMessagePanel = new MessagePanel();
  public void init() {
    messageArea.add(myMessagePanel);
  }
}
class MessagePanel extends JPanel {
  public void paintComponent(Graphics g) {
    super.paintComponent(g);
    g.setColor(Color.red);
    g.drawRect(20, 20, 50, 50);
    g.fillRect(20, 20, 50, 50);
    g.setColor(Color.green);
    g.drawOval(100, 20, 50, 50);
    g.fillOval(100, 20, 50, 50);
  }
}
