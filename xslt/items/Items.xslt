<?xml version="1.0" encoding="UTF-8"?>
<!-- Version 1.0 or 2.0 can be used for xslt. -->
<xsl:stylesheet version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<!-- Output is html -->
	<xsl:output method="html" indent="yes" />

	<xsl:template match="Items">
		<html>
			<head>
				<title>Sales amount by provider</title>
			</head>
			<body>
				<h1>Sales amount by provider</h1>
				<table border="1">
					<!-- Group items by provider -->
					<xsl:for-each-group select="Item" group-by="ProviderName">
						<xsl:sort select="ProviderName" />
						<tr bgcolor="#00FF00">
							<td colspan="4">
								Provider:
								<xsl:value-of select="current-grouping-key()" />
							</td>
						</tr>
						<!-- For each group of provider display this row -->
						<tr>
							<td>Item Number</td>
							<td>Quantity</td>
							<td>Unit Price</td>
							<td>Total</td>
						</tr>
						<!-- For each and every Item node in current provider group, group 
							them by ItemNumber -->
						<xsl:for-each-group select="current-group()"
							group-by="@ItemNumber">
							<xsl:sort select="@ItemNumber" />
							<tr>
								<td>
									<xsl:value-of select="@ItemNumber" />
								</td>
								<!-- For each and every Item node in current ItemNumber group, do 
									the sum of quantity -->
								<td>
									<xsl:value-of select="sum(current-group()/Quantity)" />
								</td>
								<td>
									<xsl:value-of select="UnitPrice" />
								</td>
								<td>
									<xsl:value-of
										select="ceiling(sum(current-group()/(Quantity * UnitPrice)))" />
								</td>
							</tr>
						</xsl:for-each-group>
						<tr>
							<td colspan="3" align="right">
								<strong>Sub-total</strong>
							</td>
							<!-- For each and every Item node in the current provider group, print 
								sum of Quantity * UnitPrice -->
							<td>
								<xsl:value-of
									select="ceiling(sum(current-group()/(Quantity * UnitPrice)))" />
							</td>
						</tr>
					</xsl:for-each-group>
					<tr>
						<td colspan="3" align="right">
							<strong>Grand-total</strong>
						</td>
						<!-- For each and every Item node in the Items node, print sum of Quantity 
							* UnitPrice -->
						<td>
							<xsl:value-of select="ceiling(sum(Item/(Quantity * UnitPrice)))" />
						</td>
					</tr>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>