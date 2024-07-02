<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <head>
                <title>Playlist</title>
            </head>
            <body>
                <h1>Playlist</h1>
                <xsl:apply-templates select="playlist"/>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="playlist">
        <h2>Playlist Details</h2>
        <p><strong>Author:</strong> <xsl:value-of select="@autor"/></p>
        <p><strong>Users Voted:</strong> <xsl:value-of select="@users_voted"/></p>

        <h3>Name</h3>
        <p><xsl:value-of select="name"/></p>

        <h3>Total Length</h3>
        <p><xsl:value-of select="totallength"/> <xsl:value-of select="totallength/@unit"/></p>

        <xsl:if test="genre">
            <h3>Genre</h3>
            <p><xsl:value-of select="genre"/></p>
        </xsl:if>

        <h3>Album</h3>
        <xsl:apply-templates select="album"/>

        <h3>Songs</h3>
        <xsl:apply-templates select="song"/>
    </xsl:template>

    <xsl:template match="album">
        <div>
            <h4>Album Details</h4>
            <p><xsl:value-of select="@name"/></p>
            <xsl:apply-templates select="song"/>
        </div>
    </xsl:template>

    <xsl:template match="song">
        <div>
            <h4>Song Details</h4>
            <p><xsl:value-of select="."/></p>
        </div>
    </xsl:template>

</xsl:stylesheet>
