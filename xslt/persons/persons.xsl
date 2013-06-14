<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<title>Sorting Output</title>
				<style type="text/css">
					h2 {color:blue}
					li {font-size:10pt}
				</style>
			</head>
			<body>
				<xsl:apply-templates select="famous-persons/persons">
					<xsl:sort select="@category" />
				</xsl:apply-templates>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="persons">
		<h2>
			<xsl:value-of select="@category" />
		</h2>
		<ul>
			<xsl:apply-templates select="person">
				<xsl:sort select="name" />
				<xsl:sort select="firstname" />
			</xsl:apply-templates>
		</ul>
	</xsl:template>
	<xsl:template match="person">
		<xsl:text disable-output-escaping="yes">
			&lt;li&gt;
		</xsl:text>
		<b>
			<xsl:value-of select="name" />
		</b>
		<xsl:text> </xsl:text>
		<xsl:value-of select="firstname" />
	</xsl:template>
</xsl:stylesheet>