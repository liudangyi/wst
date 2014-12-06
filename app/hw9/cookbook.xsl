<?xml version="1.0" encoding="ISO-8859-1" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>My Cookbook</title>
        <link href="//cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.css" rel="stylesheet" />
      </head>
      <body>
        <div class="container">
          <h1>My Recipe Collection</h1>
          <br />
          <xsl:for-each select="cookbook/recipe">
            <h4><xsl:value-of select="name" /></h4>
            <table class="table" style="float: left; width: 500px;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Unit</th>
                </tr>
              </thead>
              <tbody>
                <xsl:for-each select="ingredient">
                  <tr>
                    <td><xsl:value-of select="name" /></td>
                    <td><xsl:value-of select="amount" /></td>
                    <td><xsl:value-of select="unit" /></td>
                  </tr>
                </xsl:for-each>
              </tbody>
            </table>
            <div style="margin-left: 520px;">
              <h5>Preparation</h5>
              <ol>
                <xsl:for-each select="preparation/step">
                  <li><xsl:value-of select="."></xsl:value-of></li>
                </xsl:for-each>
              </ol>
              <h5>Cooking</h5>
              <ol>
                <xsl:for-each select="cooking/step">
                  <li><xsl:value-of select="."></xsl:value-of></li>
                </xsl:for-each>
              </ol>
            </div>
            <hr style="clear: left;" />
          </xsl:for-each>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
