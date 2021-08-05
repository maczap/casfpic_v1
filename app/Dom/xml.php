<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
<payment>
    <mode>default</mode>
    <method>creditCard</method>
    <sender>
        <name>MARCOS APARECIDO</name>
        <email>v50618275697543472971@sandbox.pagseguro.com.br</email>
        <documents>
            <document>
                <type>CPF</type>
                <value>26460284822</value>
            </document>
        </documents>
        <phone>
            <areaCode>11</areaCode>
            <number>986486514</number>
        </phone>
        <hash>ad3fe0dbc169c4ab6f0ddcf35418f005663d6ace351f399996f330be435350be</hash>
        <ip>127.0.0.1</ip>
    </sender>
    <currency>BRL</currency>
    <notificationURL>https://casfpic.org.br/api/postback</notificationURL>
    <items>
        <item>
            <amount>492.00</amount>
            <id>3055</id>
            <quantity>1</quantity>
            <description>CASFPIC ANUAL PRATA</description>
        </item>
    </items>
    <reference>100</reference>
    <shipping>
        <addressRequired>false</addressRequired>
    </shipping>
    <creditCard>
        <token>eb47ce4fd04d4f88bb2e2c89d623cff9</token>
        <installment>
            <value>257.1</value>
            <quantity>2</quantity>
            <noInterestInstallmentQuantity>10</noInterestInstallmentQuantity>
        </installment>
        <holder>
            <name>MARCOS APARECIDO</name>
            <birthDate>18/05/1979</birthDate>
            <documents>
                <document>
                    <type>CPF</type>
                    <value>26460284822</value>
                </document>
            </documents>
            <phone>
                <areaCode>11</areaCode>
                <number>999999999</number>
            </phone>
        </holder>
        <billingAddress>
            <street>RUA CASTRO FARIA</street>
            <number>143</number>
            <complement/>
            <district>MONTE CASTELO</district>
            <city>CAMPO GRANDE</city>
            <state>MS</state>
            <country>BRASIL</country>
            <postalCode>79011030</postalCode>
        </billingAddress>
    </creditCard>
    <primaryReceiver>
        <publicKey>PUBBD3CE3ECC27B43F6B2D2B8C64BCE27D8</publicKey>
    </primaryReceiver>
    <receivers>
        <receiver>
            <publicKey>PUB2DDF1F0179F8449BADF6BD57F186B34F</publicKey>
            <split>
                <amount>10.00</amount>
            </split>
        </receiver>
    </receivers>
</payment>